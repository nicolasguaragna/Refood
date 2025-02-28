<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Uso el trait AuthenticatesUsers para manejar la autenticación de usuarios.
     */

    use AuthenticatesUsers;

    /**
     * Redirección después de un inicio de sesión exitoso.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Creo una nueva instancia del controlador.
     *
     * Aplicp middleware:
     * - 'guest' para evitar que usuarios autenticados accedan al login.
     * - 'auth' solo para el método logout.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Cierro la sesión del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token CSRF

        return redirect('/login') // Redirecciona al login
            ->with('feedback.message', 'Sesión cerrada con éxito. ¡Te esperamos pronto!');
    }
}
