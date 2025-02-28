<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{

    /**
     * Uso el trait VerifiesEmails para manejar la verificación de correos electrónicos.
     */
    use VerifiesEmails;

    /**
     * Redirijo a los usuarios después de la verificación del correo.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Creo una nueva instancia del controlador.
     *
     * Aplico los siguientes middlewares:
     * - 'auth' para asegurar que solo usuarios autenticados puedan acceder.
     * - 'signed' solo en la verificación para asegurar enlaces firmados.
     * - 'throttle' para limitar intentos de verificación y reenvío de correos.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
