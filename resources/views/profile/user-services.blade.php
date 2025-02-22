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

        <!-- 🔹 Notificaciones del cambio de estado -->
        @if (Auth::user()->unreadNotifications->count() > 0)
        <div class="alert alert-info">
            <h5>📢 Notificaciones:</h5>
            @foreach (Auth::user()->unreadNotifications as $notification)
            <p>{{ $notification->data['message'] }}</p>
            @endforeach
        </div>
        @endif

        @if($services->isEmpty())
        <p class="text-center">No tienes servicios contratados.</p>
        @else
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped text-nowrap">
                <thead class="table-success text-center">
                    <tr>
                        <th style="width: 10%;">Servicio</th>
                        <th style="width: 10%;">Precio</th>
                        <th style="width: 12%;">Contacto</th>
                        <th style="width: 18%;">Ubicación</th>
                        <th style="width: 20%;">Detalles</th>
                        <th style="width: 10%;">Fecha de Rescate</th>
                        <th style="width: 10%;">Pago</th>
                        <th style="width: 10%;">Feedback Refood</th>
                        <th style="width: 10%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td class="text-center">{{ $service->service->name ?? 'No disponible' }}</td>
                        <td class="text-center">${{ $service->service ? number_format($service->service->price, 2) : '0.00' }}</td>
                        <td class="text-center">{{ $service->contact }}</td>
                        <td class="text-truncate" style="max-width: 200px;">{{ $service->location }}</td>
                        <td class="text-truncate" style="max-width: 250px;">{{ $service->details }}</td>
                        <td class="text-center">{{ $service->rescue_date ? $service->rescue_date->format('d/m/Y') : 'No especificado' }}</td>

                        <!-- Columna 'Pago' -->

                        <td class="text-center">
                            @if($service->is_paid)
                            <span class="badge bg-success">Pagado</span>
                            @else
                            <span class="badge bg-warning text-dark">Pendiente</span>
                            @endif
                        </td>

                        <!-- Columna Feedback Refood -->
                        <td class="text-center">
                            <!-- 🔹 Estado actualizado del rescate -->
                            @if($service->status === 'Pendiente')
                            <span class="badge bg-warning text-dark">Pendiente</span>
                            @elseif($service->status === 'Visto')
                            <span class="badge bg-info text-white">Visto</span>
                            @elseif($service->status === 'Para ser retirado')
                            <span class="badge bg-primary text-white">Para ser retirado</span>
                            @elseif($service->status === 'Retirado')
                            <span class="badge bg-success">Retirado</span>
                            @else
                            <span class="badge bg-secondary">{{ $service->status }}</span>
                            @endif
                        </td>

                        <!-- Ultima columna Acciones -->
                        <td class="text-center">
                            @if(!$service->is_paid)
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('services.cancel', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas cancelar este servicio?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                            </form>
                            <a href="{{ route('services.pay', $service->id) }}" class="btn btn-success btn-sm">Pagar</a>
                            @else
                            <span class="badge bg-secondary">Sin acciones</span>
                            @endif
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