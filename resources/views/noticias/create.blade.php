<x-layout>
    <x-slot:title>Crear Nueva Noticia</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Nueva Noticia</h1>

        <!-- Manejo de errores de validación -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Formulario para crear una nueva noticia -->
        <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
            @csrf <!-- Token CSRF para protección contra ataques de falsificación de solicitudes -->

            <!-- Campo para el título de la noticia -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
            </div>

            <!-- Campo para el contenido de la noticia -->
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea class="form-control" id="contenido" name="contenido" rows="5" required>{{ old('contenido') }}</textarea>
            </div>

            <!-- Campo para subir una imagen -->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            </div>

            <!-- Botón para enviar el formulario -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Publicar Noticia</button>
            </div>
        </form>
    </div>
</x-layout>