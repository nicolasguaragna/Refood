<x-layout>
    <x-slot:title>Editar Servicio</x-slot:title>

    <div class="container mt-4">
        <h1 class="text-center">Editar Servicio</h1>

        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="contact" class="form-label">Contacto</label>
                <input type="text" id="contact" name="contact" class="form-control" value="{{ old('contact', $service->contact) }}" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $service->location) }}" required>
            </div>

            <div class="mb-3">
                <label for="details" class="form-label">Detalles</label>
                <textarea id="details" name="details" class="form-control">{{ old('details', $service->details) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('user.services') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</x-layout>