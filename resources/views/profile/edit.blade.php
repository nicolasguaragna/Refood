<x-layout>
    <x-slot:title>Editar Perfil</x-slot>

        <div class="container mt-4">
            <h1 class="text-center">Editar Perfil</h1>
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="new-password">Nueva Contraseña (opcional)</label>
                            <div class="input-group">
                                <input type="password" id="new-password" name="new_password" class="form-control" placeholder="Nueva Contraseña">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#new-password">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirmar Contraseña</label>
                            <div class="input-group">
                                <input type="password" id="confirm-password" name="new_password_confirmation" class="form-control" placeholder="Confirmar Contraseña">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#confirm-password">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <a href="{{ route('profile.show') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>

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