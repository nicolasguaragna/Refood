<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy', 'admin']);
    }

    // Mostrar todos los posts (público)
    public function index()
    {
        // Ordenar las entradas por fecha de creación (descendente)
        $posts = BlogPost::orderBy('created_at', 'desc')->get();
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
            // Los administradores ven todas las entradas, ordenadas por fecha descendente
            $posts = BlogPost::orderBy('created_at', 'desc')->get();
            $message = 'Panel de administración: Todos los blogs';
        } else {
            // Los usuarios comunes ven solo sus propias entradas, ordenadas por fecha descendente
            $posts = BlogPost::where('author_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validación de la imagen
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        BlogPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth()->id(),
            'image_path' => $imagePath,
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = BlogPost::findOrFail($id);

        if ($post->author_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            return redirect()->route('blog.admin')->with([
                'message' => 'No tienes permiso para actualizar este post.',
                'alert-type' => 'error'
            ]);
        }

        if ($request->hasFile('image')) {
            // Eliminar la imagen antigua si existe
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            // Almacenar la nueva imagen
            $post->image_path = $request->file('image')->store('images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $post->image_path,
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

        // Eliminar la imagen si existe
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();
        return redirect()->route('blog.admin')->with([
            'message' => 'Post eliminado con éxito.',
            'alert-type' => 'warning'
        ]);
    }
}
