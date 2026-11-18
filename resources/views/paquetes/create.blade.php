<x-layout titulo="Nuevo paquete">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">Nuevo paquete</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('paquetes.store') }}">
                        @csrf
                        @include('paquetes._form')
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">Guardar</button>
                            <a href="{{ route('paquetes.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>