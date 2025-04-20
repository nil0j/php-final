<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [RegisterController::class, 'login']);
});

// Route::resource('products', ProductController::class);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
