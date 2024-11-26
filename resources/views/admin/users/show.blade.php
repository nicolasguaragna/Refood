<x-layout>
    <x-slot:title>Detalles de Usuario</x-slot:title>

    <div class="container">
        <h1>Detalles de {{ $user->name }}</h1>
        <p>Email: {{ $user->email }}</p>

        <h2>Servicios Contratados</h2>
        @if($rescues->isEmpty())
        <p>El usuario no tiene servicios contratados.</p>
        @else
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Contacto</th>
                    <th>Ubicación</th>
                    <th>Detalles</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha del Rescate</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rescues as $request)
                <tr>
                    <td>{{ $request->service->name ?? 'Servicio no disponible' }}</td>
                    <td>{{ $request->contact }}</td>
                    <td>{{ $request->location }}</td>
                    <td>{{ $request->details }}</td>
                    <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $request->rescue_date ? \Carbon\Carbon::parse($request->rescue_date)->format('d/m/Y') : 'No especificado' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-layout>