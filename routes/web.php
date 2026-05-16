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

Route::get('/precos', function () {
    return view('precos');
})->name('precos');

Route::get('/sobre-nos', function () {
    return view('sobre');
})->name('sobre');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');
Route::post('/contacto', [\App\Http\Controllers\ContactController::class, 'submit'])
    ->middleware('throttle:5,1')
    ->name('contacto.submit');

Route::get('/termos-servico', function () {
    return view('termos');
})->name('termos');

Route::get('/politica-privacidade', function () {
    return view('privacidade');
})->name('privacidade');

Route::get('/sitemap.xml', function () {
    $pages = [
        ['route' => 'home',        'file' => 'welcome'],
        ['route' => 'services',    'file' => 'services'],
        ['route' => 'precos',      'file' => 'precos'],
        ['route' => 'sobre',       'file' => 'sobre'],
        ['route' => 'contacto',    'file' => 'contacto'],
        ['route' => 'privacidade', 'file' => 'privacidade'],
        ['route' => 'termos',      'file' => 'termos'],
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
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.store');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
