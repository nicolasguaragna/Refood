<x-layout>
    <x-slot:title>Crear Nueva Entrada de Blog</x-slot:title>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Nueva Entrada de Blog</h1>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/blog') }}" method="POST">
            @csrf  <!-- Protege contra ataques CSRF -->

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenido</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Crear Entrada</button>
        </form>
    </div>
</x-layout>
