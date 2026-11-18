<x-layout titulo="Paquetes disponibles">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Paquetes disponibles</h3>
    </div>

    <form method="GET" action="{{ route('catalogo') }}" class="row g-2 mb-4">
        <div class="col-md-6">
            <input type="text" name="buscar" value="{{ $buscar }}"
                   placeholder="Buscar por título o destino" class="form-control">
        </div>
        <div class="col-auto">
            <button class="btn btn-dark">Buscar</button>
            @if ($buscar)
                <a href="{{ route('catalogo') }}" class="btn btn-outline-secondary">Limpiar</a>
            @endif
        </div>
    </form>

    <div class="row g-4">
        @forelse ($paquetes as $paquete)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100 border-0 border-top border-primary border-4">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $paquete->titulo }}</h5>
                        <p class="text-muted mb-2">
                            {{ $paquete->destino->nombre }}, {{ $paquete->destino->pais }}
                        </p>

                        <p class="fs-3 fw-bold mb-0">Q {{ number_format($paquete->precio, 2) }}</p>
                        <p class="text-muted small">por persona</p>

                        <p class="mb-2">Salida: {{ $paquete->fecha_salida->format('d/m/Y') }}</p>

                        <p class="mb-3">
                            @if ($paquete->cupos <= 3)
                                <span class="badge bg-warning text-dark">
                                    ¡Últimos cupos! Quedan {{ $paquete->cupos }}
                                </span>
                            @else
                                <span class="badge bg-success">
                                    Cupos disponibles: {{ $paquete->cupos }}
                                </span>
                            @endif
                        </p>

                        <a href="{{ route('reservaciones.create', $paquete) }}"
                           class="btn btn-primary mt-auto">Reservar</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mb-0">No hay paquetes disponibles por el momento.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">{{ $paquetes->links() }}</div>
</x-layout>