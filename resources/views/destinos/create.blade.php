<x-layout titulo="Nuevo destino">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">Nuevo destino</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('destinos.store') }}">
                        @csrf
                        @include('destinos._form')
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">Guardar</button>
                            <a href="{{ route('destinos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>