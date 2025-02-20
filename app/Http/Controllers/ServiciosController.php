<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\RescueRequest; // Asegúrate de tener este modelo
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiciosController extends Controller
{
    public function index()
    {
        /*traigo los registros de la tabla services con eloquent.*/
        $services = Service::all(); // Obtener todos los servicios

        return view('servicios', [
            'services' => $services,
        ]);
    }

    // Método para mostrar los detalles del servicio
    public function show($service_id)
    {
        $service = Service::findOrFail($service_id); // Encuentra el servicio por ID
        return view('servicios.show', compact('service')); // Pasa el servicio a la vista
    }

    public function showRescueForm($service_id)
    {
        $service = Service::findOrFail($service_id);
        $googleMapsApiKey = config('services.google_maps.api_key'); // Carga la clave desde config/services.php

        return view('rescues.rescue', compact('service', 'googleMapsApiKey'));
    }


    public function submitRescueRequest(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required|string|max:255',
                'contact' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'details' => 'required|string',
                'service_id' => 'required|exists:services,service_id', // Cambiado para usar la clave primaria correcta
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

    public function showUserDetails($userId)
    {
        $user = User::findOrFail($userId); // Encuentra al usuario por su ID

        // Ordenar los rescates asociados al usuario por created_at DESC
        $rescues = $user->rescueRequests()
            ->with('service') // Incluir la relación con el modelo Service
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.show', compact('user', 'rescues'));
    }
}
