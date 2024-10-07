<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()
            ->intended(route('services.index'))
            ->with('feedback.message', 'Sesion iniciada con éxito. ¡Bienvenido a Refood!');
        }

        return redirect()
        ->back()
        ->withInput()
        ->with('feedbac.message', 'Credenciales ingresadas no coinciden con nuestros registros.');
        
        
    }
}
