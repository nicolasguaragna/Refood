<x-layout>
    <x-slot:title>Página Principal</x-slot>
        <!-- Sección principal -->
        <section class="landing-banner d-flex align-items-center justify-content-between">
            <div class="container text-start">
                <h1 class="display-4 fw-bold">
                    Cada plato cuenta <br><span class="text-success">para un mundo <br>sin desperdicio</span>
                </h1>
                <p class="lead">Un sitio para reducir el excedente de alimentos <br>y redistribuirlos a quienes más lo necesitan.</p>
                <a href="{{ route('donate.index') }}" class="btn btn-success btn-lg mt-3">Dona Ahora</a>

                <!-- Clientes felices -->
                <div class="d-flex align-items-center mt-4">
                    <div class="client-images me-3">
                        <img src="{{ asset('images/Elipse1.jpg') }}" alt="Cliente 1" class="rounded-circle" style="width: 40px; height: 40px;">
                        <img src="{{ asset('images/Elipse2.jpg') }}" alt="Cliente 2" class="rounded-circle" style="width: 40px; height: 40px; margin-left: -10px;">
                        <img src="{{ asset('images/Elipse3.jpg') }}" alt="Cliente 3" class="rounded-circle" style="width: 40px; height: 40px; margin-left: -10px;">
                    </div>
                    <div>
                        <span class="fw-bold">Clientes Felices</span>
                        <br>
                        <span class="text-muted">
                            <i class="fa fa-star text-warning"></i> 4.8 (450+ reviews)
                        </span>
                    </div>
                </div>
            </div>

            <!-- Imagen del banner con fondo decorativo -->
            <div class="banner-image position-relative">
                <div class="circle-background"></div> <!-- Fondo circular -->
                <div class="background-dots"></div> <!-- Puntos gráficos -->
                <img src="{{ asset('images/banner.png') }}" alt="Banner Principal" class="img-fluid">
            </div>
        </section>

        <!-- Sección Qué hacemos -->
        <section class="what-we-do text-center mt-5">
            <h2 class="fw-bold text-success">¿QUÉ HACEMOS?</h2>
            <p class="text-muted">
                Conectamos empresas donantes <br> con comedores comunitarios y organizaciones sociales, <br> asegurándonos de que los alimentos en buen estado <br> lleguen a quienes más lo necesitan.
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
            <p class="fw-bold">Opinión de nuestra comunidad</p>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="testimonial-card shadow-sm p-4 d-flex flex-column align-items-center">
                        <p class="fw-bold text-center">Desde que comenzamos con Refood, hemos logrado reducir el desperdicio de alimentos en nuestras tiendas."</p>
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ asset('images/testimonial-carlos.jpg') }}" alt="Carlos García" class="rounded-circle" style="width: 60px; height: 60px;">
                            <p class="text-warning mb-0">★★★★★</p>
                        </div>
                        <p class="mt-2"><strong>Carlos García</strong><br>Gerente de Responsabilidad Social, Supermercados</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card shadow-sm p-4 d-flex flex-column align-items-center">
                        <p class="fw-bold text-center">Gracias a Refood, cada semana recibimos alimentos frescos y variados que no podríamos obtener de otra manera."</p>
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ asset('images/testimonial-ana.jpg') }}" alt="Ana Gonzalez" class="rounded-circle" style="width: 60px; height: 60px;">
                            <p class="text-warning mb-0">★★★★★</p>
                        </div>
                        <p class="mt-2"><strong>Ana Gonzalez</strong><br>Coordinadora del Comedor <br>Comunidad Activa</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card shadow-sm p-4 d-flex flex-column align-items-center">
                        <p class="fw-bold text-center">Ser voluntaria me cambió la vida. Saber que esos alimentos llegarán a quienes los necesitan es una experiencia gratificante."</p>
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ asset('images/testimonial-mariana.jpg') }}" alt="Mariana Fert" class="rounded-circle" style="width: 60px; height: 60px;">
                            <p class="text-warning mb-0">★★★★★</p>
                        </div>
                        <p class="mt-2"><strong>Mariana Fert</strong><br>Voluntaria Refood</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section text-center mt-5">
            <div class="cta-container d-flex justify-content-between align-items-center">
                <img src="{{ asset('images/marca-final.png') }}" alt="Refood Logo" class="cta-logo">
                <h2 class="cta-text">CADA PLATO CUENTA</h2>
                <a href="{{ route('register') }}" class="btn btn-success cta-button">Únete a la Causa</a>
            </div>
        </section>
</x-layout>