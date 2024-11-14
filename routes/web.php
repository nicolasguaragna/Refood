<?php  

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;

// Página principal y rutas informativas
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('quienes-somos', [\App\Http\Controllers\AboutController::class, 'about']);
Route::get('servicios', [\App\Http\Controllers\ServiciosController::class, 'index'])->name('servicios');

// Ruta para mostrar detalles de un servicio
Route::get('/servicios/{id}', [\App\Http\Controllers\ServiciosController::class, 'show'])->name('servicios.show');

// Ruta para mostrar el formulario de rescate (solo para usuarios autenticados)
Route::middleware('auth')->get('/servicios/{service_id}/rescatar', [\App\Http\Controllers\ServiciosController::class, 'showRescueForm'])->name('rescue.form');

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

// Rutas del blog
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

    // Ruta para enviar la solicitud de rescate
    Route::post('/servicios/rescatar', [\App\Http\Controllers\ServiciosController::class, 'submitRescueRequest'])->name('rescue.request');
});

// Rutas de contacto
Route::get('contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Rutas de autenticación (incluyendo restablecimiento de contraseña)
Auth::routes(['reset' => true]);

// Ruta para el home después de iniciar sesión
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas de administración para gestionar usuarios, protegidas para administradores
Route::middleware(['auth', CheckAdmin::class])->group(function () {
    Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/{id}', [\App\Http\Controllers\AdminController::class, 'show'])->name('admin.users.show');
});
