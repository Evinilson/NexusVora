<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\HourPackage;
use App\Models\HourPackageEntry;
use App\Models\Project;
use App\Models\ProjectTask;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HourPackageController extends Controller
{
    public function index()
    {
        $packages = HourPackage::with('client')
            ->latest()
            ->get()
            ->each(fn ($p) => $p->syncStatus());

        return view('admin.hour-packages.index', compact('packages'));
    }

    public function create()
    {
        $clients  = Client::orderBy('name')->get();
        $projects = Project::with('client')->orderBy('title')->get();
        return view('admin.hour-packages.form', [
            'package'  => new HourPackage,
            'clients'  => $clients,
            'projects' => $projects,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'    => ['required', 'exists:clients,id'],
            'project_id'   => ['nullable', 'exists:projects,id'],
            'title'        => ['required', 'string', 'max:255'],
            'total_hours'  => ['required', 'numeric', 'min:0.5'],
            'price'        => ['nullable', 'numeric', 'min:0'],
            'purchased_at' => ['required', 'date'],
            'expires_at'   => ['nullable', 'date', 'after_or_equal:purchased_at'],
            'description'  => ['nullable', 'string'],
        ]);

        $data['status'] = 'ativo';
        $package = HourPackage::create($data);

        return redirect()->route('admin.hour-packages.show', $package)
            ->with('success', 'Pacote de horas criado com sucesso.');
    }

    public function show(HourPackage $hourPackage)
    {
        $hourPackage->load(['client', 'project', 'entries.tasks', 'tasks.project', 'tasks.subtasks']);
        $hourPackage->syncStatus();
        $otherPackages = HourPackage::where('client_id', $hourPackage->client_id)
            ->whereKeyNot($hourPackage->id)
            ->orderByDesc('purchased_at')
            ->get(['id', 'title', 'status']);

        return view('admin.hour-packages.show', compact('hourPackage', 'otherPackages'))
            ->with('package', $hourPackage);
    }

    public function edit(HourPackage $hourPackage)
    {
        $clients  = Client::orderBy('name')->get();
        $projects = Project::with('client')->orderBy('title')->get();
        return view('admin.hour-packages.form', [
            'package'  => $hourPackage,
            'clients'  => $clients,
            'projects' => $projects,
        ]);
    }

    public function update(Request $request, HourPackage $hourPackage)
    {
        $data = $request->validate([
            'client_id'    => ['required', 'exists:clients,id'],
            'project_id'   => ['nullable', 'exists:projects,id'],
            'title'        => ['required', 'string', 'max:255'],
            'total_hours'  => ['required', 'numeric', 'min:0.5'],
            'price'        => ['nullable', 'numeric', 'min:0'],
            'purchased_at' => ['required', 'date'],
            'expires_at'   => ['nullable', 'date', 'after_or_equal:purchased_at'],
            'description'  => ['nullable', 'string'],
            'status'       => ['required', Rule::in(['ativo', 'esgotado', 'expirado', 'cancelado'])],
        ]);

        $hourPackage->update($data);

        return redirect()->route('admin.hour-packages.show', $hourPackage)
            ->with('success', 'Pacote atualizado.');
    }

    public function destroy(HourPackage $hourPackage)
    {
        $hourPackage->delete();
        return redirect()->route('admin.hour-packages.index')->with('success', 'Pacote eliminado.');
    }

    // --- Entradas de horas ---

    public function storeEntry(Request $request, HourPackage $hourPackage)
    {
        $data = $request->validate([
            'title'        => ['nullable', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'hours'        => ['required', 'numeric', 'min:0.25'],
            'performed_at' => ['required', 'date'],
            'project_task_ids' => ['nullable', 'array'],
            'project_task_ids.*' => ['integer', 'exists:project_tasks,id'],
        ]);

        $taskIds = array_values(array_unique($data['project_task_ids'] ?? []));
        $selectedTasks = collect();
        if ($taskIds) {
            $selectedTasks = $hourPackage->tasks()->whereIn('id', $taskIds)->get();
            abort_unless($selectedTasks->count() === count($taskIds), 422);

            $registeredTaskIds = DB::table('hour_package_entry_task')
                ->join('hour_package_entries', 'hour_package_entries.id', '=', 'hour_package_entry_task.hour_package_entry_id')
                ->where('hour_package_entries.hour_package_id', $hourPackage->id)
                ->whereIn('hour_package_entry_task.project_task_id', $taskIds)
                ->pluck('hour_package_entry_task.project_task_id');

            abort_if($registeredTaskIds->isNotEmpty(), 422, 'Uma ou mais tarefas selecionadas já foram registadas.');
        }

        unset($data['project_task_ids']);
        $data['title'] = $data['title'] ?: $selectedTasks->pluck('title')->join(' · ');
        abort_unless($data['title'], 422, 'Indica o trabalho realizado ou seleciona uma tarefa.');
        $entry = $hourPackage->entries()->create($data);
        $entry->tasks()->sync($taskIds);
        $hourPackage->syncStatus();

        return back()->with('success', 'Entrada registada.');
    }

    public function destroyEntry(HourPackage $hourPackage, HourPackageEntry $entry)
    {
        abort_unless($entry->hour_package_id === $hourPackage->id, 404);
        $entry->delete();
        $hourPackage->syncStatus();
        return back()->with('success', 'Entrada eliminada.');
    }

    public function storeTask(Request $request, HourPackage $hourPackage)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required', 'in:a_fazer,em_progresso,concluido,bloqueado'],
            'parent_task_id' => ['nullable', 'integer', 'exists:project_tasks,id'],
        ]);

        if (! empty($data['parent_task_id'])) {
            abort_unless($hourPackage->tasks()->whereKey($data['parent_task_id'])->exists(), 422);
        }

        $data['hour_package_id'] = $hourPackage->id;
        $data['sort_order'] = (ProjectTask::where('hour_package_id', $hourPackage->id)->max('sort_order') ?? 0) + 1;

        ProjectTask::create($data);

        return back()->with('success', 'Tarefa adicionada ao pacote.');
    }

    public function updateTask(Request $request, HourPackage $hourPackage, ProjectTask $task)
    {
        abort_unless($task->hour_package_id === $hourPackage->id, 404);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required', 'in:a_fazer,em_progresso,concluido,bloqueado'],
            'target_hour_package_id' => ['nullable', 'integer', 'exists:hour_packages,id'],
        ]);

        $targetPackageId = $data['target_hour_package_id'] ?? null;
        unset($data['target_hour_package_id']);

        if ($targetPackageId && (int) $targetPackageId !== $hourPackage->id) {
            abort_unless($task->status !== 'concluido', 422, 'Não é possível mover uma tarefa concluída.');

            $targetPackage = HourPackage::findOrFail($targetPackageId);
            abort_unless($targetPackage->client_id === $hourPackage->client_id, 422);

            DB::transaction(function () use ($task, $data, $targetPackage) {
                $task->update(array_merge($data, ['hour_package_id' => $targetPackage->id]));

                if ($task->parent_task_id) {
                    $task->update(['parent_task_id' => null]);
                } else {
                    $task->subtasks()->update(['hour_package_id' => $targetPackage->id]);
                }
            });

            return redirect()->route('admin.hour-packages.show', $targetPackage)
                ->with('success', 'Tarefa movida para o novo pacote.');
        }

        $task->update($data);

        return back()->with('success', 'Tarefa atualizada.');
    }

    public function destroyTask(HourPackage $hourPackage, ProjectTask $task)
    {
        abort_unless($task->hour_package_id === $hourPackage->id, 404);

        DB::transaction(function () use ($task) {
            $task->subtasks()->delete();
            $task->delete();
        });

        return back()->with('success', 'Tarefa eliminada.');
    }

    // --- PDFs ---

    public function previewFicha(HourPackage $hourPackage)
    {
        $hourPackage->load(['client', 'project', 'entries']);
        $pdf = Pdf::loadView('documents.hour-package-ficha', ['package' => $hourPackage])
            ->setPaper('a4', 'portrait');
        return $pdf->stream('ficha-pacote-horas.pdf');
    }

    public function previewRelatorio(HourPackage $hourPackage)
    {
        $hourPackage->load(['client', 'project', 'entries.tasks']);
        $pdf = Pdf::loadView('documents.hour-package-relatorio', ['package' => $hourPackage])
            ->setPaper('a4', 'portrait');
        return $pdf->stream('relatorio-uso-horas.pdf');
    }

    public function downloadFicha(HourPackage $hourPackage)
    {
        $hourPackage->load(['client', 'project', 'entries']);
        $pdf = Pdf::loadView('documents.hour-package-ficha', ['package' => $hourPackage])
            ->setPaper('a4', 'portrait');
        return $pdf->download('ficha-pacote-horas-' . now()->format('Y-m-d') . '.pdf');
    }

    public function downloadRelatorio(HourPackage $hourPackage)
    {
        $hourPackage->load(['client', 'project', 'entries.tasks']);
        $pdf = Pdf::loadView('documents.hour-package-relatorio', ['package' => $hourPackage])
            ->setPaper('a4', 'portrait');
        return $pdf->download('relatorio-uso-horas-' . now()->format('Y-m-d') . '.pdf');
    }

    public function previewTaskReport(HourPackage $hourPackage)
    {
        $hourPackage->load(['client', 'project', 'tasks.subtasks']);
        $pdf = Pdf::loadView('documents.hour-package-tarefas', ['package' => $hourPackage])
            ->setPaper('a4', 'portrait');

        return $pdf->stream('relatorio-tarefas.pdf');
    }

    public function downloadTaskReport(HourPackage $hourPackage)
    {
        $hourPackage->load(['client', 'project', 'tasks.subtasks']);
        $pdf = Pdf::loadView('documents.hour-package-tarefas', ['package' => $hourPackage])
            ->setPaper('a4', 'portrait');

        return $pdf->download('relatorio-tarefas-' . now()->format('Y-m-d') . '.pdf');
    }
}
