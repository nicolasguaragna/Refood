<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::paginate(10);
        return view('noticias.index', compact('noticias'));
    }

    // Método para la vista de administración (Solo para Admin)
    public function admin()
    {
        $noticias = Noticia::all(); // Obtener todas las noticias
        return view('noticias.admin', compact('noticias'));
    }

    public function create()
    {
        return view('noticias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('images', 'public');
        }

        Noticia::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'imagen' => $imagePath,
        ]);

        // Enviar mensaje flash de éxito
        return redirect()->route('noticias.admin')->with('success', 'Noticia creada con éxito.');
    }

    public function show($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('noticias.show', compact('noticia'));
    }

    public function edit(Noticia $noticia)
    {
        return view('noticias.edit', compact('noticia'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
        ]);

        $noticia = Noticia::findOrFail($id);
        $data = $request->only(['titulo', 'contenido']);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($noticia->imagen) {
                \Storage::disk('public')->delete($noticia->imagen);
            }
            // Guardar la nueva imagen
            $data['imagen'] = $request->file('imagen')->store('images', 'public');
        }

        $noticia->update($data);

        return redirect()->route('noticias.admin')->with('success', 'Noticia actualizada con éxito.');
    }

    public function destroy(Noticia $noticia)
    {
        if ($noticia->imagen) {
            Storage::disk('public')->delete($noticia->imagen);
        }
        // Elimino la noticia de la base de datos
        $noticia->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('noticias.admin')->with([
            'message' => 'Noticia eliminada con éxito.',
            'alert-type' => 'success',
        ]);
    }
}
