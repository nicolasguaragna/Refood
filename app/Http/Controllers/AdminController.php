<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Método para mostrar la lista de todos los usuarios
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Método para mostrar los detalles de un usuario específico
    public function show($id)
    {
        $user = User::findOrFail($id);
        $service = Service::where('user_id', $id)->first(); // Ajusta si tu relación usuario-servicio es diferente
        return view('admin.users.show', compact('user', 'service'));
    }
}

