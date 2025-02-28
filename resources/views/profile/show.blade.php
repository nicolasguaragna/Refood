<x-layout>
    <x-slot:title>Perfil de Usuario</x-slot:title>

    <div class="container mt-4">
        <!-- Mensaje de éxito si se actualiza el perfil -->
        @if (session('success'))
        <div id="flash-message" class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <i class="fa fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Encabezado del perfil -->
        <h1 class="text-center mb-4">👤 Mi Perfil</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Tarjeta de perfil del usuario -->
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">📌 Información Personal</h5>

                        <!-- Datos del usuario -->
                        <p><strong>👤 Nombre:</strong> {{ $user->name }}</p>
                        <p><strong>📧 Email:</strong> {{ $user->email }}</p>
                        <p><strong>📞 Contacto:</strong> {{ auth()->user()->phone ?? 'No registrado' }}</p>

                        <hr>

                        <!-- Botón para editar el perfil -->
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100">
                            ✏️ Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para ocultar el mensaje automáticamente -->
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