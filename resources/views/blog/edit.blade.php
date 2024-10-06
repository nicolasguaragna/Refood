<x-layout>
    <x-slot:title>{{ $post->title }}</x-slot>

    <div class="container mt-5">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        <p><strong>Autor:</strong> {{ $post->author->name }}</p>
    </div>
</x-layout>
