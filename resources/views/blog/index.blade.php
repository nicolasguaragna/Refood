<x-layout>
    <x-slot:title>Blog</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Blog</h1>

        <!-- Mostrar mensaje de feedback -->
        @if(session('message'))
            <div class="alert alert-{{ session('alert-type') }}">
                {{ session('message') }}
            </div>
        @endif

        @auth
            <p>Usuario autenticado: {{ auth()->user()->id }}</p>

            <!-- Botón para crear una nueva entrada (disponible para cualquier usuario autenticado) -->
            <div class="text-end mb-4">
                <a href="{{ route('blog.create') }}" class="btn btn-success">Nueva entrada de Blog</a>
            </div>
        @endauth

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm blog-card">
                        @if($post->image_path)
                            <!-- Mostrar imagen si existe -->
                            <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top blog-card-img" alt="Imagen del blog">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <p class="text-muted">Autor: {{ $post->author->name }}</p>
                            <a href="{{ url('/blog/' . $post->id) }}" class="btn btn-primary">Leer más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
