@extends('layouts.admin')
@section('titulo', 'Nueva Rutina')

@section('contenido')
<div style="max-width:700px;">
    <div class="nav-top">
        <h2>📅 Nueva Rutina</h2>
        <a href="{{ route('admin.rutinas.index') }}" class="btn btn-secondary">← Volver</a>
    </div>
    <div class="card">
        <form action="{{ route('admin.rutinas.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre') <p class="error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label>Día *</label>
                    <select name="dia" required>
                        <option value="">Seleccionar...</option>
                        @foreach(['lunes','martes','miercoles','jueves','viernes','sabado','domingo'] as $d)
                            <option value="{{ $d }}" {{ old('dia') == $d ? 'selected' : '' }}>{{ ucfirst($d) }}</option>
                        @endforeach
                    </select>
                    @error('dia') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Nivel *</label>
                    <select name="nivel" required>
                        <option value="principiante" {{ old('nivel') == 'principiante' ? 'selected' : '' }}>Principiante</option>
                        <option value="intermedio"   {{ old('nivel') == 'intermedio'   ? 'selected' : '' }}>Intermedio</option>
                        <option value="avanzado"     {{ old('nivel') == 'avanzado'     ? 'selected' : '' }}>Avanzado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Duración (minutos) *</label>
                    <input type="number" name="duracion_minutos" value="{{ old('duracion_minutos', 60) }}" min="1" required>
                </div>
            </div>

            <div class="form-group">
                <label>Grupo muscular</label>
                <input type="text" name="grupo_muscular" value="{{ old('grupo_muscular') }}"
                    placeholder="Ej: Pecho, Espalda, Piernas...">
            </div>

            <div class="form-group">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="activo" value="1" checked style="width:auto;">
                    Rutina activa
                </label>
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">💾 Guardar Rutina</button>
                <a href="{{ route('admin.rutinas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
