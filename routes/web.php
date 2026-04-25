<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.store');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
