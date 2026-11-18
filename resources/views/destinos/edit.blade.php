<x-layout titulo="Editar destino">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">Editar destino</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('destinos.update', $destino) }}">
                        @csrf
                        @method('PUT')
                        @include('destinos._form')
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">Actualizar</button>
                            <a href="{{ route('destinos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>