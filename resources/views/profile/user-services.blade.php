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
                        <th class="d-none d-md-table-cell" style="width: 10%;">Detalles</th> <!-- Oculto en móviles -->
                        <th style="width: 10%;">Fecha</th>
                        <th style="width: 10%;">Pago</th>
                        <th class="d-none d-md-table-cell" style="width: 10%;">Feedback</th> <!-- Oculto en móviles -->
                        <th style="width: 10%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <!-- Hacer que el servicio sea clickeable solo en móviles -->
                        <td class="text-center">
                            <a href="#" class="service-link text-decoration-none text-success fw-bold"
                                data-bs-toggle="modal" data-bs-target="#detailsModal{{ $service->id }}"
                                onclick="handleModalClick(event)" role="button">
                                {{ $service->service->name ?? 'No disponible' }}
                            </a>
                        </td>

                        <!-- Ocultar detalles en móviles -->
                        <td class="text-truncate d-none d-md-table-cell" style="max-width: 200px;">
                            <a href="#" class="details-link" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $service->id }}">
                                {{ Str::limit($service->details, 30, '...') }}
                            </a>
                        </td>

                        <td class="text-center text-truncate" style="max-width: 100px;">
                            {{ $service->rescue_date ? $service->rescue_date->format('d/m/Y') : 'No especificado' }}
                        </td>

                        <!-- Ocultar feedback en móviles -->
                        <td class="text-center">
                            <span class="badge {{ $service->is_paid ? 'badge-success' : 'badge-warning' }}">
                                {{ $service->is_paid ? 'Pagado' : 'Pendiente' }}
                            </span>
                        </td>

                        <td class="text-center d-none d-md-table-cell">
                            <span class="badge badge-{{ $service->status === 'Pendiente' ? 'warning' : ($service->status === 'Visto' ? 'primary' : 'success') }}">
                                {{ $service->status }}
                            </span>
                        </td>

                        <!-- Columna Acciones -->
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

                    <!-- Modal para Ver Detalles -->
                    <div class="modal fade" id="detailsModal{{ $service->id }}" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailsModalLabel">Detalles del Servicio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Servicio:</strong> {{ $service->service->name ?? 'No disponible' }}</p>
                                    <p><strong>Precio:</strong> ${{ number_format($service->service->price ?? 0, 2) }}</p>
                                    <p><strong>Contacto:</strong> {{ $service->contact }}</p>
                                    <p><strong>Ubicación:</strong> {{ $service->location }}</p>
                                    <p><strong>Detalles:</strong> {{ $service->details }}</p>
                                    <p><strong>Fecha de Rescate:</strong> {{ $service->rescue_date ? $service->rescue_date->format('d/m/Y') : 'No especificado' }}</p>
                                    <p><strong>Estado del Pago:</strong>
                                        <span class="badge {{ $service->is_paid ? 'badge-success' : 'badge-warning' }}">
                                            {{ $service->is_paid ? 'Pagado' : 'Pendiente' }}
                                        </span>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        @endif
    </div>

    <script>
        function handleModalClick(event) {
            // Detectar el tamaño de la pantalla
            if (window.innerWidth > 768) {
                event.preventDefault(); // Evita que el modal se abra en escritorio
            }
        }
    </script>


    <!-- JavaScript para ocultar el mensaje automáticamente -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const flashMessage = document.getElementById("flash-message");
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.remove("show");
                    flashMessage.classList.add("fade");
                    setTimeout(() => flashMessage.style.display = "none", 500);
                }, 7000); // Desaparece después de 7 segundos
            }
        });
    </script>


</x-layout>