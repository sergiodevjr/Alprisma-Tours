<x-layout titulo="Dashboard">
    <div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4 class="card-title mb-0">Bienvenido, {{ auth()->user()->name }}</h4>
    </div>
</div>

    <div class="row g-3 mb-4 resumen">
        @foreach ($datos as $titulo => $valor)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 border-top border-primary border-4 h-100">
                    <div class="card-body">
                        <p class="text-muted small mb-1">{{ $titulo }}</p>
                        <p class="display-6 fw-bold mb-0">{{ $valor }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('catalogo') }}" class="btn btn-primary">Ver paquetes disponibles</a>
        <a href="{{ route('reservaciones.index') }}" class="btn btn-dark">
            {{ auth()->user()->esAdmin() ? 'Ver reservaciones' : 'Mis reservaciones' }}
        </a>
    </div>
</x-layout>