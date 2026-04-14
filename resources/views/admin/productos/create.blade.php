@extends('layouts.admin')
@section('titulo', 'Agregar Producto')

@section('contenido')
<div style="max-width:700px;">
    <div class="nav-top">
        <h2>🏋️ Nuevo Producto</h2>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <div class="card">
        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre') <p class="error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label>Categoría *</label>
                    <select name="categoria" required>
                        <option value="">Seleccionar...</option>
                        <option value="suplementos" {{ old('categoria') == 'suplementos' ? 'selected' : '' }}>Suplementos</option>
                        <option value="ropa"        {{ old('categoria') == 'ropa'        ? 'selected' : '' }}>Ropa</option>
                        <option value="accesorios"  {{ old('categoria') == 'accesorios'  ? 'selected' : '' }}>Accesorios</option>
                    </select>
                    @error('categoria') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Precio de compra *</label>
                    <input type="number" step="0.01" name="precio" value="{{ old('precio') }}" required>
                    @error('precio') <p class="error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label>Precio de venta *</label>
                    <input type="number" step="0.01" name="precio_venta" value="{{ old('precio_venta') }}" required>
                    @error('precio_venta') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" required>
                    @error('stock') <p class="error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label>Imagen</label>
                    <input type="file" name="imagen" accept="image/*">
                    @error('imagen') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="activo" value="1" {{ old('activo', '1') ? 'checked' : '' }}
                        style="width:auto;">
                    Producto activo (visible para clientes)
                </label>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit" class="btn btn-primary">💾 Guardar Producto</button>
                <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
