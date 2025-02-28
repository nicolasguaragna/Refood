<x-layout>
    <x-slot:title>{{ $noticia->titulo }}</x-slot:title>

    <div class="container mt-5">
        <!-- Título de la noticia -->
        <h1 class="fw-bold text-success">{{ $noticia->titulo }}</h1>

        <!-- Mostrar imagen si existe -->
        @if ($noticia->imagen)
        <img src="{{ asset('storage/' . $noticia->imagen) }}" class="img-fluid my-4" alt="{{ $noticia->titulo }}">
        @endif

        <!-- Contenido de la noticia -->
        <p class="text-muted">{{ $noticia->contenido }}</p>

        <!-- Botón para regresar a la lista de noticias -->
        <a href="{{ route('noticias.index') }}" class="btn btn-primary mt-4">Volver a Noticias</a>
    </div>
</x-layout>