<x-layout>
    <x-slot:title>Editar Servicio</x-slot:title>

    <div class="container mt-4">
        <h1 class="text-center mb-4">✏️ Editar Servicio</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">📌 Modifica los detalles del servicio</h5>

                        <form action="{{ route('services.update', $service->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Contacto -->
                            <div class="mb-3">
                                <label for="contact" class="form-label fw-bold">📞 Contacto</label>
                                <input type="text" id="contact" name="contact" class="form-control @error('contact') is-invalid @enderror"
                                    value="{{ old('contact', $service->contact) }}" required>
                                @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Ubicación -->
                            <div class="mb-3">
                                <label for="location" class="form-label fw-bold">📍 Ubicación</label>
                                <input type="text" id="location" name="location" class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location', $service->location) }}" required>
                                @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Detalles -->
                            <div class="mb-3">
                                <label for="details" class="form-label fw-bold">📄 Detalles</label>
                                <textarea id="details" name="details" class="form-control @error('details') is-invalid @enderror" rows="3">{{ old('details', $service->details) }}</textarea>
                                @error('details')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('user.services') }}" class="btn btn-secondary">🔙 Cancelar</a>
                                <button type="submit" class="btn btn-success">💾 Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>