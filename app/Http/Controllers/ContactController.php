<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Método para mostrar la vista de contacto
    public function index()
    {
        return view('contact'); // Asegúrate de tener el archivo 'contact.blade.php' en 'resources/views'
    }

    // Método para manejar el envío del formulario de contacto y guardar el mensaje en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'mensaje' => 'required|string',
        ]);

        // Guardar el mensaje en la base de datos
        ContactMessage::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'mensaje' => $request->mensaje,
        ]);

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Tu mensaje ha sido enviado con éxito.');
    }
}
