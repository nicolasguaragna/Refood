<x-layout>
    <x-slot:title>Solicitud de Rescate</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Solicitar Rescate de Servicio</h1>

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

        <!-- Formulario de solicitud de rescate -->
        <form action="{{ route('rescue.request') }}" method="POST" class="shadow p-4 rounded bg-light">
            @csrf

            <!-- Campo oculto para el ID del servicio -->
            <input type="hidden" name="service_id" value="{{ $service->service_id }}">

            <!-- Campo para el nombre -->
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre" required value="{{ old('name') }}">
            </div>

            <!-- Campo para el contacto -->
            <div class="mb-3">
                <label for="contact" class="form-label">Contacto</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Teléfono o correo de contacto" required value="{{ old('contact') }}">
            </div>

            <!-- Campo para la ubicación -->
            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Direccion del rescate" required value="{{ old('location') }}">
            </div>

            <!-- Campo para los detalles del rescate -->
            <div class="mb-3">
                <label for="details" class="form-label">Detalles del Rescate</label>
                <textarea class="form-control" id="details" name="details" rows="4" placeholder="Describe el rescate que necesitas..." required>{{ old('details') }}</textarea>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Enviar Solicitud de Rescate</button>
            </div>
        </form>
    </div>
</x-layout>
