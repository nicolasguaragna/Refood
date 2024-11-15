<x-layout>
    <x-slot:title>{{ $service->name }}</x-slot:title>

    <div class="service-container mt-5">
        <h1 class="service-title">{{ $service->name }}</h1>
        <h2 class="service-subtitle">{{ $service->description }}</h2>
        <p class="service-price"><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</p>
        <p class="service-price"><strong>Mínimo de Kg:</strong> {{ $service->minimum_kg }} kg</p>

        <h3 class="service-subtitle">Más info</h3>
        <p class="service-info">{{ $service->more_info }}</p>
    </div>
</x-layout>
