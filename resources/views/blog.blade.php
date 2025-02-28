<x-layout>
    <x-slot:title>Blog</x-slot>

        <div class="container mt-1 position-relative">
            <!-- Título principal -->
            <h1 class="text-center mb-4">Blog</h1>

            <!-- Elemento decorativo -->
            <div class="background-dots"></div>

            <!-- Iterar sobre los posts del blog -->
            @foreach ($posts as $post)
            <div class="post-preview">
                <!-- Título del post -->
                <h2>{{ $post->title }}</h2>

                <!-- Información del autor y fecha -->
                <p>Por {{ $post->author->name }} - {{ $post->created_at->format('d M Y') }}</p>

                <!-- Resumen del contenido del post -->
                <p>{{ Str::limit($post->content, 150) }}</p>

                <!-- Botón para leer el artículo completo -->
                <a href="{{ route('blog.show', $post->id) }}" class="btn btn-primary">Leer más</a>
            </div>
            <hr><!-- Separador entre publicaciones -->
            @endforeach
        </div>

</x-layout>