<?php

use Illuminate\Support\Facades\Route;

// version closure

//Route::get('/', function () {
//    return view('welcome');
//});

// version controller
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Route::get('/quienes-somos', [\App\Http\Controllers\AboutController::class, 'about']);