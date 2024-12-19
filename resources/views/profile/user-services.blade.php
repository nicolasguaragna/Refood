<x-layout>
    <x-slot:title>Mis Servicios</x-slot:title>

    <div class="container mt-4">
        <h1 class="text-center">Mis Servicios</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if($services->isEmpty())
        <p class="text-center">No tienes servicios contratados.</p>
        @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Precio</th>
                        <th>Contacto</th>
                        <th>Ubicación</th>
                        <th>Detalles</th>
                        <th>Fecha de Rescate</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{ $service->service->name ?? 'Servicio no disponible' }}</td>
                        <td>${{ $service->service ? number_format($service->service->price, 2) : '0.00' }}</td>
                        <td>{{ $service->contact }}</td>
                        <td>{{ $service->location }}</td>
                        <td>{{ $service->details }}</td>
                        <td>{{ $service->rescue_date ? $service->rescue_date->format('d/m/Y') : 'No especificado' }}</td>
                        <td>
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('services.cancel', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas cancelar este servicio?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</x-layout>