<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RescueRequest;
use App\Notifications\RescueStatusUpdated;


class RescueRequestController extends Controller
{
    /**
     * Muestra todas las solicitudes de rescate.
     */
    public function index()
    {
        $rescueRequests = RescueRequest::orderBy('created_at', 'desc')->get();
        return view('rescues.index', compact('rescueRequests'));
    }

    /**
     * Muestra el formulario para crear una nueva solicitud de rescate.
     */
    public function create()
    {
        return view('rescues.rescue', ['googleMapsApiKey' => env('GOOGLE_MAPS_API_KEY')]);
    }

    /**
     * Guarda una nueva solicitud de rescate en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'contact' => 'required|max:255',
            'location' => 'required|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'details' => 'required',
            'rescue_date' => 'required|date',
        ]);

        RescueRequest::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'name' => $request->name,
            'contact' => $request->contact,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'details' => $request->details,
            'rescue_date' => $request->rescue_date,
        ]);

        return redirect()->route('user.services')->with('success', 'Solicitud de rescate creada con éxito. Aquí puedes ver los servicios solicitados y el estado de cada uno.');
    }

    public function updateStatus(Request $request, $id)
    {
        $rescue = RescueRequest::findOrFail($id);
        $rescue->status = $request->status;
        $rescue->save();

        // Enviar una notificación al usuario
        $user = $rescue->user;
        if ($user) {
            $user->notify(new RescueStatusUpdated($rescue));
        }

        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }
}
