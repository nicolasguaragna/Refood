<x-layout>
    <x-slot:title>Verificar Correo Electrónico</x-slot:title>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- Encabezado de la tarjeta -->
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        <!-- Mostrar mensaje si se ha reenviado el correo de verificación -->
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                        @endif

                        <!-- Mensajes de instrucciones para el usuario -->
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},

                        <!-- Formulario para reenviar el correo de verificación -->
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf <!-- Token CSRF para evitar ataques de falsificación de solicitudes -->
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>