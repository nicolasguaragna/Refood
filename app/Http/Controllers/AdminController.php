<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Método para mostrar la lista de todos los usuarios
    public function index()
    {
        $users = User::all();
        return view('admin.users.users', compact('users'));
    }

    // Método para mostrar los detalles de un usuario específico, incluyendo rescates y servicios
    public function show($id)
    {
        // Cargo el usuario junto con sus rescates y los servicios asociados
        $user = User::with('rescueRequests.service')->findOrFail($id);
        $rescues = $user->rescueRequests; // obtengo las solicitudes de rescate
        return view('admin.users.show', compact('user', 'rescues'));
    }
}
