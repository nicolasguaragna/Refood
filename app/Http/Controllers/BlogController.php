<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    // Mostrar todos los posts
    public function index()
    {
        if (Auth::check()) {
            // Si el usuario está autenticado, muestra solo sus posts
            $user = Auth::user();
            $posts = BlogPost::where('author_id', $user->id)->get();
        } else {
            // Si no está autenticado, muestra todos los posts
            $posts = BlogPost::all();
        }
    
        return view('blog.admin', compact('posts')); // Vista de administración o index del blog
    }

    // Mostrar un post específico
    public function show($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('blog.show', compact('post'));
    }

    // Mostrar formulario para crear un nuevo post
    public function create()
    {
        return view('blog.create');
    }

    // Guardar un nuevo post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        BlogPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth()->id(), // Obtener el ID del usuario autenticado
        ]);

        return redirect()->route('blog.index')->with('success', 'Entrada de blog creada con éxito.');
    }

    // Mostrar formulario para editar un post existente
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        // Asegurarse de que el usuario solo puede editar sus propios posts
        if ($post->author_id !== auth()->id()) {
            return redirect()->route('blog.index')->with('error', 'No tienes permiso para editar este post.');
        }

        return view('blog.edit', compact('post'));
    }

    // Actualizar un post existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = BlogPost::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth()->id(), // Actualizar el autor si es necesario
        ]);

        return redirect()->route('blog.index')->with('success', 'Post actualizado con éxito.');
    }

    // Eliminar un post
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        // Asegurarse de que el usuario solo puede eliminar sus propios posts
        if ($post->author_id !== auth()->id()) {
            return redirect()->route('blog.index')->with('error', 'No tienes permiso para eliminar este post.');
        }

        $post->delete();
        return redirect()->route('blog.index')->with('success', 'Post eliminado con éxito.');
    }
}
