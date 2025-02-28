<x-layout>
    <x-slot:title>Editar Noticia</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Noticia</h1>

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

        <!-- Formulario para actualizar una noticia existente -->
        <form action="{{ route('noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
            @csrf <!-- Token CSRF para seguridad -->
            @method('PUT') <!-- Método PUT para actualizar los datos -->

            <!-- Campo para editar el título de la noticia -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $noticia->titulo) }}" required>
            </div>

            <!-- Campo para editar el contenido de la noticia -->
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea class="form-control" id="contenido" name="contenido" rows="5" required>{{ old('contenido', $noticia->contenido) }}</textarea>
            </div>

            <!-- Campo para cambiar la imagen de la noticia -->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen (opcional)</label>

                <!-- Mostrar la imagen actual si existe -->
                @if ($noticia->imagen)
                <div class="mb-2">
                    <img src="{{ $noticia->imagen_url }}" alt="Imagen actual" class="img-thumbnail" width="200">
                </div>
                @endif
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            </div>

            <!-- Botón para actualizar la noticia -->
            <div class="text-center">
                <button type="submit" class="btn btn-success">Actualizar Noticia</button>
            </div>
        </form>
    </div>
</x-layout>