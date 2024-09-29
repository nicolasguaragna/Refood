<?php

use Illuminate\Support\Facades\Route;

// version controller
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/quienes-somos', [\App\Http\Controllers\AboutController::class, 'about']);
Route::get('/servicios', [\App\Http\Controllers\ServiciosController::class, 'index']);
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index']);
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index']);

