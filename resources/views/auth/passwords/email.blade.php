<x-layout>
    <x-slot:title>Restablecer Contraseña</x-slot:title>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- Encabezado de la tarjeta -->
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <!-- Muestra un mensaje de éxito si se ha enviado el enlace de restablecimiento -->
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <!-- Formulario para solicitar el enlace de restablecimiento de contraseña -->
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf <!-- Token CSRF para evitar ataques -->

                            <!-- Campo de entrada para el correo electrónico -->
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    <!-- Muestra mensaje de error si hay problemas con el email -->
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botón para enviar el formulario y solicitar el enlace de restablecimiento -->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>