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
