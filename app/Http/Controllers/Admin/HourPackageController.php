<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\HourPackage;
use App\Models\HourPackageEntry;
use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $hourPackage->load(['client', 'project', 'entries']);
        $hourPackage->syncStatus();
        return view('admin.hour-packages.show', ['package' => $hourPackage]);
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
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'hours'        => ['required', 'numeric', 'min:0.25'],
            'performed_at' => ['required', 'date'],
        ]);

        $hourPackage->entries()->create($data);
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
        $hourPackage->load(['client', 'project', 'entries']);
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
        $hourPackage->load(['client', 'project', 'entries']);
        $pdf = Pdf::loadView('documents.hour-package-relatorio', ['package' => $hourPackage])
            ->setPaper('a4', 'portrait');
        return $pdf->download('relatorio-uso-horas-' . now()->format('Y-m-d') . '.pdf');
    }
}
