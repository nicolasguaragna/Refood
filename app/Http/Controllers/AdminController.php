<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestro la lista de todos los usuarios registrados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.users', compact('users'));
    }

    /**
     * Muestro los detalles de un usuario específico, incluyendo sus rescates y servicios asociados.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Cargo el usuario junto con sus rescates y los servicios asociados
        $user = User::with('rescueRequests.service')->findOrFail($id);
        $rescues = $user->rescueRequests; // obtengo las solicitudes de rescate
        return view('admin.users.show', compact('user', 'rescues'));
    }
}
