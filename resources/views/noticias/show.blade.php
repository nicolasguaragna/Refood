<x-layout>
    <x-slot:title>{{ $noticia->titulo }}</x-slot:title>

    <div class="container mt-5">
        <h1 class="fw-bold text-success">{{ $noticia->titulo }}</h1>
        @if ($noticia->imagen)
        <img src="{{ asset('storage/' . $noticia->imagen) }}" class="img-fluid my-4" alt="{{ $noticia->titulo }}">
        @endif
        <p class="text-muted">{{ $noticia->contenido }}</p>
        <a href="{{ route('noticias.index') }}" class="btn btn-primary mt-4">Volver a Noticias</a>
    </div>
</x-layout>