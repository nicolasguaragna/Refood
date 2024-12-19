<x-layout>
    <x-slot:title>Perfil de Usuario</x-slot>

        <div class="container mt-4">
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