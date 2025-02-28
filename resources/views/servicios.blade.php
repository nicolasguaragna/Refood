<x-layout>
    <x-slot:title>Nuestros Servicios</x-slot:title>

    <div class="container mt-1 position-relative" style="max-width: 1200px; margin: auto;">
        <h1 class="text-center mb-4">Nuestros Servicios</h1>

        <!-- Sección para mostrar mensajes de feedback (éxito o error) -->
        @if(session('message'))
        <div class="alert alert-{{ session('alert-type') }} mt-3">
            {{ session('message') }}
        </div>
        @endif

        <!-- Contenedor para los servicios, con separación entre columnas -->
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-md-4">
                <div class="card shadow-sm p-3">
                    <div class="card-body">

                        <!-- Título del servicio -->
                        <h2 class="card-title">{{ $service->name }}</h2>

                        <!-- Descripción breve del servicio -->
                        <p class="card-text">{{ $service->description }}</p>

                        <!-- Precio formateado con dos decimales -->
                        <p class="card-text"><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</p>

                        <!-- Información sobre costos de logística -->
                        <p class="card-text text-muted small">
                            Este pequeño costo al cliente permite hacer frente a los gastos de logística, nafta, materiales, etc.
                        </p>

                        <!-- Contenedor de botones para "Ver más" y "Rescatar" -->
                        <div class="button-container">
                            <!-- Botón para ver más detalles del servicio -->
                            <a href="{{ route('servicios.show', ['id' => $service->service_id]) }}" class="btn btn-primary">Ver más</a>

                            <!-- Botón "Rescatar" solo visible para usuarios comunes autenticados -->
                            @auth
                            @if(auth()->user()->hasRole('user'))
                            <a href="{{ route('rescue.form', ['service_id' => $service->service_id]) }}" class="btn btn-warning">Rescatar</a>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>