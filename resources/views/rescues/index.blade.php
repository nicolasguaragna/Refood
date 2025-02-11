<x-layout>
    <x-slot:title>Solicitudes de Rescate</x-slot:title>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Lista de Solicitudes de Rescate</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Fecha del Rescate</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rescueRequests as $rescate)
                <tr>
                    <td>{{ $rescate->id }}</td>
                    <td>{{ $rescate->name }}</td>
                    <td>{{ $rescate->location }}</td>
                    <td>{{ $rescate->rescue_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>