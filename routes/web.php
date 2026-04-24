<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/servicos', function () {
    return view('services');
})->name('services');
Route::get('/termos-servico', function () {
    return view('termos');
})->name('termos');

Route::get('/politica-privacidade', function () {
    return view('privacidade');
})->name('privacidade');
