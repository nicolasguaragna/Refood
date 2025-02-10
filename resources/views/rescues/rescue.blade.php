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

            <!-- Campo para la ubicación con Google Places API -->
            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Direccion del rescate" required value="{{ old('location') }}">
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
            </div>

            <!-- Mapa de Google -->
            <div id="map" style="height: 400px; width: 100%;" class="mb-3"></div>

            <div class="mb-3">
                <label for="rescue_date" class="form-label">Fecha del Rescate</label>
                <input type="date" class="form-control" id="rescue_date" name="rescue_date" value="{{ old('rescue_date') }}" required>
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

    <!-- Incluir API de Google Maps -->
    <script>
        function initMap() {
            const defaultLocation = {
                lat: -34.603722,
                lng: -58.381592
            }; // Coordenadas por defecto (Buenos Aires)
            const map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 13
            });

            const marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true
            });

            const input = document.getElementById("location");
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo("bounds", map);

            autocomplete.addListener("place_changed", function() {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }

                // Centrar el mapa y mover el marcador a la ubicación seleccionada
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(15);
                }

                marker.setPosition(place.geometry.location);
                document.getElementById("latitude").value = place.geometry.location.lat();
                document.getElementById("longitude").value = place.geometry.location.lng();
            });

            // Permitir mover el marcador manualmente
            marker.addListener("dragend", function() {
                const position = marker.getPosition();
                document.getElementById("latitude").value = position.lat();
                document.getElementById("longitude").value = position.lng();
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqaRvHKOkE10b_ImbhRlUVe9X-P1rAgro
    &libraries=places&callback=initMap"></script>
</x-layout>