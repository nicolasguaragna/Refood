<x-layout>
    <x-slot:title>Página Principal</x-slot>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Bienvenido a Refood</h1>
        <p class="text-center">Bienvenido a nuestro sitio web. Aquí podrás acceder a nuestros servicios y leer nuestras últimas entradas de blog.</p>

        <!-- Contadores de Kilos rescatados y Platos entregados -->
        <div class="row text-center mt-5">
            <div class="col-md-6">
                <div>
                    <img src="/path/to/your/image1.png" alt="Kilos Rescatados" style="max-width: 150px;">
                </div>
                <h2><span id="kilos-rescatados">0</span></h2>
                <p>Kilos rescatados en el 2024</p>
                <p>Rescatamos alimentos en excelente estado que por algún motivo salen de la cadena de comercialización.</p>
            </div>
            <div class="col-md-6">
                <div>
                    <img src="/path/to/your/image2.png" alt="Platos Entregados" style="max-width: 150px;">
                </div>
                <h2><span id="platos-entregados">0</span></h2>
                <p>Platos entregados en el 2024</p>
                <p>Los alimentos son entregados de forma totalmente gratuita en comedores comunitarios.</p>
            </div>
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-primary">Quiero contactarme</button>
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
