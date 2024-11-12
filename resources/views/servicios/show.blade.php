<x-layout>
    <x-slot:title>{{ $service->name }}</x-slot:title>
    
    <div class="container mt-5">
        <h1>{{ $service->name }}</h1>
        <p>{{ $service->description }}</p>
        <p><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</p>
        <p><strong>Mínimo de Kg:</strong> {{ $service->minimum_kg }} kg</p>

        <h2 class="mb-3">Mas info</h2>
        <div>{{ $service->more_info }}</div>
    </div>
</x-layout>
