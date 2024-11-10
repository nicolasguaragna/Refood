<?php 

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\RescueRequest; // Asegúrate de tener este modelo
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

    public function showRescueForm($service_id)
    {
        $service = Service::findOrFail($service_id); // Encuentra el servicio por ID
        return view('rescues.rescue', compact('service')); // Pasa el servicio a la vista
    }

    public function submitRescueRequest(Request $request)
    {
        // Verificar que el usuario esté autenticado
        if (Auth::check()) {
            // Validar los datos de la solicitud de rescate
            $request->validate([
                'name' => 'required|string|max:255',
                'contact' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'details' => 'required|string',
                'service_id' => 'required|exists:services,service_id', // Asegurarse de que el servicio existe
            ]);

            // Guardar la solicitud en la base de datos
            RescueRequest::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'contact' => $request->contact,
                'location' => $request->location,
                'details' => $request->details,
                'service_id' => $request->service_id,
            ]);

            return redirect()->route('servicios')->with([
                'message' => 'Tu solicitud de rescate ha sido enviada exitosamente. ¡Gracias!',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Debes iniciar sesión para solicitar un rescate.',
            'alert-type' => 'danger'
        ]);
    }
}
