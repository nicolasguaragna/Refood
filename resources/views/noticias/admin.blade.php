<x-layout>
    <x-slot:title>Administrar Noticias</x-slot:title>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Administrar Noticias</h1>

        <!-- Botón para crear nueva noticia -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('noticias.create') }}" class="btn btn-success">Nueva Noticia</a>
        </div>

        <!-- Tabla de noticias -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Imagen</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($noticias as $noticia)
                    <tr>
                        <td>{{ $noticia->id }}</td>
                        <td>{{ $noticia->titulo }}</td>
                        <td>
                            @if($noticia->imagen)
                            <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="Imagen Noticia" class="img-thumbnail" width="100">
                            @else
                            <span>Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $noticia->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta noticia?');">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>