<x-layout>
    <x-slot:title>Solicitud de Rescate</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Solicitar de Rescate</h1>

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

            <!-- Campo de contacto -->
            <div class="mb-3">
                <label for="contact" class="form-label">Contacto</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Teléfono de contacto" required pattern="[0-9]+" maxlength="15">
                <small class="text-danger d-none" id="contact-error">Solo se permiten números.</small>
            </div>

            <!-- Campo para la ubicación con Google Places API -->
            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Direccion del rescate" required value="{{ old('location') }}">
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <div id="location-alert" class="alert alert-danger mt-2 d-none">
                    🚨 Solo se permiten direcciones dentro del AMBA en Buenos Aires.
                </div>
            </div>

            <!-- Mapa de Google -->
            <div id="map" style="height: 400px; width: 100%;" class="mb-3"></div>

            <div class="mb-3">
                <label for="rescue_date" class="form-label">Fecha del Rescate</label>
                <input type="date" class="form-control" id="rescue_date" name="rescue_date" required>
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
            }; // Buenos Aires
            const map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 12
            });

            const marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true
            });

            const input = document.getElementById("location");
            const autocomplete = new google.maps.places.Autocomplete(input, {
                componentRestrictions: {
                    country: "AR"
                }, // Restringir búsqueda a Argentina
                fields: ["geometry", "formatted_address", "address_components"]
            });

            autocomplete.addListener("place_changed", function() {
                const place = autocomplete.getPlace();

                if (!place.geometry) {
                    return;
                }

                // Depuración: Ver qué devuelve Google Places
                console.log("Dirección seleccionada:", place.formatted_address);
                console.log("Componentes:", place.address_components);

                // Centrar mapa y mover marcador
                map.setCenter(place.geometry.location);
                marker.setPosition(place.geometry.location);
                document.getElementById("latitude").value = place.geometry.location.lat();
                document.getElementById("longitude").value = place.geometry.location.lng();

                // Verificar si la ubicación está dentro de AMBA
                validarUbicacionAMBA(place);
            });

            marker.addListener("dragend", function() {
                const position = marker.getPosition();
                document.getElementById("latitude").value = position.lat();
                document.getElementById("longitude").value = position.lng();
            });
        }

        function validarUbicacionAMBA(place) {
            const AMBA_LOCALIDADES = [
                "Ciudad Autónoma de Buenos Aires", "CABA", "Buenos Aires", "Almirante Brown", "Avellaneda", "Berazategui",
                "Berisso", "Brandsen", "Campana", "Cañuelas", "Ensenada", "Escobar",
                "Esteban Echeverría", "Exaltación de la Cruz", "Ezeiza", "Florencio Varela",
                "General Las Heras", "General Rodríguez", "General San Martín", "Hurlingham",
                "Ituzaingó", "José C. Paz", "La Matanza", "La Plata", "Lanús", "Lomas de Zamora",
                "Luján", "Malvinas Argentinas", "Marcos Paz", "Merlo", "Moreno", "Morón",
                "Pilar", "Presidente Perón", "Quilmes", "San Fernando", "San Isidro",
                "San Miguel", "San Vicente", "Tigre", "Tres de Febrero", "Vicente López", "Zárate"
            ];

            let enAMBA = false;

            // Recorrer los componentes de la dirección y comparar con AMBA
            place.address_components.forEach(component => {
                console.log("Componente evaluado:", component.long_name);
                if (component.types.includes("administrative_area_level_2") ||
                    component.types.includes("administrative_area_level_1") ||
                    component.types.includes("locality")) {

                    if (AMBA_LOCALIDADES.includes(component.long_name)) {
                        enAMBA = true;
                    }
                }
            });

            // Mostrar mensaje si está fuera de AMBA
            if (!enAMBA) {
                document.getElementById("location-alert").classList.remove("d-none");
                document.getElementById("location").value = "";
            } else {
                document.getElementById("location-alert").classList.add("d-none");
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date().toISOString().split("T")[0];
            document.getElementById("rescue_date").setAttribute("min", today);
        });
    </script>

    <script>
        document.getElementById("contact").addEventListener("input", function(event) {
            let input = event.target;
            input.value = input.value.replace(/\D/g, ""); // Remueve caracteres no numéricos

            let errorMessage = document.getElementById("contact-error");
            if (!/^[0-9]+$/.test(input.value)) {
                errorMessage.classList.remove("d-none");
            } else {
                errorMessage.classList.add("d-none");
            }
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&callback=initMap" async defer></script>

</x-layout>