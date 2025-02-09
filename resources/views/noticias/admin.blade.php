<x-layout>
    <x-slot:title>Administrar Noticias</x-slot:title>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Administrar Noticias</h1>

        <!-- Mostrar mensaje de éxito si existe -->
        @if (session('success'))
        <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

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

    <!-- Script para hacer que el mensaje flash desaparezca -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const flashMessage = document.getElementById("flash-message");
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.remove("show"); // Quita la clase `show` para iniciar la transición
                    flashMessage.addEventListener("transitionend", () => {
                        flashMessage.remove(); // Elimina el mensaje del DOM
                    });
                }, 4000); // Desaparece después de 4 segundos
            }
        });
    </script>
</x-layout>