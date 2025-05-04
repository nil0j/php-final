<?php

use Illuminate\Support\Facades\Route;
use App\Providers\SessionManager;

Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('login', [SessionManager::class, 'login'])->name('login');

Route::get('/products/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
