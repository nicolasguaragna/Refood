<x-layout>
    <x-slot:title>Editar Noticia</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Noticia</h1>

        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <div class="card shadow p-4">
            <form action="{{ route('noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Título de la noticia -->
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $noticia->title) }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contenido -->
                <div class="mb-3">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="5" required>{{ old('content', $noticia->content) }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Imagen actual -->
                @if($noticia->image)
                <div class="mb-3">
                    <label class="form-label">Imagen actual</label>
                    <div>
                        <img src="{{ asset('storage/' . $noticia->image) }}" alt="Imagen de la noticia" class="img-fluid rounded" style="max-width: 300px;">
                    </div>
                </div>
                @endif

                <!-- Nueva Imagen -->
                <div class="mb-3">
                    <label for="image" class="form-label">Actualizar Imagen (opcional)</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botón de envío -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Actualizar Noticia</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>