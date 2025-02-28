<x-layout>
    <x-slot:title>Iniciar Sesión</x-slot:title>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <!-- Título principal de la página -->
                <h1 class="text-center mb-4">Ingresa a tu Cuenta</h1>

                <!-- Mostrar errores de validación si existen -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Formulario de inicio de sesión -->
                <form action="{{ route('login') }}" method="post" class="shadow p-4 rounded bg-light">
                    @csrf <!-- Token CSRF para evitar ataques de falsificación de solicitudes -->

                    <!-- Campo de entrada para el email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <!-- Campo de entrada para la contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- Botón de envío del formulario -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Ingresar</button>
                    </div>
                </form>

                <!-- Link para recuperar contraseña -->
                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>