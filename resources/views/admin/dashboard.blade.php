@extends('layouts.admin')
@section('titulo', 'Dashboard')

@section('contenido')
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon">🏋️</div>
        <div class="stat-info">
            <h3>{{ $totalProductos }}</h3>
            <p>Productos</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">📅</div>
        <div class="stat-info">
            <h3>{{ $totalRutinas }}</h3>
            <p>Rutinas</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-info">
            <h3>{{ $totalClientes }}</h3>
            <p>Clientes</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">⚠️</div>
        <div class="stat-info">
            <h3 style="color:#dc3545;">{{ $sinStock }}</h3>
            <p>Sin stock</p>
        </div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
    <div class="card">
        <h3 style="margin-bottom:15px; color:#1a3aff;">⚡ Accesos rápidos</h3>
        <div style="display:flex; flex-direction:column; gap:10px;">
            <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">+ Agregar Producto</a>
            <a href="{{ route('admin.rutinas.create') }}" class="btn btn-success">+ Agregar Rutina</a>
            <a href="{{ route('admin.productos.pdf') }}" class="btn btn-secondary">📄 PDF Productos</a>
            <a href="{{ route('admin.rutinas.pdf') }}" class="btn btn-secondary">📄 PDF Rutinas</a>
        </div>
    </div>
    <div class="card">
        <h3 style="margin-bottom:15px; color:#1a3aff;">ℹ️ Bienvenido</h3>
        <p style="color:#666; line-height:1.7;">
            Bienvenido al panel de administración de <strong>Bear Fitness</strong>.<br><br>
            Desde aquí puedes gestionar los productos del gimnasio, las rutinas semanales,
            y generar reportes en PDF.
        </p>
    </div>
</div>
@endsection
