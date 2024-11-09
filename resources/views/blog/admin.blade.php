<x-layout>
    <x-slot:title>Administrar Entradas del Blog</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Administrar Entradas del Blog</h1>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('message'))
            <div class="alert alert-{{ session('alert-type', 'success') }}">
                {{ session('message') }}
            </div>
        @endif

        <!-- Botón para crear una nueva entrada -->
        <div class="text-center mb-3">
            <a href="{{ route('blog.create') }}" class="btn btn-primary">Nueva Entrada de Blog</a>
        </div>

        <!-- Tabla con las entradas de blog existentes -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td>
                            @if ($post->author_id === auth()->id()) <!-- Solo mostrar si el post pertenece al usuario autenticado -->
                                <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('blog.destroy', $post->id) }}" method="POST" class="inline-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta entrada?')">Eliminar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
