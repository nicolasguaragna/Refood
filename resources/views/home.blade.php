<x-layout>
    <x-slot:title>Página Principal</x-slot>

    <div class="container mt-1 d-flex flex-column align-items-center justify-content-center bg-light p-5" style="min-height: 100vh;">
        <!-- Logo de la marca -->
        <div class="mb-4">
            <img src="{{ asset('images/marca.jpg') }}" alt="Logo Refood" style="max-width: 500px;" class="img-fluid rounded shadow-lg">
        </div>

        <h1 class="text-center text-muted mb-5">Somos una comunidad de concientización alimentaria. 
        <br>Rescatamos alimentos y los entregamos a comedores comunitarios de forma gratuita.</h1>

        <!-- Contadores de Kilos rescatados y Platos entregados -->
        <div class="row text-center mt-5">
            <div class="col-md-6 mb-4">
                <div class="mb-3">
                    <img src="{{ asset('images/comida-rescatada.jpg') }}" alt="Kilos Rescatados" class="img-fluid rounded shadow" style="max-width: 250px;">
                </div>
                <h2 class="display-5 text-primary"><span id="kilos-rescatados">0</span></h2>
                <p class="text-muted">Kilos rescatados en el 2024</p>
                <p>Rescatamos alimentos en excelente estado que por algún motivo salen de la cadena de comercialización.</p>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mb-3">
                    <img src="{{ asset('images/platos-entregados.jpg') }}" alt="Platos Entregados" class="img-fluid rounded shadow" style="max-width: 350px;">
                </div>
                <h2 class="display-5 text-success"><span id="platos-entregados">0</span></h2>
                <p class="text-muted">Platos entregados en el 2024</p>
                <p>Los alimentos son entregados de forma totalmente gratuita en comedores comunitarios. Cada Plato Cuenta.</p>
            </div>
        </div>

    </div>

    <!-- Script para animar los contadores -->
    <script>
        function animateValue(id, start, end, duration) {
            const obj = document.getElementById(id);
            let startTime = null;

            const step = (timestamp) => {
                if (!startTime) startTime = timestamp;
                const progress = Math.min((timestamp - startTime) / duration, 1);
                obj.innerText = Math.floor(progress * (end - start) + start);

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };

            window.requestAnimationFrame(step);
        }

        // Iniciar los contadores con los valores que desees
        animateValue("kilos-rescatados", 0, 115000, 3000); // 3 segundos de animación
        animateValue("platos-entregados", 0, 2051477, 3000);
    </script>

</x-layout>
