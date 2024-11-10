<x-layout>
    <x-slot:title>Registrarse</x-slot:title>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <h1 class="text-center mb-4">Crea una Cuenta</h1>

                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario de registro -->
                <form action="{{ route('register') }}" method="post" class="shadow p-4 rounded bg-light">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Registrarse</button>
                    </div>
                </form>

                <!-- Link para iniciar sesión si ya tiene una cuenta -->
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none">¿Ya tienes una cuenta? Inicia sesión aquí</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>

