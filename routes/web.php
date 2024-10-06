<?php

use Illuminate\Support\Facades\Route;

// version controller
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('quienes-somos', [\App\Http\Controllers\AboutController::class, 'about']);
Route::get('servicios', [\App\Http\Controllers\ServiciosController::class, 'index']);
Route::get('blog', [\App\Http\Controllers\BlogController::class, 'index']);
Route::get('contact', [\App\Http\Controllers\ContactController::class, 'index']);
Route::get('/donations', [\App\Http\Controllers\DonationsController::class, 'index']);
Route::get('/servicios/{id}', [\App\Http\Controllers\ServiciosController::class, 'show']);
Route::get('blog/{id}', [\App\Http\Controllers\BlogController::class, 'show']);

// Protejo las rutas del blog que requieren autenticación con el middleware 'auth'
Route::middleware('auth')->group(function () {
    Route::get('/donations/create', [\App\Http\Controllers\DonationsController::class, 'create']);
    Route::post('/donations', [\App\Http\Controllers\DonationsController::class, 'store']);
    Route::get('/blog/create', [\App\Http\Controllers\BlogController::class, 'create']);
    Route::post('/blog', [\App\Http\Controllers\BlogController::class, 'store']);
    Route::get('/blog/{id}/edit', [\App\Http\Controllers\BlogController::class, 'edit']);
    Route::put('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'update']);
    Route::delete('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'destroy']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
