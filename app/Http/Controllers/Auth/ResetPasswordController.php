<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /**
     * Uso el trait ResetsPasswords para manejar la restauración de contraseñas.
     */
    use ResetsPasswords;

    /**
     * Redirijo a los usuarios después de restablecer su contraseña.
     *
     * @var string
     */
    protected $redirectTo = '/home';
}
