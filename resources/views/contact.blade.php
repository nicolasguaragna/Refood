<x-layout>
    <x-slot:title>Contáctanos</x-slot>

    <div class="container mt-5">
        <div class="row">
            <!-- Columna izquierda con el fondo de color y los datos de contacto (30%) -->
            <div class="col-md-4 d-flex align-items-center justify-content-center" style="background-color: #a5c923; color: black;">
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
                <form action="{{ route('contact.store') }}" method="POST" style="border: 2px solid #a5c923; border-radius: 10px; padding: 20px; background-color: #f9f9f9;">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required style="border: 1px solid #a5c923;">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required style="border: 1px solid #a5c923;">
                    </div>

                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required style="border: 1px solid #a5c923; resize: none;">{{ old('mensaje') }}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="background-color: #a5c923; border-color: #a5c923;">Enviar Mensaje</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>