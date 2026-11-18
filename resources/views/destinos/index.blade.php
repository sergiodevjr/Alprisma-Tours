<x-layout titulo="Destinos">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Destinos</h3>
        <a href="{{ route('destinos.create') }}" class="btn btn-primary">Nuevo destino</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('destinos.index') }}" class="row g-2 mb-3">
                <div class="col-md-6">
                    <input type="text" name="buscar" value="{{ $buscar }}"
                           placeholder="Buscar por nombre o país" class="form-control">
                </div>
                <div class="col-auto">
                    <button class="btn btn-dark">Buscar</button>
                    @if ($buscar)
                        <a href="{{ route('destinos.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>País</th>
                            <th>Descripción</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($destinos as $destino)
                            <tr>
                                <td>{{ $destino->nombre }}</td>
                                <td>{{ $destino->pais }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($destino->descripcion, 60) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('destinos.edit', $destino) }}"
                                       class="btn btn-sm btn-outline-primary">Editar</a>
                                    <form method="POST" action="{{ route('destinos.destroy', $destino) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('¿Eliminar este destino?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No hay destinos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $destinos->links() }}
        </div>
    </div>
</x-layout>