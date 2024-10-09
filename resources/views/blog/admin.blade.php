<x-layout>
    <x-slot:title>Administrar Entradas del Blog</x-slot>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Administrar Entradas del Blog</h1>

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
                            <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('blog.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta entrada?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
