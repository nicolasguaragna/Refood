<x-layout>
    <x-slot:title>Editar Perfil</x-slot:title>

    <div class="container mt-4">
        <h1 class="text-center mb-4">✏️ Editar Perfil</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Tarjeta para la edición del perfil -->
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">📌 Actualiza tu información personal</h5>

                        <!-- Formulario para actualizar el perfil del usuario -->
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf <!-- Token CSRF para seguridad -->
                            @method('PUT') <!-- Método PUT para actualizar los datos -->

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">👤 Nombre</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">📧 Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contacto -->
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold">📞 Contacto</label>
                                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', auth()->user()->phone ?? '') }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nueva Contraseña -->
                            <div class="mb-3">
                                <label for="new-password" class="form-label fw-bold">🔑 Nueva Contraseña (opcional)</label>
                                <div class="input-group">
                                    <input type="password" id="new-password" name="new_password" class="form-control" placeholder="Nueva Contraseña">
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#new-password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label fw-bold">🔒 Confirmar Contraseña</label>
                                <div class="input-group">
                                    <input type="password" id="confirm-password" name="new_password_confirmation" class="form-control" placeholder="Confirmar Contraseña">
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#confirm-password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Botones de Cancelar y Guardar Cambios -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('profile.show') }}" class="btn btn-secondary">🔙 Cancelar</a>
                                <button type="submit" class="btn btn-success">💾 Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para alternar visibilidad de contraseñas -->
    @push('scripts')
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', () => {
                const target = document.querySelector(button.getAttribute('data-target'));
                const isPassword = target.getAttribute('type') === 'password';
                target.setAttribute('type', isPassword ? 'text' : 'password');
                button.querySelector('i').classList.toggle('fa-eye');
                button.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    </script>
    @endpush
</x-layout>