<x-layout titulo="Reservar paquete">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">Reservar paquete</div>
                <div class="card-body">
                    <h5 class="mb-1">{{ $paquete->titulo }}</h5>
                    <p class="text-muted">
                        {{ $paquete->destino->nombre }}, {{ $paquete->destino->pais }}
                    </p>

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Precio por persona</span>
                            <strong>Q {{ number_format($paquete->precio, 2) }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Fecha de salida</span>
                            <strong>{{ $paquete->fecha_salida->format('d/m/Y') }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Cupos disponibles</span>
                            <strong>{{ $paquete->cupos }}</strong>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('reservaciones.store', $paquete) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Número de personas</label>
                            <input type="number" name="personas" value="{{ old('personas', 1) }}"
                                   min="1" max="10"
                                   class="form-control @error('personas') is-invalid @enderror">
                            @error('personas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">Confirmar reservación</button>
                            <a href="{{ route('catalogo') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>