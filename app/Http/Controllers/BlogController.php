<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy', 'admin']);
    }

    // Mostrar todos los posts (público)
    public function index()
    {
        $posts = BlogPost::all();
        return view('blog.index', compact('posts'))->with([
            'message' => 'Bienvenido al blog público.',
            'alert-type' => 'info'
        ]);
    }

    // Método para la vista de administración (diferente para admins y usuarios comunes)
    public function admin()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            // Los administradores ven todas las entradas
            $posts = BlogPost::all();
            $message = 'Panel de administración: Todos los blogs';
        } else {
            // Los usuarios comunes ven solo sus propias entradas
            $posts = BlogPost::where('author_id', $user->id)->get();
            $message = 'Tus entradas de blog';
        }

        return view('blog.admin', compact('posts'))->with([
            'message' => $message,
            'alert-type' => 'success'
        ]);
    }

    // Mostrar un post específico
    public function show($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('blog.show', compact('post'))->with([
            'message' => 'Post cargado con éxito.',
            'alert-type' => 'success'
        ]);
    }

    // Mostrar formulario para crear un nuevo post
    public function create()
    {
        return view('blog.create')->with([
            'message' => 'Formulario de creación de entrada cargado.',
            'alert-type' => 'info'
        ]);
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
            'author_id' => auth()->id(),
        ]);

        return redirect()->route('blog.admin')->with([
            'message' => 'Entrada de blog creada con éxito.',
            'alert-type' => 'success'
        ]);
    }

    // Mostrar formulario para editar un post existente
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        if ($post->author_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            return redirect()->route('blog.admin')->with([
                'message' => 'No tienes permiso para editar este post.',
                'alert-type' => 'error'
            ]);
        }

        return view('blog.edit', compact('post'))->with([
            'message' => 'Formulario de edición cargado.',
            'alert-type' => 'info'
        ]);
    }

    // Actualizar un post existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = BlogPost::findOrFail($id);
        
        if ($post->author_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            return redirect()->route('blog.admin')->with([
                'message' => 'No tienes permiso para actualizar este post.',
                'alert-type' => 'error'
            ]);
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('blog.admin')->with([
            'message' => 'Post actualizado con éxito.',
            'alert-type' => 'success'
        ]);
    }

    // Eliminar un post
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        if ($post->author_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            return redirect()->route('blog.admin')->with([
                'message' => 'No tienes permiso para eliminar este post.',
                'alert-type' => 'error'
            ]);
        }

        $post->delete();
        return redirect()->route('blog.admin')->with([
            'message' => 'Post eliminado con éxito.',
            'alert-type' => 'warning'
        ]);
    }
}

