<x-layout>
    <x-slot:title>Detalles de Usuario</x-slot:title>

    <div class="container">
        <h1>Detalles de {{ $user->name }}</h1>
        <p>Email: {{ $user->email }}</p>

        <h2>Servicios Contratados</h2>
        @if($user->rescueRequests->isEmpty())
            <p>El usuario no tiene servicios contratados.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Contacto</th>
                        <th>Ubicación</th>
                        <th>Detalles</th>
                        <th>Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->rescueRequests as $request)
                        <tr>
                            <td>{{ $request->service->name }}</td>
                            <td>{{ $request->contact }}</td>
                            <td>{{ $request->location }}</td>
                            <td>{{ $request->details }}</td>
                            <td>{{ $request->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layout>
