<?php 

namespace App\Http\Controllers;

use App\Models\Service;
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

    public function show($id)
    {
        $service = Service::findOrFail($id); // Buscar el servicio por ID
        return view('show', compact('service')); // Pasar el servicio a la vista
    }

    public function requestRescue(Request $request)
    {
        // Verificar que el usuario esté autenticado y sea un usuario común
        if (Auth::check() && Auth::user()->hasRole('user')) {
            // Lógica para registrar la solicitud de rescate
            // Aquí puedes guardar el rescate en una tabla o enviar una notificación, según tus necesidades
            $serviceId = $request->input('service_id');

            // Simulación de registro del rescate (puedes adaptar esto a tus necesidades)
            // Ejemplo: Rescues::create(['user_id' => Auth::id(), 'service_id' => $serviceId]);

            return redirect()->back()->with([
                'message' => 'Solicitud de rescate enviada con éxito.',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Acceso denegado. Solo los usuarios comunes pueden solicitar rescates.',
            'alert-type' => 'danger'
        ]);
    }
}
