<x-layout>
    <x-slot:title>Pagar Servicio</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Pago del Servicio</h1>

        <p><strong>Servicio:</strong> {{ $service->service->name ?? 'Servicio no disponible' }}</p>
        <p><strong>Precio:</strong> ${{ number_format($service->service->price, 2) }}</p>

        <div class="text-center">
            <script src="https://sdk.mercadopago.com/js/v2"></script>
            <div id="wallet_container"></div>
            <script>
                const mp = new MercadoPago("{{ $publicKey }}", {
                    locale: "es-AR"
                });

                mp.checkout({
                    preference: {
                        id: "{{ $preferenceId }}"
                    },
                    render: {
                        container: "#wallet_container",
                        label: "Pagar con MercadoPago"
                    }
                });
            </script>
        </div>
    </div>
</x-layout>