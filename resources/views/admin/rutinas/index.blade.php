@extends('layouts.admin')
@section('titulo', 'Rutinas')

@section('contenido')
<div class="nav-top">
    <h2>📅 Rutinas Semanales</h2>
    <div class="acciones">
        <a href="{{ route('admin.rutinas.create') }}" class="btn btn-primary">+ Agregar</a>
        <a href="{{ route('admin.rutinas.pdf', request()->query()) }}" class="btn btn-secondary" target="_blank">📄 PDF</a>
    </div>
</div>

<form action="{{ route('admin.rutinas.index') }}" method="GET" class="filtros">
    <input type="text" name="buscar" placeholder="Buscar rutina..." value="{{ request('buscar') }}">
    <select name="dia">
        <option value="">Todos los días</option>
        @foreach(['lunes','martes','miercoles','jueves','viernes','sabado','domingo'] as $d)
        <option value="{{ $d }}" {{ request('dia') == $d ? 'selected' : '' }}>{{ ucfirst($d) }}</option>
        @endforeach
    </select>
    <select name="nivel">
        <option value="">Todos los niveles</option>
        <option value="principiante" {{ request('nivel') == 'principiante' ? 'selected' : '' }}>Principiante</option>
        <option value="intermedio" {{ request('nivel') == 'intermedio'   ? 'selected' : '' }}>Intermedio</option>
        <option value="avanzado" {{ request('nivel') == 'avanzado'     ? 'selected' : '' }}>Avanzado</option>
    </select>
    <button type="submit" class="btn btn-primary">Filtrar</button>
    <a href="{{ route('admin.rutinas.index') }}" class="btn btn-secondary">Limpiar</a>
</form>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Día</th>
                <th>Nivel</th>
                <th>Duración</th>
                <th>Músculo</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rutinas as $rutina)
            <tr>
                <td>{{ $rutina->id }}</td>
                <td><strong>{{ $rutina->nombre }}</strong></td>
                <td><span class="badge badge-info">{{ ucfirst($rutina->dia) }}</span></td>
                <td>
                    @php
                    $colores = ['principiante'=>'badge-success','intermedio'=>'badge-info','avanzado'=>'badge-danger'];
                    @endphp
                    <span class="badge {{ $colores[$rutina->nivel] ?? 'badge-info' }}">
                        {{ ucfirst($rutina->nivel) }}
                    </span>
                </td>
                <td>{{ $rutina->duracion_minutos }} min</td>
                <td>{{ $rutina->grupo_muscular ?? '—' }}</td>
                <td>
                    <span class="{{ $rutina->activo ? 'badge badge-success' : 'badge badge-danger' }}">
                        {{ $rutina->activo ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.rutinas.show', $rutina) }}" class="btn btn-secondary" style="padding:5px 10px;">👁</a>
                        <a href="{{ route('admin.rutinas.edit', $rutina) }}" class="btn btn-warning" style="padding:5px 10px;">✏️</a>
                        <form action="{{ route('admin.rutinas.destroy', $rutina) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar esta rutina?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding:5px 10px;">🗑</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; color:#aaa; padding:30px;">
                    No hay rutinas registradas.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:20px;">{{ $rutinas->links() }}</div>
</div>
@endsection