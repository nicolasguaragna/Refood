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
                        class="img-fluid rounded shadow">
                </div>
                <!-- Columna del contenido -->
                <div class="col-md-6">
                    <h2>¿Por qué Donar?</h2>
                    <p>
                        En Refood, creemos que cada plato cuenta. Tu donación nos ayuda a reducir el desperdicio de alimentos
                        y llevar comida a quienes más lo necesitan. Cada aporte es una oportunidad para cambiar vidas y construir un mundo más sostenible.
                    </p>

                    <h2>¿Cómo Funciona?</h2>
                    <p>
                        Con tu donación, recolectamos alimentos no utilizados de comercios, empresas, productores, para redistribuirlos
                        a comunidades en situación vulnerable. ¡Juntos podemos lograr un cambio real!
                    </p>

                    <h2>Haz tu Donación</h2>
                    <!-- Botón generado dinámicamente por Mercado Pago -->
                    <div id="wallet_container"></div>

                    <script src="https://sdk.mercadopago.com/js/v2"></script>
                    <script>
                        const mp = new MercadoPago('{{ $publicKey }}'); // Public Key pasada desde el controlador
                        mp.bricks().create('wallet', 'wallet_container', {
                            initialization: {
                                preferenceId: "{{ $preferenceId }}", // ID de la preferencia generado en el controlador
                            },
                        });
                    </script>
                </div>
            </div>
        </div>
</x-layout>