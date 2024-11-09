<x-layout>
    <x-slot:title>Blog</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Blog</h1>

        @auth
            <p>Usuario autenticado: {{ auth()->user()->id }}</p>
        @endauth

        <!-- Verifica si el usuario está autenticado y está en la vista de administración -->
        @if(request()->is('blog/admin'))
            <div class="text-end mb-4">
                <!-- Botón para crear una nueva entrada (solo en la vista de administración) -->
                <a href="{{ url('/blog/create') }}" class="btn btn-success">Nueva entrada de Blog</a>
            </div>
        @endif

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <a href="{{ url('/blog/' . $post->id) }}" class="btn btn-primary">Leer más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
