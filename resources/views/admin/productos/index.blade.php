@extends('layouts.admin')
@section('titulo', 'Productos')

@section('contenido')

<div class="nav-top">
    <h2>🏋️ Productos</h2>
    <div class="acciones">
        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">+ Agregar</a>
        <a href="{{ route('admin.productos.pdf', request()->query()) }}" class="btn btn-secondary">📄 PDF</a>
    </div>
</div>

<form action="{{ route('admin.productos.index') }}" method="GET" class="filtros">
    <input type="text" name="buscar" placeholder="Buscar producto..." value="{{ request('buscar') }}">
    <select name="categoria">
        <option value="">Todas las categorías</option>
        <option value="suplementos" {{ request('categoria') == 'suplementos' ? 'selected' : '' }}>Suplementos</option>
        <option value="ropa"        {{ request('categoria') == 'ropa'        ? 'selected' : '' }}>Ropa</option>
        <option value="accesorios"  {{ request('categoria') == 'accesorios'  ? 'selected' : '' }}>Accesorios</option>
    </select>
    <select name="stock">
        <option value="">Todo el stock</option>
        <option value="con" {{ request('stock') == 'con' ? 'selected' : '' }}>Con stock</option>
        <option value="sin" {{ request('stock') == 'sin' ? 'selected' : '' }}>Sin stock</option>
    </select>
    <button type="submit" class="btn btn-primary">Filtrar</button>
    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Limpiar</a>
</form>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>P. Venta</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>
                    @if($producto->imagen)
                        <img src="{{ asset('img/productos/' . $producto->imagen) }}"
                            style="height:45px;width:45px;object-fit:cover;border-radius:6px;">
                    @else
                        <span style="color:#ccc;">Sin imagen</span>
                    @endif
                </td>
                <td><strong>{{ $producto->nombre }}</strong></td>
                <td><span class="badge badge-info">{{ ucfirst($producto->categoria) }}</span></td>
                <td>$ {{ number_format($producto->precio, 2) }}</td>
                <td>$ {{ number_format($producto->precio_venta, 2) }}</td>
                <td>
                    <span class="{{ $producto->stock > 0 ? 'badge badge-success' : 'badge badge-danger' }}">
                        {{ $producto->stock }}
                    </span>
                </td>
                <td>
                    <span class="{{ $producto->activo ? 'badge badge-success' : 'badge badge-danger' }}">
                        {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.productos.show', $producto) }}" class="btn btn-secondary" style="padding:5px 10px;">👁</a>
                        <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-warning" style="padding:5px 10px;">✏️</a>
                        <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding:5px 10px;">🗑</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align:center; color:#aaa; padding:30px;">
                    No hay productos registrados.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px;">
        {{ $productos->links() }}
    </div>
</div>
@endsection
