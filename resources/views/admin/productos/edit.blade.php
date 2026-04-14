@extends('layouts.admin')
@section('titulo', 'Editar Producto')

@section('contenido')
<div style="max-width:700px;">
    <div class="nav-top">
        <h2>✏️ Editar: {{ $producto->nombre }}</h2>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <div class="card">
        <form action="{{ route('admin.productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PATCH')

            <div class="form-row">
                <div class="form-group">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                    @error('nombre') <p class="error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label>Categoría *</label>
                    <select name="categoria" required>
                        <option value="suplementos" {{ old('categoria', $producto->categoria) == 'suplementos' ? 'selected' : '' }}>Suplementos</option>
                        <option value="ropa"        {{ old('categoria', $producto->categoria) == 'ropa'        ? 'selected' : '' }}>Ropa</option>
                        <option value="accesorios"  {{ old('categoria', $producto->categoria) == 'accesorios'  ? 'selected' : '' }}>Accesorios</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Precio de compra *</label>
                    <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" required>
                </div>
                <div class="form-group">
                    <label>Precio de venta *</label>
                    <input type="number" step="0.01" name="precio_venta" value="{{ old('precio_venta', $producto->precio_venta) }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" required>
                </div>
                <div class="form-group">
                    <label>Imagen actual</label>
                    @if($producto->imagen)
                        <img src="{{ asset('img/productos/' . $producto->imagen) }}"
                            style="height:60px; border-radius:6px; display:block; margin-bottom:8px;">
                    @endif
                    <input type="file" name="imagen" accept="image/*">
                    <small style="color:#888;">Dejar vacío para conservar la imagen actual</small>
                </div>
            </div>

            <div class="form-group">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="activo" value="1"
                        {{ old('activo', $producto->activo) ? 'checked' : '' }} style="width:auto;">
                    Producto activo
                </label>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit" class="btn btn-primary">💾 Actualizar</button>
                <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
