<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\RescueRequestController;
use App\Http\Controllers\MercadoPagoController;

// Página principal y rutas informativas
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('quienes-somos', [\App\Http\Controllers\AboutController::class, 'about']);
Route::get('servicios', [\App\Http\Controllers\ServiciosController::class, 'index'])->name('servicios');

// Ruta para mostrar detalles de un servicio
Route::get('/servicios/{id}', [\App\Http\Controllers\ServiciosController::class, 'show'])->name('servicios.show');

// Rutas de donación
Route::get('/donate', [MercadoPagoController::class, 'showDonationForm'])->name('donate.form');
Route::post('/donate/process', [MercadoPagoController::class, 'processDonation'])->name('donate.process');
Route::get('/donate/success', fn() => view('donate-success'))->name('donate.success');
Route::get('/donate/failure', fn() => view('donate-failure'))->name('donate.failure');
Route::get('/donate/pending', fn() => view('donate-pending'))->name('donate.pending');
Route::get('/donate/index', fn() => redirect('/donate'))->name('donate.index');


// Ruta para mostrar el formulario de rescate (solo para usuarios autenticados)
Route::middleware('auth')->get('/servicios/{service_id}/rescatar', [\App\Http\Controllers\ServiciosController::class, 'showRescueForm'])->name('rescue.form');

// Rutas de autenticación personalizadas (registro y login)
Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Rutas de administración de usuarios protegidas para administradores
Route::middleware(['auth', CheckAdmin::class])->group(function () {
    Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.users');
    Route::patch('/admin/rescue/{id}/update-status', [RescueRequestController::class, 'updateStatus'])->name('admin.rescue.updateStatus');
});

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

// Rutas de pago de servicios de rescate con Mercado Pago
Route::get('/services/{id}/pay', [MercadoPagoController::class, 'payService'])->name('services.pay');
Route::get('/services/{id}/payment/success', [MercadoPagoController::class, 'paymentSuccess'])->name('services.payment.success');
Route::get('/services/{id}/payment/failure', [MercadoPagoController::class, 'paymentFailure'])->name('services.payment.failure');
Route::get('/services/{id}/payment/pending', [MercadoPagoController::class, 'paymentPending'])->name('services.payment.pending');

// Rutas de contacto
Route::get('contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Rutas de solicitudes de rescate
Route::middleware(['auth'])->group(function () {
    Route::get('rescates', [RescueRequestController::class, 'index'])->name('rescue.index');
    Route::get('rescates/create', [RescueRequestController::class, 'create'])->name('rescue.create');
    Route::post('rescates', [RescueRequestController::class, 'store'])->name('rescue.request');
});

// Rutas de autenticación (incluyendo restablecimiento de contraseña)
Auth::routes(['reset' => true]);

// Ruta para el home después de iniciar sesión
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
