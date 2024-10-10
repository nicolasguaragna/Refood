<?php

use Illuminate\Support\Facades\Route;

// version controller
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('quienes-somos', [\App\Http\Controllers\AboutController::class, 'about']);
Route::get('servicios', [\App\Http\Controllers\ServiciosController::class, 'index']);
Route::get('blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::get('/donations', [\App\Http\Controllers\DonationsController::class, 'index']);
Route::get('/servicios/{id}', [\App\Http\Controllers\ServiciosController::class, 'show']);
Route::get('blog/{id}', [\App\Http\Controllers\BlogController::class, 'show']);

// Protejo las rutas del blog que requieren autenticación con el middleware 'auth'
Route::middleware('auth')->group(function () {
    Route::get('/donations/create', [\App\Http\Controllers\DonationsController::class, 'create']);
    Route::post('/donations', [\App\Http\Controllers\DonationsController::class, 'store']);
    
    // Rutas CRUD para el blog
    Route::get('blog/admin', [\App\Http\Controllers\BlogController::class, 'admin'])->name('blog.admin');
    Route::get('/blog/create', [\App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog', [\App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}/edit', [\App\Http\Controllers\BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'destroy'])->name('blog.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('cerrar-sesion', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('auth.logout');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');