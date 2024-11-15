<x-layout>
    <x-slot:title>{{ $post->title }}</x-slot>

    <div class="container mt-5">
        <h1>{{ $post->title }}</h1>

        <!-- Mostrar la imagen completa si existe -->
        @if($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Imagen de {{ $post->title }}" class="img-fluid mb-4">
        @endif

        <p>{{ $post->content }}</p>
        <p><strong>Autor:</strong> {{ $post->author->name }}</p>
    </div>
</x-layout>
