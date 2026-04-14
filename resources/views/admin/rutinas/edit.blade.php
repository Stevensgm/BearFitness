@extends('layouts.admin')
@section('titulo', 'Editar Rutina')

@section('contenido')
<div style="max-width:700px;">
    <div class="nav-top">
        <h2>✏️ Editar: {{ $rutina->nombre }}</h2>
        <a href="{{ route('admin.rutinas.index') }}" class="btn btn-secondary">← Volver</a>
    </div>
    <div class="card">
        <form action="{{ route('admin.rutinas.update', $rutina) }}" method="POST">
            @csrf @method('PATCH')

            <div class="form-row">
                <div class="form-group">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $rutina->nombre) }}" required>
                    @error('nombre') <p class="error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label>Día *</label>
                    <select name="dia" required>
                        @foreach(['lunes','martes','miercoles','jueves','viernes','sabado','domingo'] as $d)
                            <option value="{{ $d }}" {{ old('dia', $rutina->dia) == $d ? 'selected' : '' }}>{{ ucfirst($d) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" rows="3">{{ old('descripcion', $rutina->descripcion) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Nivel *</label>
                    <select name="nivel" required>
                        <option value="principiante" {{ old('nivel', $rutina->nivel) == 'principiante' ? 'selected' : '' }}>Principiante</option>
                        <option value="intermedio"   {{ old('nivel', $rutina->nivel) == 'intermedio'   ? 'selected' : '' }}>Intermedio</option>
                        <option value="avanzado"     {{ old('nivel', $rutina->nivel) == 'avanzado'     ? 'selected' : '' }}>Avanzado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Duración (minutos) *</label>
                    <input type="number" name="duracion_minutos" value="{{ old('duracion_minutos', $rutina->duracion_minutos) }}" min="1" required>
                </div>
            </div>

            <div class="form-group">
                <label>Grupo muscular</label>
                <input type="text" name="grupo_muscular" value="{{ old('grupo_muscular', $rutina->grupo_muscular) }}">
            </div>

            <div class="form-group">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="activo" value="1"
                        {{ old('activo', $rutina->activo) ? 'checked' : '' }} style="width:auto;">
                    Rutina activa
                </label>
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">💾 Actualizar</button>
                <a href="{{ route('admin.rutinas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
