<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\RescueRequest; // Asegúrate de importar el modelo de RescueRequest

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

    public function services()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $services = $user->rescueRequests()->with('service')->get(); // Cargar servicios asociados

        $user->unreadNotifications->markAsRead(); // Marcar como leídas las notificaciones

        return view('profile.user-services', compact('services'));
    }

    public function cancelService($id)
    {
        $rescueRequest = RescueRequest::where('id', $id)
            ->where('user_id', Auth::id()) // Asegurar que el usuario autenticado es dueño del servicio
            ->firstOrFail();

        $rescueRequest->delete(); // Eliminar el servicio
        return redirect()->route('user.services')->with('success', 'Servicio cancelado con éxito.');
    }

    public function updateService(Request $request, $id)
    {
        $rescueRequest = RescueRequest::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'contact' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        $rescueRequest->update($request->only('contact', 'location', 'details'));

        return redirect()->route('user.services')->with('success', 'Detalles del servicio actualizados.');
    }
    public function editService($id)
    {
        $service = RescueRequest::where('id', $id)
            ->where('user_id', Auth::id()) // Asegura que solo el propietario pueda editar
            ->firstOrFail();

        return view('profile.edit-service', compact('service'));
    }
}
