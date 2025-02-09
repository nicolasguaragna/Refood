<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;

// Página principal y rutas informativas
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('quienes-somos', [\App\Http\Controllers\AboutController::class, 'about']);
Route::get('servicios', [\App\Http\Controllers\ServiciosController::class, 'index'])->name('servicios');

// Ruta para mostrar detalles de un servicio
Route::get('/servicios/{id}', [\App\Http\Controllers\ServiciosController::class, 'show'])->name('servicios.show');

// Rutas de donación
Route::get('/donate', [\App\Http\Controllers\MercadoPagoController::class, 'show'])->name('donate.show');
Route::get('/donate/index', fn() => redirect('/donate'))->name('donate.index');
Route::get('/donate/success', fn() => view('donate-success'))->name('donate.success');
Route::get('/donate/failure', fn() => view('donate-failure'))->name('donate.failure');
Route::get('/donate/pending', fn() => view('donate-pending'))->name('donate.pending');

// Ruta para mostrar el formulario de rescate (solo para usuarios autenticados)
Route::middleware('auth')->get('/servicios/{service_id}/rescatar', [\App\Http\Controllers\ServiciosController::class, 'showRescueForm'])->name('rescue.form');

// Rutas de autenticación personalizadas (registro y login)
Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Rutas del blog protegidas para administradores
Route::middleware(['auth', CheckAdmin::class])->group(function () {
    Route::get('blog/admin', [\App\Http\Controllers\BlogController::class, 'admin'])->name('blog.admin');
    Route::get('/blog/{id}/edit', [\App\Http\Controllers\BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'destroy'])->name('blog.destroy');

    // Rutas de administración de usuarios
    Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/{id}', [\App\Http\Controllers\AdminController::class, 'show'])->name('admin.users.show');
});

// Rutas del blog accesibles para todos los usuarios
Route::get('blog/create', [\App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');
Route::get('blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{id}', [\App\Http\Controllers\BlogController::class, 'show']);
Route::middleware('auth')->post('/blog', [\App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');

// Rutas de noticias protegidas para administradores
Route::middleware(['auth', CheckAdmin::class])->group(function () {
    Route::get('noticias/admin', [\App\Http\Controllers\NoticiaController::class, 'admin'])->name('noticias.admin');
    Route::resource('noticias', \App\Http\Controllers\NoticiaController::class)->except(['show']);
    Route::get('noticias/create', [\App\Http\Controllers\NoticiaController::class, 'create'])->name('noticias.create');
    Route::post('noticias', [\App\Http\Controllers\NoticiaController::class, 'store'])->name('noticias.store');
    Route::get('noticias/{id}/edit', [\App\Http\Controllers\NoticiaController::class, 'edit'])->name('noticias.edit');
    Route::put('noticias/{id}', [\App\Http\Controllers\NoticiaController::class, 'update'])->name('noticias.update');
    Route::delete('noticias/{id}', [\App\Http\Controllers\NoticiaController::class, 'destroy'])->name('noticias.destroy');
});

// Ruta pública para la lista de noticias
Route::get('noticias', [\App\Http\Controllers\NoticiaController::class, 'index'])->name('noticias.index');

// Ruta pública para mostrar el detalle de una noticia
Route::get('noticias/{id}', [\App\Http\Controllers\NoticiaController::class, 'show'])->name('noticias.show');

// Rutas de perfil para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\UserController::class, 'update'])->name('profile.update');
    Route::post('/servicios/rescatar', [\App\Http\Controllers\ServiciosController::class, 'submitRescueRequest'])->name('rescue.request');

    // Rutas para administración de servicios del usuario
    Route::get('/profile/services', [\App\Http\Controllers\UserController::class, 'services'])->name('user.services');
    Route::get('/profile/services/{id}/edit', [\App\Http\Controllers\UserController::class, 'editService'])->name('services.edit');
    Route::put('/profile/services/{id}', [\App\Http\Controllers\UserController::class, 'updateService'])->name('services.update');
    Route::delete('/profile/services/{id}', [\App\Http\Controllers\UserController::class, 'cancelService'])->name('services.cancel');
});

// Rutas de contacto
Route::get('contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Rutas de autenticación (incluyendo restablecimiento de contraseña)
Auth::routes(['reset' => true]);

// Ruta para el home después de iniciar sesión
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
