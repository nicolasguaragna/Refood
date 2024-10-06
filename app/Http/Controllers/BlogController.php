<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Mostrar todos los posts
    public function index()
    {
        $posts = BlogPost::all();
        return view('blog.index', compact('posts'));
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
            'author_id' => 'required|exists:users,id',
        ]);

        BlogPost::create($request->all());

        return redirect()->route('blog.index')->with('success', 'Post creado con éxito.');
    }

    // Mostrar formulario para editar un post existente
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('blog.edit', compact('post'));
    }

    // Actualizar un post existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author_id' => 'required|exists:users,id',
        ]);

        $post = BlogPost::findOrFail($id);
        $post->update($request->all());

        return redirect()->route('blog.index')->with('success', 'Post actualizado con éxito.');
    }

    // Eliminar un post
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        return redirect()->route('blog.index')->with('success', 'Post eliminado con éxito.');
    }
}
