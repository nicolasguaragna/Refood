<x-layout>
    <x-slot:title>Pago Exitoso</x-slot:title>

    <div class="container mt-5 d-flex flex-column align-items-center">
        <!-- Ícono de éxito -->
        <div class="success-icon mb-3">
            <i class="fas fa-check-circle"></i>
        </div>

        <!-- Mensaje principal -->
        <h1 class="text-success fw-bold text-center">¡Gracias por tu donación! 🎉</h1>
        <p class="text-muted text-center fs-5">Tu apoyo nos ayuda a seguir alimentando a quienes más lo necesitan.</p>

        <!-- Botón sutil y estilizado -->
        <a href="{{ url('/') }}" class="btn btn-success btn-lg mt-3">
            <i class="fas fa-arrow-left"></i> Volver al Inicio
        </a>
    </div>

    <style>
        .success-icon {
            font-size: 4rem;
            color: #6bc097;
            animation: fadeInScale 0.8s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.5);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .btn-outline-success {
            transition: all 0.3s ease-in-out;
            border-radius: 10px;
        }

        .btn-outline-success:hover {
            background-color: #6bc097;
            color: white;
            transform: scale(1.05);
        }
    </style>
</x-layout>