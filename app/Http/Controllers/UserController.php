<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\RescueRequest;

class UserController extends Controller
{
    /**
     *  Muestro la información del perfil del usuario autenticado.
     */
    public function show()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('profile.show', compact('user'));
    }

    /**
     * Muestro el formulario para editar la información del perfil.
     */
    public function edit()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('profile.edit', compact('user'));
    }

    /**
     * Actualizo la información del perfil del usuario autenticado.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Valido los datos ingresados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Actualizo nombre y correo
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Si se proporciona una nueva contraseña la actualizo
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        // Guardo cambios
        $user->save();

        return redirect()->route('profile.show')->with([
            'success' => 'Tu perfil ha sido actualizado con éxito.',
        ]);
    }

    /**
     * Muestro los servicios de rescate asociados al usuario autenticado.
     */
    public function services()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $services = $user->rescueRequests()->with('service')->get(); // Cargar servicios asociados

        $user->unreadNotifications->markAsRead(); // Marcar como leídas las notificaciones

        return view('profile.user-services', compact('services'));
    }

    /**
     * Cancelo un servicio de rescate solicitado por el usuario.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelService($id)
    {
        $rescueRequest = RescueRequest::where('id', $id)
            ->where('user_id', Auth::id()) // Asegurar que el usuario autenticado es dueño del servicio
            ->firstOrFail();

        $rescueRequest->delete(); // Eliminar el servicio
        return redirect()->route('user.services')->with('success', 'Servicio cancelado con éxito.');
    }

    /**
     * Actualizo los detalles de un servicio de rescate.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Muestro el formulario de edición de un servicio de rescate solicitado por el usuario.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function editService($id)
    {
        $service = RescueRequest::where('id', $id)
            ->where('user_id', Auth::id()) // Aseguro que solo el propietario pueda editar
            ->firstOrFail();

        return view('profile.edit-service', compact('service'));
    }
}
