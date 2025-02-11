<x-layout>
    <x-slot:title>Mis Servicios</x-slot:title>

    <div class="container mt-4">
        <h1 class="text-center">Mis Servicios</h1>

        <!-- Mostrar mensajes de éxito o error si existen -->
        @if (session('success') || session('error'))
        <div id="flash-message" class="alert 
            {{ session('success') ? 'alert-success' : 'alert-danger' }} 
            alert-dismissible fade show" role="alert">
            {{ session('success') ?? session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($services->isEmpty())
        <p class="text-center">No tienes servicios contratados.</p>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
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

    <!-- JavaScript para ocultar el mensaje automáticamente -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const flashMessage = document.getElementById("flash-message");
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.remove("show");
                    flashMessage.classList.add("fade");
                    setTimeout(() => flashMessage.style.display = "none", 500);
                }, 4000); // Desaparece después de 4 segundos
            }
        });
    </script>
</x-layout>