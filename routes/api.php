<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/items', [ProductController::class, 'index']);
Route::get('/items/{id}', [ProductController::class, 'show']);
Route::post('/items', [ProductController::class, 'store']);
Route::put('/items/{id}', [ProductController::class, 'update']);
Route::delete('/items/{id}', [ProductController::class, 'destroy']);
