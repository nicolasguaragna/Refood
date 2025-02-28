<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    /**
     * Muestro una lista paginada de noticias
     */
    public function index()
    {
        $noticias = Noticia::paginate(10);
        return view('noticias.index', compact('noticias'));
    }

    // Método para la vista de administración (Solo para Admin)
    public function admin()
    {
        $noticias = Noticia::all(); // Obtengo todas las noticias
        return view('noticias.admin', compact('noticias'));
    }

    /**
     * Muestro el formulario de creacion de una noticia.
     */
    public function create()
    {
        return view('noticias.create');
    }

    /**
     * Almaceno una nueva noticia en la base de datos
     */
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

        // envio mensaje flash de éxito
        return redirect()->route('noticias.admin')->with('success', 'Noticia creada con éxito.');
    }

    /**
     * Muestro una noticia específica.
     */
    public function show($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('noticias.show', compact('noticia'));
    }

    /**
     * Muestro el formulario de edición de una noticia.
     */
    public function edit(Noticia $noticia)
    {
        return view('noticias.edit', compact('noticia'));
    }

    /**
     * Actualizo una noticia en la base de datos.
     */
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

    /**
     * Elimino una noticia de la base de datos.
     */
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
