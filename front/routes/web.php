<?php

use Illuminate\Support\Facades\Route;
use App\Providers\SessionManager;

Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('login', [SessionManager::class, 'login'])->name('login');

Route::get('/products/{vue_capture?}', function () {
    return view('welcome')->with('token', session('api_token'));
})->where('vue_capture', '[\/\w\.-]*');

Route::get('/', function () {
    return view('welcome')->with('token', session('api_token'));
});
