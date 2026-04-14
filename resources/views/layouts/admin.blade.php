<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bear Fitness — @yield('titulo', 'Panel Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Roboto', sans-serif; background: #f0f2f5; display: flex; min-height: 100vh; }

        .sidebar {
            width: 240px; background: #0a0a0a; color: white;
            display: flex; flex-direction: column; padding: 20px 0;
            position: fixed; height: 100vh; overflow-y: auto;
        }
        .sidebar-logo {
            display: flex; align-items: center; gap: 10px;
            padding: 0 20px 25px; border-bottom: 1px solid #222;
        }
        .sidebar-logo img { height: 40px; }
        .sidebar-logo span { font-size: 1.1rem; font-weight: 700; color: #FFD700; letter-spacing: 1px; }
        .sidebar-menu { padding: 20px 0; flex: 1; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 12px 20px;
            color: #aaa; text-decoration: none; transition: all 0.2s; font-size: 0.9rem; }
        .sidebar-item:hover, .sidebar-item.active { background: #1a1a1a; color: #FFD700; border-left: 3px solid #FFD700; }
        .sidebar-item span { font-size: 1.2rem; }
        .sidebar-footer { padding: 15px 20px; border-top: 1px solid #222; }
        .sidebar-footer a { color: #aaa; text-decoration: none; font-size: 0.85rem; }

        .main-content { margin-left: 240px; flex: 1; display: flex; flex-direction: column; }
        .topbar {
            background: white; padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08); position: sticky; top: 0; z-index: 100;
        }
        .topbar h1 { font-size: 1.2rem; color: #333; }
        .topbar-user { display: flex; align-items: center; gap: 10px; font-size: 0.9rem; color: #555; }
        .content { padding: 30px; }

        .alert { padding: 12px 18px; border-radius: 6px; margin-bottom: 20px; font-size: 0.9rem; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger  { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        .card { background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 25px; }
        .btn { padding: 9px 20px; border-radius: 6px; text-decoration: none; font-size: 0.875rem;
            font-weight: 600; cursor: pointer; border: none; display: inline-block; transition: opacity 0.2s; }
        .btn:hover { opacity: 0.85; }
        .btn-primary   { background: #1a3aff; color: white; }
        .btn-warning   { background: #FFD700; color: #000; }
        .btn-danger    { background: #dc3545; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-success   { background: #28a745; color: white; }

        table { width: 100%; border-collapse: collapse; }
        th { background: #1a3aff; color: white; padding: 12px 15px; text-align: left; font-size: 0.85rem; }
        td { padding: 11px 15px; border-bottom: 1px solid #f0f0f0; font-size: 0.875rem; color: #444; }
        tr:hover td { background: #f8f9ff; }

        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.875rem; color: #444; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;
            font-size: 0.875rem; outline: none; transition: border 0.2s;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: #1a3aff;
        }
        .form-group .error { color: #dc3545; font-size: 0.8rem; margin-top: 4px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }

        .badge { padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger  { background: #f8d7da; color: #721c24; }
        .badge-info    { background: #d1ecf1; color: #0c5460; }

        .filtros { background: white; padding: 18px 20px; border-radius: 10px;
            display: flex; gap: 12px; flex-wrap: wrap; align-items: flex-end;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .filtros input, .filtros select {
            padding: 9px 12px; border: 1px solid #ddd; border-radius: 6px;
            font-size: 0.875rem; min-width: 160px;
        }
        .nav-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .nav-top h2 { font-size: 1.3rem; color: #222; }
        .acciones { display: flex; gap: 8px; align-items: center; }

        .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; border-radius: 10px; padding: 22px; box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            display: flex; align-items: center; gap: 15px; }
        .stat-icon { font-size: 2.2rem; }
        .stat-info h3 { font-size: 1.8rem; font-weight: 700; color: #1a3aff; }
        .stat-info p  { font-size: 0.85rem; color: #888; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .stat-grid { grid-template-columns: 1fr 1fr; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('img/oso_log.png') }}" alt="Logo">
        <span>BEAR FITNESS</span>
    </div>
    <nav class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span>📊</span> Dashboard
        </a>
        <a href="{{ route('admin.productos.index') }}"
            class="sidebar-item {{ request()->routeIs('admin.productos*') ? 'active' : '' }}">
            <span>🏋️</span> Productos
        </a>
        <a href="{{ route('admin.rutinas.index') }}"
            class="sidebar-item {{ request()->routeIs('admin.rutinas*') ? 'active' : '' }}">
            <span>📅</span> Rutinas
        </a>
    </nav>
    <div class="sidebar-footer">
        <p style="color:#666; font-size:0.8rem; margin-bottom:8px;">{{ auth()->user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none; border:none; color:#aaa; cursor:pointer; font-size:0.85rem;">
                🚪 Cerrar sesión
            </button>
        </form>
    </div>
</aside>

<div class="main-content">
    <div class="topbar">
        <h1>@yield('titulo', 'Panel de Administración')</h1>
        <div class="topbar-user">
            <span>👤</span>
            <span>{{ auth()->user()->name }}</span>
            <span style="background:#1a3aff; color:white; padding:2px 8px; border-radius:10px; font-size:0.75rem;">Admin</span>
        </div>
    </div>
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">❌ {{ session('error') }}</div>
        @endif

        @yield('contenido')
    </div>
</div>

</body>
</html>
