<x-layout>
    <x-slot:title>Quiénes Somos</x-slot>

        <div class="container mt-4">
            <h1 class="text-center mb-5 fw-bold ">Quiénes Somos</h1>

            <div class="row align-items-center g-4">
                <!-- Imagen con diseño mejorado -->
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="{{ asset('images/equipo4.jpeg') }}" class="img-fluid rounded-3 shadow-lg zoom-in">
                </div>

                <!-- Contenido informativo -->
                <div class="col-md-6">
                    <h2 class="fw-bold text-secondary">Nuestra Historia</h2>
                    <p>Refood nació con la misión de reducir el desperdicio de alimentos y alimentar a quienes más lo necesitan. Nos comprometemos a cambiar el mundo, un plato a la vez.</p>

                    <h2 class="fw-bold text-secondary">Nuestra Misión</h2>
                    <p>Nos enfocamos en la recolección de alimentos no utilizados de comercios, empresas y hogares, para redistribuirlos a comunidades en situación vulnerable.</p>

                    <h2 class="fw-bold text-secondary">Nuestros Valores</h2>
                    <ul class="list-unstyled">
                        <li>✅ <strong>Sostenibilidad:</strong> Nos esforzamos por un mundo sin desperdicio.</li>
                        <li>✅ <strong>Solidaridad:</strong> Creemos en la ayuda mutua para un bien común.</li>
                        <li>✅ <strong>Compromiso:</strong> Trabajamos día a día para generar un impacto positivo.</li>
                    </ul>
                </div>
            </div>

            <!-- Mensajes de feedback -->
            @if(session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <style>
            .zoom-in {
                opacity: 0;
                transform: scale(0.8);
                animation: zoomIn 0.8s ease-out forwards;
            }

            @keyframes zoomIn {
                from {
                    opacity: 0;
                    transform: scale(0.8);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }
        </style>
</x-layout>