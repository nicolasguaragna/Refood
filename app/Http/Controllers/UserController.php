<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validar los datos ingresados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Actualizar nombre y correo
        $user->name = $request->name;
        $user->email = $request->email;

        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        // Guardar cambios
        $user->save();

        return redirect()->route('profile.show')->with([
            'success' => 'Tu perfil ha sido actualizado con éxito.',
        ]);
    }
}
