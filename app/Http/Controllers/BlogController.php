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
            return view('blog.admin', compact('posts'))->with([
                'message' => 'Bienvenido al panel de administración de blogs.',
                'alert-type' => 'success'
            ]);
        } else {
            // Para usuarios no autenticados, mostramos todos los posts
            $posts = BlogPost::all();
            return view('blog.index', compact('posts'))->with([
                'message' => 'Bienvenido al blog público.',
                'alert-type' => 'info'
            ]);
        }
    }

    public function admin()
    {
        $user = Auth::user(); // Usuario autenticado
        $posts = BlogPost::where('author_id', $user->id)->get(); // Posts del autor autenticado
        return view('blog.admin', compact('posts'))->with([
            'message' => 'Administración de entradas del blog.',
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
            'author_id' => auth()->id(), // Obtener el ID del usuario autenticado
        ]);

        return redirect()->route('blog.index')->with([
            'message' => 'Entrada de blog creada con éxito.',
            'alert-type' => 'success'
        ]);
    }

    // Mostrar formulario para editar un post existente
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        // Asegurarse de que el usuario solo puede editar sus propios posts
        if ($post->author_id !== auth()->id()) {
            return redirect()->route('blog.index')->with([
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
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth()->id(), // Actualizar el autor si es necesario
        ]);

        return redirect()->route('blog.index')->with([
            'message' => 'Post actualizado con éxito.',
            'alert-type' => 'success'
        ]);
    }

    // Eliminar un post
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        // Asegurarse de que el usuario solo puede eliminar sus propios posts
        if ($post->author_id !== auth()->id()) {
            return redirect()->route('blog.index')->with([
                'message' => 'No tienes permiso para eliminar este post.',
                'alert-type' => 'error'
            ]);
        }

        $post->delete();
        return redirect()->route('blog.index')->with([
            'message' => 'Post eliminado con éxito.',
            'alert-type' => 'warning'
        ]);
    }
}
