<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/servicos', function () {
    return view('services');
})->name('services');

Route::get('/sobre-nos', function () {
    return view('sobre');
})->name('sobre');
Route::get('/termos-servico', function () {
    return view('termos');
})->name('termos');

Route::get('/politica-privacidade', function () {
    return view('privacidade');
})->name('privacidade');

Route::get('/sitemap.xml', function () {
    $pages = [
        ['route' => 'home',        'file' => 'welcome',    'priority' => '1.0'],
        ['route' => 'services',    'file' => 'services',   'priority' => '0.9'],
        ['route' => 'sobre',       'file' => 'sobre',      'priority' => '0.8'],
        ['route' => 'privacidade', 'file' => 'privacidade','priority' => '0.3'],
        ['route' => 'termos',      'file' => 'termos',     'priority' => '0.3'],
    ];

    foreach ($pages as &$page) {
        $path = resource_path("views/{$page['file']}.blade.php");
        $page['lastmod'] = date('Y-m-d', File::lastModified($path));
    }

    return response()
        ->view('sitemap', compact('pages'))
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.store');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
