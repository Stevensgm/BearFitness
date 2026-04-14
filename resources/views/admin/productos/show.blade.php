@extends('layouts.admin')
@section('titulo', 'Detalle Producto')

@section('contenido')
<div style="max-width:650px;">
    <div class="nav-top">
        <h2>👁 {{ $producto->nombre }}</h2>
        <div style="display:flex;gap:10px;">
            <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-warning">✏️ Editar</a>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">← Volver</a>
        </div>
    </div>
    <div class="card">
        @if($producto->imagen)
            <img src="{{ asset('img/productos/' . $producto->imagen) }}"
                style="width:100%;max-height:250px;object-fit:cover;border-radius:8px;margin-bottom:20px;">
        @endif
        <table>
            <tr><td style="font-weight:bold;width:40%;padding:10px;">Nombre</td><td style="padding:10px;">{{ $producto->nombre }}</td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Categoría</td><td style="padding:10px;">{{ ucfirst($producto->categoria) }}</td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Descripción</td><td style="padding:10px;">{{ $producto->descripcion ?? '—' }}</td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Precio compra</td><td style="padding:10px;">$ {{ number_format($producto->precio, 2) }}</td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Precio venta</td><td style="padding:10px;">$ {{ number_format($producto->precio_venta, 2) }}</td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Stock</td>
                <td style="padding:10px;">
                    <span class="{{ $producto->stock > 0 ? 'badge badge-success' : 'badge badge-danger' }}">
                        {{ $producto->stock }} unidades
                    </span>
                </td>
            </tr>
            <tr><td style="font-weight:bold;padding:10px;">Estado</td>
                <td style="padding:10px;">
                    <span class="{{ $producto->activo ? 'badge badge-success' : 'badge badge-danger' }}">
                        {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
