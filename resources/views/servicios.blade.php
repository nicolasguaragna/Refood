<x-layout>
    <x-slot:title>Nuestros Servicios</x-slot:title>
    
    <h1 class="mb-3">Nuestros Servicios</h1>
    
    <ul>
        @foreach ($services as $service)
            <li>{{ $service->name }} - Precio: ${{ number_format($service->price, 2) }}</li>
        @endforeach
    </ul>
</x-layout>
