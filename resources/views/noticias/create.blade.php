<x-layout>
    <x-slot:title>Crear Noticia</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Crear Nueva Noticia</h1>

        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <div class="card shadow p-4">
            <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Título de la noticia -->
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contenido -->
                <div class="mb-3">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="5" required>{{ old('content') }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Imagen -->
                <div class="mb-3">
                    <label for="image" class="form-label">Imagen destacada</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botón de envío -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Publicar Noticia</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>