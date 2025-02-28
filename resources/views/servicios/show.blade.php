<x-layout>
    <x-slot:title>{{ $service->name }}</x-slot:title>

    <div class="service-container mt-5">
        <!-- Nombre del Servicio -->
        <h1 class="service-title">{{ $service->name }}</h1>

        <!-- Descripción del Servicio -->
        <h2 class="service-subtitle">{{ $service->description }}</h2>

        <!-- Precio del Servicio (formateado con dos decimales) -->
        <p class="service-price"><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</p>

        <!-- Cantidad mínima de kg requerida para el servicio -->
        <p class="service-price"><strong>Mínimo de Kg:</strong> {{ $service->minimum_kg }} kg</p>

        <!-- Sección de información adicional -->
        <h3 class="service-subtitle">Más info</h3>
        <p class="service-info">{{ $service->more_info }}</p>
    </div>
</x-layout>