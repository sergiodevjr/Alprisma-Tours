<x-layout titulo="Paquetes">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Paquetes turísticos</h3>
        <a href="{{ route('paquetes.create') }}" class="btn btn-primary">Nuevo paquete</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('paquetes.index') }}" class="row g-2 mb-3">
                <div class="col-md-6">
                    <input type="text" name="buscar" value="{{ $buscar }}"
                           placeholder="Buscar por título o destino" class="form-control">
                </div>
                <div class="col-auto">
                    <button class="btn btn-dark">Buscar</button>
                    @if ($buscar)
                        <a href="{{ route('paquetes.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th>Destino</th>
                            <th>Precio</th>
                            <th>Cupos</th>
                            <th>Salida</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($paquetes as $paquete)
                            <tr>
                                <td>{{ $paquete->titulo }}</td>
                                <td>{{ $paquete->destino->nombre }}</td>
                                <td>Q {{ number_format($paquete->precio, 2) }}</td>
                                <td>
                                    @if ($paquete->cupos == 0)
                                        <span class="badge bg-danger">Agotado</span>
                                    @elseif ($paquete->cupos <= 3)
                                        <span class="badge bg-warning text-dark">{{ $paquete->cupos }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $paquete->cupos }}</span>
                                    @endif
                                </td>
                                <td>{{ $paquete->fecha_salida->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('paquetes.edit', $paquete) }}"
                                       class="btn btn-sm btn-outline-primary">Editar</a>
                                    <form method="POST" action="{{ route('paquetes.destroy', $paquete) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('¿Eliminar este paquete?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No hay paquetes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $paquetes->links() }}
        </div>
    </div>
</x-layout>