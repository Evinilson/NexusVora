<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ProjectTask;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'status' => ['nullable', 'in:a_fazer,em_progresso,concluido,bloqueado'],
            'client_id' => ['nullable', 'exists:clients,id'],
        ]);

        $tasks = ProjectTask::with(['project.client', 'hourPackage.client'])
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($filters['client_id'] ?? null, fn ($query, $client) => $query->where(function ($query) use ($client) {
                $query->whereHas('project', fn ($project) => $project->where('client_id', $client))
                    ->orWhereHas('hourPackage', fn ($package) => $package->where('client_id', $client));
            }))
            ->orderByRaw("case when status = 'concluido' then 1 else 0 end")
            ->orderByRaw('due_date is null')
            ->orderBy('due_date')
            ->get();

        return view('admin.tasks.index', [
            'tasks' => $tasks,
            'clients' => Client::orderBy('company')->orderBy('name')->get(),
            'filters' => $filters,
        ]);
    }
}
