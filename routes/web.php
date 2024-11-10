<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;

// Página principal y rutas informativas
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('quienes-somos', [\App\Http\Controllers\AboutController::class, 'about']);
Route::get('servicios', [\App\Http\Controllers\ServiciosController::class, 'index']);
Route::get('/servicios/{id}', [\App\Http\Controllers\ServiciosController::class, 'show']);

// Ruta para solicitar rescate (solo para usuarios autenticados)
Route::middleware('auth')->post('servicios/rescatar', [\App\Http\Controllers\ServiciosController::class, 'requestRescue'])->name('rescue.request');

// Rutas de autenticación personalizadas (registro y login)
Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Ruta del blog para administración (protegida con CheckAdmin middleware)
Route::middleware([CheckAdmin::class])->group(function () {
    Route::get('blog/admin', [\App\Http\Controllers\BlogController::class, 'admin'])->name('blog.admin');
});

// Rutas del blog (asegúrate de que las rutas específicas estén antes que las dinámicas)
Route::get('blog/create', [\App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');
Route::get('blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{id}', [\App\Http\Controllers\BlogController::class, 'show']);

// Protejo las rutas del blog que requieren autenticación con el middleware 'auth'
Route::middleware('auth')->group(function () {
    Route::post('/blog', [\App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}/edit', [\App\Http\Controllers\BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'destroy'])->name('blog.destroy');
    Route::get('/donations/create', [\App\Http\Controllers\DonationsController::class, 'create']);
    Route::post('/donations', [\App\Http\Controllers\DonationsController::class, 'store']);
});

// Rutas de contacto
Route::get('contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Rutas de autenticación (incluyendo restablecimiento de contraseña)
Auth::routes(['reset' => true]);

// Ruta para el home después de iniciar sesión
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
