<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\HourPackage;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $filters = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'project_status' => ['nullable', 'in:proposta,ativo,em_pausa,concluido,cancelado'],
            'package_status' => ['nullable', 'in:ativo,esgotado,expirado,cancelado'],
        ]);

        $from = ! empty($filters['from']) ? Carbon::parse($filters['from'])->startOfDay() : null;
        $to = ! empty($filters['to']) ? Carbon::parse($filters['to'])->endOfDay() : null;

        $projectsQuery = Project::query()->with('client');
        $packagesQuery = HourPackage::query()->with(['client', 'project']);

        if ($from) {
            $projectsQuery->where(function ($query) use ($from) {
                $query->whereDate('start_date', '>=', $from)
                    ->orWhere(function ($fallback) use ($from) {
                        $fallback->whereNull('start_date')->where('created_at', '>=', $from);
                    });
            });

            $packagesQuery->where(function ($query) use ($from) {
                $query->whereDate('purchased_at', '>=', $from)
                    ->orWhere(function ($fallback) use ($from) {
                        $fallback->whereNull('purchased_at')->where('created_at', '>=', $from);
                    });
            });
        }

        if ($to) {
            $projectsQuery->where(function ($query) use ($to) {
                $query->whereDate('start_date', '<=', $to)
                    ->orWhere(function ($fallback) use ($to) {
                        $fallback->whereNull('start_date')->where('created_at', '<=', $to);
                    });
            });

            $packagesQuery->where(function ($query) use ($to) {
                $query->whereDate('purchased_at', '<=', $to)
                    ->orWhere(function ($fallback) use ($to) {
                        $fallback->whereNull('purchased_at')->where('created_at', '<=', $to);
                    });
            });
        }

        if (! empty($filters['client_id'])) {
            $projectsQuery->where('client_id', $filters['client_id']);
            $packagesQuery->where('client_id', $filters['client_id']);
        }

        if (! empty($filters['project_status'])) {
            $projectsQuery->where('status', $filters['project_status']);
        }

        if (! empty($filters['package_status'])) {
            $packagesQuery->where('status', $filters['package_status']);
        }

        $filteredProjects = $projectsQuery->latest()->get();
        $filteredPackages = $packagesQuery->latest()->get();

        $projectProfit = (float) $filteredProjects->sum('budget');
        $packageProfit = (float) $filteredPackages->sum('price');
        $totalProfit = $projectProfit + $packageProfit;
        $profitShare = [
            'projects' => $totalProfit > 0 ? round(($projectProfit / $totalProfit) * 100) : 0,
            'packages' => $totalProfit > 0 ? round(($packageProfit / $totalProfit) * 100) : 0,
        ];

        $monthlyProfit = collect();
        $periodStart = $from ? $from->copy()->startOfMonth() : now()->subMonths(5)->startOfMonth();
        $periodEnd = $to ? $to->copy()->startOfMonth() : now()->startOfMonth();

        while ($periodStart->lessThanOrEqualTo($periodEnd)) {
            $key = $periodStart->format('Y-m');
            $monthlyProfit->put($key, [
                'label' => $periodStart->format('m/Y'),
                'projects' => 0.0,
                'packages' => 0.0,
                'total' => 0.0,
            ]);
            $periodStart->addMonth();
        }

        foreach ($filteredProjects as $project) {
            $date = ($project->start_date ?? $project->created_at)?->copy()->startOfMonth();
            $key = $date?->format('Y-m');

            if ($key && $monthlyProfit->has($key)) {
                $row = $monthlyProfit->get($key);
                $row['projects'] += (float) $project->budget;
                $row['total'] += (float) $project->budget;
                $monthlyProfit->put($key, $row);
            }
        }

        foreach ($filteredPackages as $package) {
            $date = ($package->purchased_at ?? $package->created_at)?->copy()->startOfMonth();
            $key = $date?->format('Y-m');

            if ($key && $monthlyProfit->has($key)) {
                $row = $monthlyProfit->get($key);
                $row['packages'] += (float) $package->price;
                $row['total'] += (float) $package->price;
                $monthlyProfit->put($key, $row);
            }
        }

        return view('admin.dashboard', [
            'totalServices' => Service::count(),
            'publishedServices' => Service::where('is_published', true)->count(),
            'totalLeads' => Lead::count(),
            'newLeads' => Lead::where('status', 'novo')->count(),
            'settingsCount' => SiteSetting::count(),
            'clients' => Client::orderBy('company')->orderBy('name')->get(),
            'filters' => $filters,
            'filteredProjects' => $filteredProjects,
            'filteredPackages' => $filteredPackages,
            'projectProfit' => $projectProfit,
            'packageProfit' => $packageProfit,
            'totalProfit' => $totalProfit,
            'profitShare' => $profitShare,
            'monthlyProfit' => $monthlyProfit->values(),
            'maxMonthlyProfit' => max(1, (float) $monthlyProfit->max('total')),
        ]);
    }
}
