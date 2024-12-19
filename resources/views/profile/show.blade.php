<x-layout>
    <x-slot:title>Perfil de Usuario</x-slot>

        <div class="container mt-4">
            <!-- Mostrar mensaje de feedback -->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <h1 class="text-center">Mi Perfil</h1>
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Editar Perfil</a>
                </div>
            </div>
        </div>
</x-layout>