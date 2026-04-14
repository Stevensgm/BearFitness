@extends('layouts.admin')
@section('titulo', 'Detalle Rutina')

@section('contenido')
<div style="max-width:650px;">
    <div class="nav-top">
        <h2>👁 {{ $rutina->nombre }}</h2>
        <div style="display:flex;gap:10px;">
            <a href="{{ route('admin.rutinas.edit', $rutina) }}" class="btn btn-warning">✏️ Editar</a>
            <a href="{{ route('admin.rutinas.index') }}" class="btn btn-secondary">← Volver</a>
        </div>
    </div>
    <div class="card">
        <table>
            <tr><td style="font-weight:bold;width:40%;padding:10px;">Nombre</td><td style="padding:10px;">{{ $rutina->nombre }}</td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Día</td><td style="padding:10px;"><span class="badge badge-info">{{ ucfirst($rutina->dia) }}</span></td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Nivel</td><td style="padding:10px;">{{ ucfirst($rutina->nivel) }}</td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Duración</td><td style="padding:10px;">{{ $rutina->duracion_minutos }} minutos</td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Grupo muscular</td><td style="padding:10px;">{{ $rutina->grupo_muscular ?? '—' }}</td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Descripción</td><td style="padding:10px;">{{ $rutina->descripcion ?? '—' }}</td></tr>
            <tr><td style="font-weight:bold;padding:10px;">Estado</td>
                <td style="padding:10px;">
                    <span class="{{ $rutina->activo ? 'badge badge-success' : 'badge badge-danger' }}">
                        {{ $rutina->activo ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
