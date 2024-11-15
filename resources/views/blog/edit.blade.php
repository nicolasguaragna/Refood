<x-layout>
    <x-slot:title>Editar Entrada de Blog</x-slot>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Entrada del Blog</h1>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para editar el post -->
        <!-- Agregar enctype="multipart/form-data" para permitir la carga de archivos -->
        <form action="{{ route('blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Método PUT para actualizar -->

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenido</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <!-- Campo para cargar una nueva imagen -->
            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <!-- Mostrar la imagen actual, si existe -->
            @if ($post->image_path)
                <div class="mb-3">
                    <p>Imagen actual:</p>
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Imagen actual" style="max-width: 100%; height: auto;">
                </div>
            @endif

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</x-layout>
