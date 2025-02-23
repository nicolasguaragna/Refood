<x-layout>
    <x-slot:title>Administrar Usuarios</x-slot:title>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Lista de Usuarios</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Rescates</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->contact ?? 'No registrado' }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="collapse" data-bs-target="#rescates-{{ $user->id }}">
                                Ver Rescates
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="collapse" id="rescates-{{ $user->id }}">
                                @if($user->rescueRequests->isEmpty())
                                <p class="text-center mt-2">No ha solicitado rescates.</p>
                                @else
                                <table class="table table-sm table-bordered mt-2">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Ubicación</th>
                                            <th>Detalles</th>
                                            <th>Fecha de Rescate</th>
                                            <th>Pago</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->rescueRequests as $rescue)
                                        <tr>
                                            <td>{{ $rescue->location }}</td>
                                            <td>{{ $rescue->details }}</td>
                                            <td>{{ $rescue->rescue_date->format('d/m/Y') }}</td>
                                            <td>
                                                @if($rescue->is_paid)
                                                <span class="badge bg-success">Pagado</span>
                                                @else
                                                <span class="badge bg-warning">Pendiente</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.rescue.updateStatus', $rescue->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                        <option value="Pendiente" {{ $rescue->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                        <option value="Visto" {{ $rescue->status == 'Visto' ? 'selected' : '' }}>Visto</option>
                                                        <option value="Para ser retirado" {{ $rescue->status == 'Para ser retirado' ? 'selected' : '' }}>Para ser retirado</option>
                                                        <option value="Retirado" {{ $rescue->status == 'Retirado' ? 'selected' : '' }}>Retirado</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>