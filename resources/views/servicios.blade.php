<x-layout>
    <x-slot:title>Nuestros Servicios</x-slot:title>
    
    <div class="container mt-5">
        <h1 class="text-center mb-4">Nuestros Servicios</h1>
        <div class="row">
            @foreach ($services as $service)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->name }}</h5>
                            <p class="card-text">{{ $service->description }}</p>
                            <p class="card-text"><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>

