<x-layout>
    <x-slot:title>Contáctanos</x-slot>

    <div class="container mt-5">
        <div class="row">
            <!-- Columna izquierda con el fondo de color y los datos de contacto (30%) -->
            <div class="col-md-4 d-flex align-items-center justify-content-center contact-info">
                <div class="text-center">
                    <h2>Departamento de Comunicación</h2>
                    <p><strong>Nicolás Guaragna</strong><br>Responsable de Comunicación</p>
                    <p><i class="fas fa-envelope"></i> refood@refood.com.ar</p>
                    <p><i class="fas fa-phone"></i> 11 3312 4697</p>
                </div>
            </div>

            <!-- Columna derecha con el formulario de contacto (70%) -->
            <div class="col-md-8">
                <h1 class="text-center mb-4">Contáctanos</h1>

                <!-- Mostrar mensajes de error si los hay -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Mostrar mensaje de éxito -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Formulario para enviar el mensaje con estilo -->
                <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control contact-input" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control contact-input" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control contact-input no-resize" id="mensaje" name="mensaje" rows="5" required>{{ old('mensaje') }}</textarea>
                    </div>

                    <div class="text-center">
                    <button type="submit" class="btn contact-button">Enviar Mensaje</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>