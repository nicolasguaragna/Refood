<x-layout>
    <x-slot:title>Pagar Servicio</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Pago del Servicio</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">📌 Detalles del Servicio</h5>

                        <p><strong>Servicio:</strong> {{ $service->service->name ?? 'Servicio no disponible' }}</p>
                        <p><strong>Precio:</strong> <span class="text-success fw-bold">${{ number_format($service->service->price, 2) }}</span></p>

                        <hr>

                        <script src="https://sdk.mercadopago.com/js/v2"></script>
                        <div id="wallet_container" class="mt-3"></div>

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
                                    label: "🛒 Pagar con MercadoPago"
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>