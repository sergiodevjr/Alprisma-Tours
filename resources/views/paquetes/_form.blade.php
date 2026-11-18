<div class="mb-3">
    <label class="form-label">Destino</label>
    <select name="destino_id" class="form-select @error('destino_id') is-invalid @enderror">
        <option value="">-- Selecciona un destino --</option>
        @foreach ($destinos as $destino)
            <option value="{{ $destino->id }}"
                {{ old('destino_id', $paquete->destino_id ?? '') == $destino->id ? 'selected' : '' }}>
                {{ $destino->nombre }} ({{ $destino->pais }})
            </option>
        @endforeach
    </select>
    @error('destino_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Título del paquete</label>
    <input type="text" name="titulo" value="{{ old('titulo', $paquete->titulo ?? '') }}"
           class="form-control @error('titulo') is-invalid @enderror">
    @error('titulo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Precio (Q)</label>
        <input type="number" step="0.01" name="precio" value="{{ old('precio', $paquete->precio ?? '') }}"
               class="form-control @error('precio') is-invalid @enderror">
        @error('precio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Cupos disponibles</label>
        <input type="number" name="cupos" value="{{ old('cupos', $paquete->cupos ?? '') }}"
               class="form-control @error('cupos') is-invalid @enderror">
        @error('cupos')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Fecha de salida</label>
    <input type="date" name="fecha_salida"
           value="{{ old('fecha_salida', isset($paquete) ? $paquete->fecha_salida->format('Y-m-d') : '') }}"
           class="form-control @error('fecha_salida') is-invalid @enderror">
    @error('fecha_salida')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>