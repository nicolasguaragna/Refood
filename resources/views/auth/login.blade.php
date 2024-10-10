<x-layout>
    <x-slot:title>Iniciar Sesión</x-slot:title>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <h1 class="text-center mb-4">Ingresa a tu Cuenta</h1>

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

                <!-- Formulario de inicio de sesión -->
                <form action="{{ route('login') }}" method="post" class="shadow p-4 rounded bg-light">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

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


