<x-layout>
    <x-slot:title>Crear Nueva Entrada de Blog</x-slot>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Nueva Entrada de Blog</h1>

        <!-- Mostrar mensajes de error si los hay -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para crear un nuevo post -->
        <!-- Agregar enctype="multipart/form-data" para permitir la carga de archivos -->
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenido</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            </div>

            <!-- Campo para cargar la imagen -->
            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Crear Entrada</button>
            </div>
        </form>
    </div>
</x-layout>
