<x-layout>
    <x-slot:title>Página Principal</x-slot>

        <!-- Sección principal -->
        <section class="landing-banner d-flex align-items-center justify-content-center text-center">
            <div class="container">
                <h1 class="display-4 fw-bold">
                    Cada plato cuenta <br><span class="text-success">para un mundo <br>sin desperdicio</span>
                </h1>
                <p class="lead">Un sitio para reducir el excedente de alimentos y redistribuirlos a quienes más lo necesitan.</p>
                <a href="{{ route('donate.index') }}" class="btn btn-success btn-lg mt-3">Dona Ahora</a>
                <div class="client-reviews mt-3">
                    <img src="{{ asset('images/Elipse1.jpg') }}" alt="Clientes Felices" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                    <span class="fw-bold">Clientes Felices</span>
                    <span class="text-muted">4.8 (450+ reviews)</span>
                </div>
            </div>
            <div class="banner-image">
                <div class="circle-background"></div> <!-- Fondo circular -->
                <img src="{{ asset('images/banner.png') }}" alt="Banner Principal" class="img-fluid">
            </div>
        </section>

        <!-- Sección Qué hacemos -->
        <section class="what-we-do text-center mt-5">
            <h2 class="fw-bold">¿QUÉ HACEMOS?</h2>
            <p class="text-muted">
                Conectamos empresas donantes <br> con comedores comunitarios y organizaciones sociales <br> asegurándonos de que los alimentos en buen estado <br> lleguen a quienes más lo necesitan.
            </p>
        </section>

        <!-- Sección La solución -->
        <section class="solution text-center mt-5">
            <h2 class="fw-bold text-success">LA SOLUCIÓN</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="solution-card shadow-sm p-4">
                        <h3 class="fw-bold">Registro de alimentos <br>por parte de las empresas</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="solution-card shadow-sm p-4">
                        <h3 class="fw-bold">Recolección y verificación</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="solution-card shadow-sm p-4">
                        <h3 class="fw-bold">Distribución a comedores comunitarios</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección Opinión de nuestra comunidad -->
        <section class="community-opinion text-center mt-5">
            <h2 class="fw-bold text-success">LO QUE DICEN</h2>
            <p class="text-muted">Opinión de nuestra comunidad</p>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="testimonial-card shadow-sm p-4">
                        <p class="fw-bold">"Desde que comenzamos con Refood, hemos logrado reducir el desperdicio de alimentos en nuestras tiendas."</p>
                        <img src="{{ asset('images/testimonial-carlos.jpg') }}" alt="Carlos García" class="rounded-circle mt-3" style="width: 60px; height: 60px;">
                        <p class="mt-2"><strong>- Carlos García</strong><br>Gerente de Responsabilidad Social, Supermercados</p>
                        <p class="text-warning">★★★★★</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card shadow-sm p-4">
                        <p class="fw-bold">"Gracias a Refood, cada semana recibimos alimentos frescos y variados que no podríamos obtener de otra manera."</p>
                        <img src="{{ asset('images/testimonial-ana.jpg') }}" alt="Ana Gonzalez" class="rounded-circle mt-3" style="width: 60px; height: 60px;">
                        <p class="mt-2"><strong>- Ana Gonzalez</strong><br>Coordinadora del Comedor Comunidad Activa</p>
                        <p class="text-warning">★★★★★</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card shadow-sm p-4">
                        <p class="fw-bold">"Ser voluntaria me cambió la vida. Saber que esos alimentos llegarán a quienes los necesitan es una experiencia gratificante."</p>
                        <img src="{{ asset('images/testimonial-mariana.jpg') }}" alt="Mariana Fert" class="rounded-circle mt-3" style="width: 60px; height: 60px;">
                        <p class="mt-2"><strong>- Mariana Fert</strong><br>Voluntaria Refood</p>
                        <p class="text-warning">★★★★★</p>
                    </div>
                </div>
            </div>
        </section>

</x-layout>