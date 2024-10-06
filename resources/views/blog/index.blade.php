<x-layout>
    <x-slot:title>Blog</x-slot>
    
    <div class="container mt-5">
        <h1 class="text-center">Blog</h1>
        @foreach($posts as $post)
            <div class="post mb-4">
                <h2>{{ $post->title }}</h2>
                <p>{{ Str::limit($post->content, 150) }}</p>
                <a href="{{ url('blog/' . $post->id) }}" class="btn btn-primary">Leer más</a>
            </div>
        @endforeach
    </div>
</x-layout>
