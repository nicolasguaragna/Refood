<x-layout>
    <x-slot:title>Quienes Somos</x-slot>

        <div class="container mt-1">
            <h1 class="text-center mb-4">Quienes Somos</h1>
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('images/equipo4.jpeg') }}" alt="Nuestro equipo" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h2>Nuestra Historia</h2>
                    <p>Refood nació con la misión de reducir el desperdicio de alimentos y alimentar a quienes más lo necesitan. Nos comprometemos a cambiar el mundo, un plato a la vez.</p>

                    <h2>Nuestra Misión</h2>
                    <p>Nos enfocamos en la recolección de alimentos no utilizados de comercios, empresas y hogares, para redistribuirlos a comunidades en situación vulnerable.</p>

                    <h2>Nuestros Valores</h2>
                    <ul>
                        <li><strong>Sostenibilidad:</strong> Nos esforzamos por un mundo sin desperdicio.</li>
                        <li><strong>Solidaridad:</strong> Creemos en la ayuda mutua para un bien común.</li>
                        <li><strong>Compromiso:</strong> Trabajamos día a día para generar un impacto positivo.</li>
                    </ul>
                </div>
            </div>

            <!-- Sección de Mensajes de Feedback -->
            @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
</x-layout>