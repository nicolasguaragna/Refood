<x-layout>
    <x-slot:title>Donar un Plato</x-slot>

        <div class="container mt-1">
            <h1 class="text-center mb-4">Donar un Plato</h1>
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('images/donation.jpg') }}" alt="Donar un plato" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h2>¿Por qué Donar?</h2>
                    <p>
                        En Refood, creemos que cada plato cuenta. Tu donación nos ayuda a reducir el desperdicio de alimentos
                        y llevar comida a quienes más lo necesitan. Cada aporte es una oportunidad para cambiar vidas y construir un mundo más sostenible.
                    </p>

                    <h2>¿Cómo Funciona?</h2>
                    <p>
                        Con tu donación, recolectamos alimentos no utilizados de comercios, empresas y hogares para redistribuirlos
                        a comunidades en situación vulnerable. ¡Juntos podemos lograr un cambio real!
                    </p>

                    <h2>Haz tu Donación</h2>
                    <!-- Botón generado diDnámicamente por Mercado Pago -->
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