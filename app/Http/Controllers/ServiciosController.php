<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\RescueRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiciosController extends Controller
{
    /**
     * Muestro la lista de todos los servicios disponibles
     */
    public function index()
    {
        $services = Service::all(); // obtengo todos los servicios

        return view('servicios', [
            'services' => $services,
        ]);
    }

    /**
     * Muestro los detalles de un servicio específico.
     * 
     * @param int $service_id
     * @return \Illuminate\View\View
     */
    public function show($service_id)
    {
        $service = Service::findOrFail($service_id); // Encuentro el servicio por ID
        return view('servicios.show', compact('service')); // Paso el servicio a la vista
    }

    /**
     * Muestro el formulario para solicitar un rescate asociado a un servicio.
     * 
     * @param int $service_id
     * @return \Illuminate\View\View
     */
    public function showRescueForm($service_id)
    {
        $service = Service::findOrFail($service_id);
        $googleMapsApiKey = config('services.google_maps.api_key');

        return view('rescues.rescue', compact('service', 'googleMapsApiKey'));
    }

    /**
     * Proceso una solicitud de rescate de un servicio.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitRescueRequest(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required|string|max:255',
                'contact' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'details' => 'required|string',
                'service_id' => 'required|exists:services,service_id',
                'rescue_date' => 'required|date',
            ]);

            RescueRequest::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'contact' => $request->contact,
                'location' => $request->location,
                'details' => $request->details,
                'service_id' => $request->service_id,
                'rescue_date' => $request->rescue_date,
            ]);

            return redirect()->route('servicios')->with([
                'message' => 'Gracias por tu aporte, ¡Cada Plato Cuenta!',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Debes iniciar sesión para solicitar un rescate.',
            'alert-type' => 'danger'
        ]);
    }

    /**
     * Muestrp los detalles de un usuario, incluyendo sus solicitudes de rescate.
     * 
     * @param int $userId
     * @return \Illuminate\View\View
     */
    public function showUserDetails($userId)
    {
        $user = User::findOrFail($userId); // Encuentra al usuario por su ID

        // obtengo los rescates asociados al usuario y los ordeno por fecha de creación descendente
        $rescues = $user->rescueRequests()
            ->with('service')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.show', compact('user', 'rescues'));
    }
}
