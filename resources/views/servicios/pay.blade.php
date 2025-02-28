<x-layout>
    <x-slot:title>Pagar Servicio</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Pago del Servicio</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Tarjeta de detalles del servicio y pago -->
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">📌 Detalles del Servicio</h5>

                        <!-- Mostrar el nombre del servicio -->
                        <p><strong>Servicio:</strong> {{ $service->service->name ?? 'Servicio no disponible' }}</p>

                        <!-- Mostrar el precio formateado -->
                        <p><strong>Precio:</strong> <span class="text-success fw-bold">${{ number_format($service->service->price, 2) }}</span></p>

                        <hr>

                        <!-- SDK de MercadoPago -->
                        <script src="https://sdk.mercadopago.com/js/v2"></script>

                        <!-- Contenedor para el botón de pago -->
                        <div id="wallet_container" class="mt-3"></div>

                        <script>
                            // Inicializar el objeto de MercadoPago con la clave pública
                            const mp = new MercadoPago("{{ $publicKey }}", {
                                locale: "es-AR"
                            });

                            // Generar el botón de pago
                            mp.checkout({
                                preference: {
                                    id: "{{ $preferenceId }}" // Se usa la preferencia de pago generada en el backend
                                },
                                render: {
                                    container: "#wallet_container", // ID del contenedor donde se renderiza el botón
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