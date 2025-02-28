<x-layout>
    <x-slot:title>Restablecer Contraseña</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- Encabezado de la tarjeta -->
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <!-- Formulario para restablecer la contraseña -->
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf <!-- Token CSRF para evitar ataques -->

                            <!-- Campo oculto que almacena el token de restablecimiento de contraseña -->
                            <input type="hidden" name="token" value="{{ $token }}">

                            <!-- Campo de correo electrónico -->
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    <!-- Muestra mensaje de error si hay problemas con el email -->
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Campo de nueva contraseña -->
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    <!-- Muestra mensaje de error si la contraseña no es válida -->
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Campo de confirmación de nueva contraseña -->
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- Botón para enviar el formulario y restablecer la contraseña -->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
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