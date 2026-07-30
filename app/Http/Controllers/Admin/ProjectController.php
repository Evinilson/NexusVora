<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('client')->latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
        return view('admin.projects.form', ['project' => new Project, 'clients' => $clients]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'   => ['required', 'exists:clients,id'],
            'title'       => ['required', 'string', 'max:255'],
            'status'      => ['required', 'in:proposta,ativo,em_pausa,concluido,cancelado'],
            'start_date'  => ['nullable', 'date'],
            'end_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string'],
            'budget'      => ['nullable', 'numeric', 'min:0'],
        ]);

        $project = Project::create($data);

        return redirect()->route('admin.projects.show', $project)->with('success', 'Projeto criado com sucesso.');
    }

    public function show(Project $project)
    {
        $project->load(['client', 'tasks', 'documentLogs']);
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $clients = Client::orderBy('name')->get();
        return view('admin.projects.form', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'client_id'   => ['required', 'exists:clients,id'],
            'title'       => ['required', 'string', 'max:255'],
            'status'      => ['required', 'in:proposta,ativo,em_pausa,concluido,cancelado'],
            'start_date'  => ['nullable', 'date'],
            'end_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string'],
            'budget'      => ['nullable', 'numeric', 'min:0'],
        ]);

        $project->update($data);

        return redirect()->route('admin.projects.show', $project)->with('success', 'Projeto atualizado.');
    }

    // --- Tasks inline ---

    public function storeTask(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date'    => ['nullable', 'date'],
            'status'      => ['required', 'in:a_fazer,em_progresso,concluido,bloqueado'],
        ]);

        $data['sort_order'] = $project->tasks()->max('sort_order') + 1;

        $project->tasks()->create($data);

        return back()->with('success', 'Tarefa adicionada.');
    }

    public function updateTask(Request $request, Project $project, ProjectTask $task)
    {
        abort_unless($task->project_id === $project->id, 404);

        // Toggle via JS só envia status; formulário completo envia title também
        if ($request->expectsJson() && ! $request->has('title')) {
            $data = $request->validate([
                'status' => ['required', 'in:a_fazer,em_progresso,concluido,bloqueado'],
            ]);
            $task->update($data);
            return response()->json(['ok' => true]);
        }

        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date'    => ['nullable', 'date'],
            'status'      => ['required', 'in:a_fazer,em_progresso,concluido,bloqueado'],
        ]);

        $task->update($data);

        if ($request->expectsJson()) {
            return response()->json(['ok' => true]);
        }

        return back()->with('success', 'Tarefa atualizada.');
    }

    public function destroyTask(Project $project, ProjectTask $task)
    {
        abort_unless($task->project_id === $project->id, 404);
        $task->delete();
        return back()->with('success', 'Tarefa eliminada.');
    }
}
