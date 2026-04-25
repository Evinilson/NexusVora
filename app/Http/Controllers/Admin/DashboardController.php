<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'totalServices' => Service::count(),
            'publishedServices' => Service::where('is_published', true)->count(),
            'totalLeads' => Lead::count(),
            'newLeads' => Lead::where('status', 'novo')->count(),
            'settingsCount' => SiteSetting::count(),
        ]);
    }
}
