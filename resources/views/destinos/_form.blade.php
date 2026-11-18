<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $destino->nombre ?? '') }}"
           class="form-control @error('nombre') is-invalid @enderror">
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">País</label>
    <input type="text" name="pais" value="{{ old('pais', $destino->pais ?? '') }}"
           class="form-control @error('pais') is-invalid @enderror">
    @error('pais')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea name="descripcion" rows="4"
              class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $destino->descripcion ?? '') }}</textarea>
    @error('descripcion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>