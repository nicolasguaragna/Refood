<x-layout>
    <x-slot:title>Donar un Plato</x-slot>

        <div class="container mt-4">
            <h1 class="text-center mb-4">Donar un Plato</h1>
            <div class="row align-items-center">
                <!-- Columna de la imagen -->
                <div class="col-md-6 text-center">
                    <img
                        src="{{ asset('images/voluntarios-sirviendo.jpg') }}"
                        alt="Voluntarios sirviendo comida"
                        class="img-fluid rounded-3 shadow-lg zoom-in">
                </div>
                <!-- Columna del contenido -->
                <div class="col-md-6">
                    <h2 class="fw-bold text-secondary">¿Por qué Donar?</h2>
                    <p>
                        En Refood, creemos que cada plato cuenta. Tu donación nos ayuda a reducir el desperdicio de alimentos
                        y llevar comida a quienes más lo necesitan. Cada aporte es una oportunidad para cambiar vidas y construir un mundo más sostenible.
                    </p>

                    <h2 class="fw-bold text-secondary">¿Cómo Funciona?</h2>
                    <p>
                        Con tu donación, recolectamos alimentos no utilizados de comercios, empresas, productores, para redistribuirlos
                        a comunidades en situación vulnerable. ¡Juntos podemos lograr un cambio real!
                    </p>

                    <h2 class="fw-bold text-secondary">Haz tu Donación</h2>
                    <!-- Botón generado dinámicamente por Mercado Pago -->
                    <div id="wallet_container"></div>

                    <script src="https://sdk.mercadopago.com/js/v2"></script>
                    <script>
                        const mp = new MercadoPago("{{ $publicKey }}", {
                            locale: 'es-AR'
                        });
                        mp.bricks().create('wallet', 'wallet_container', {
                            initialization: {
                                preferenceId: "{{ $preferenceId }}", // ID de la preferencia generado en el controlador
                            },
                        });
                    </script>
                </div>
            </div>
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