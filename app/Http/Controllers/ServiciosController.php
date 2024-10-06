<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function index()
    {
        /*traigo los registros de la tabla services con eloquent.*/

        $services = Service::all(); // Obtener todos los servicios

        //dump and die.
        //dd($services);

        return view('servicios', [
            'services' => $services,
        ]);
    }

    public function show($id)
    {
        $service = Service::findOrFail($id); // Buscar el servicio por ID
        return view('show', compact('service')); // Pasar el servicio a la vista
    }
}
