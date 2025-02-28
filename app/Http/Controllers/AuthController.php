<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Muestra el formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Se procesa el registro de usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('message', 'Registro exitoso. ¡Bienvenido!');
    }

    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Se procesa el inicio de sesión de usuario
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home')->with('message', 'Sesión iniciada correctamente.');
        }

        return back()->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.']);
    }

    // Cierra la sesión del usuario
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home')->with('message', 'Sesión cerrada correctamente.');
    }
}
