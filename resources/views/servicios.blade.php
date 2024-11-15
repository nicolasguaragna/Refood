<x-layout>
    <x-slot:title>Nuestros Servicios</x-slot:title>
    
    <div class="container mt-1">
        <h1 class="text-center mb-4">Nuestros Servicios</h1>
        
        <!-- Mostrar mensajes de feedback -->
        @if(session('message'))
            <div class="alert alert-{{ session('alert-type') }} mt-3">
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
            @foreach($services as $service)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title">{{ $service->name }}</h2>
                            <p class="card-text">{{ $service->description }}</p>
                            <p class="card-text"><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</p>
                            
                            <!-- Agregar la leyenda aquí -->
                            <p class="card-text text-muted small">
                                Este pequeño costo al cliente permite hacer frente a los gastos de logística, nafta, materiales, etc.
                            </p>

                            <!-- Contenedor de botones -->
                            <div class="button-container">
                                <!-- Botón "Ver más" -->
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
