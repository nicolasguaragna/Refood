<x-layout>
    <x-slot:title>Noticias</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center">Noticias</h1>
        <a href="{{ route('noticias.create') }}" class="btn btn-success mb-3">Nueva Noticia</a>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($noticias as $noticia)
                <tr>
                    <td>{{ $noticia->titulo }}</td>
                    <td>{{ Str::limit($noticia->contenido, 50) }}</td>
                    <td>
                        @if($noticia->imagen)
                        <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="Imagen" width="100">
                        @else
                        No hay imagen
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('noticias.edit', $noticia) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('noticias.destroy', $noticia) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>