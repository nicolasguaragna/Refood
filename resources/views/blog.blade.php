<x-layout>
    <x-slot:title>Blog</x-slot>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Blog</h1>

        @foreach ($posts as $post)
            <div class="post-preview">
                <h2>{{ $post->title }}</h2>
                <p>Por {{ $post->author->name }} - {{ $post->created_at->format('d M Y') }}</p>
                <p>{{ Str::limit($post->content, 150) }}</p>
                <a href="{{ route('blog.show', $post->id) }}" class="btn btn-primary">Leer más</a>
            </div>
            <hr>
        @endforeach
    </div>
</x-layout>
