<x-layout>
    <x-slot:title>Noticias</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Últimas Noticias</h1>
        <p class="text-center text-muted mb-5">Mantente al día con las últimas novedades de Refood.</p>

        <div class="row">
            @foreach ($noticias as $noticia)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    @if ($noticia->imagen)
                    <img src="{{ asset('storage/' . $noticia->imagen) }}" class="card-img-top" alt="{{ $noticia->titulo }}">
                    @else
                    <img src="{{ asset('images/placeholder-news.jpg') }}" class="card-img-top" alt="Imagen por defecto">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $noticia->titulo }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($noticia->contenido, 100, '...') }}</p>
                        <p class="text-muted">Autor: Nicolás Guaragna</p>
                        <a href="{{ route('noticias.show', $noticia->id) }}" class="btn btn-primary">Leer más</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-container">
            {{ $noticias->links() }}
        </div>
    </div>
</x-layout>