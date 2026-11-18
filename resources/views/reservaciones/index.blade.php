<x-layout titulo="Reservaciones">
    <h3 class="mb-3">
        {{ auth()->user()->esAdmin() ? 'Reservaciones' : 'Mis reservaciones' }}
    </h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            @if (auth()->user()->esAdmin())
                                <th>Usuario</th>
                            @endif
                            <th>Paquete</th>
                            <th>Destino</th>
                            <th>Personas</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservaciones as $reservacion)
                            <tr>
                                @if (auth()->user()->esAdmin())
                                    <td>{{ $reservacion->user->name }}</td>
                                @endif
                                <td>{{ $reservacion->paquete->titulo }}</td>
                                <td>{{ $reservacion->paquete->destino->nombre }}</td>
                                <td>{{ $reservacion->personas }}</td>
                                <td>Q {{ number_format($reservacion->personas * $reservacion->paquete->precio, 2) }}</td>
                                <td>
                                    @if ($reservacion->estado === 'confirmada')
                                        <span class="badge bg-success">Confirmada</span>
                                    @else
                                        <span class="badge bg-danger">Cancelada</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if ($reservacion->estado === 'confirmada')
                                        <form method="POST"
                                              action="{{ route('reservaciones.cancelar', $reservacion) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('¿Cancelar esta reservación?')">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-outline-danger">Cancelar</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No hay reservaciones registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $reservaciones->links() }}
        </div>
    </div>
</x-layout>