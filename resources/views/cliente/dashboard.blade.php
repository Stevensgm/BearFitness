<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bear Fitness — Mi Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Roboto',sans-serif; background:#f0f2f5; }
        .topbar { background:#0a0a0a; color:white; padding:15px 30px; display:flex; justify-content:space-between; align-items:center; }
        .topbar-logo { font-family:'Bebas Neue',sans-serif; font-size:1.5rem; color:#FFD700; letter-spacing:2px; }
        .topbar-user { display:flex; align-items:center; gap:15px; font-size:0.9rem; }
        .topbar-user form button { background:none; border:1px solid #555; color:#aaa; padding:6px 14px; border-radius:4px; cursor:pointer; }

        .hero { background:linear-gradient(135deg,#1a3aff,#0a0a0a); color:white; padding:50px 30px; text-align:center; }
        .hero h1 { font-family:'Bebas Neue',sans-serif; font-size:3rem; letter-spacing:3px; }
        .hero p { font-size:1.1rem; opacity:0.8; margin-top:8px; }

        .content { max-width:1100px; margin:0 auto; padding:30px 20px; }

        h2 { font-family:'Bebas Neue',sans-serif; font-size:2rem; letter-spacing:2px; color:#1a3aff; margin:30px 0 15px; }

        .rutinas-semana { display:grid; grid-template-columns:repeat(7,1fr); gap:10px; margin-bottom:40px; }
        .dia-card { background:white; border-radius:10px; padding:15px 10px; text-align:center;
            box-shadow:0 2px 8px rgba(0,0,0,0.07); }
        .dia-card .dia-nombre { font-family:'Bebas Neue',sans-serif; font-size:1rem; color:#1a3aff;
            letter-spacing:1px; border-bottom:2px solid #1a3aff; padding-bottom:8px; margin-bottom:10px; }
        .dia-card .rutina-item { background:#f4f6ff; border-radius:6px; padding:8px; margin-bottom:6px;
            font-size:0.78rem; text-align:left; }
        .dia-card .rutina-item strong { display:block; color:#222; margin-bottom:2px; }
        .dia-card .rutina-item span { color:#888; }
        .dia-card .vacio { color:#ccc; font-size:0.8rem; margin-top:10px; }

        .productos-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
        .producto-card { background:white; border-radius:10px; overflow:hidden;
            box-shadow:0 2px 8px rgba(0,0,0,0.07); transition:transform 0.2s; }
        .producto-card:hover { transform:translateY(-4px); }
        .producto-card img { width:100%; height:160px; object-fit:cover; }
        .producto-card .sin-img { width:100%; height:160px; background:#f0f2f5; display:flex;
            align-items:center; justify-content:center; font-size:3rem; }
        .producto-info { padding:15px; }
        .producto-info h3 { font-size:1rem; margin-bottom:6px; }
        .producto-info .precio { font-size:1.1rem; font-weight:700; color:#1a3aff; }
        .producto-info .categoria { font-size:0.78rem; color:#888; background:#f0f2f5;
            padding:2px 8px; border-radius:10px; display:inline-block; margin-bottom:8px; }

        @media(max-width:768px) {
            .rutinas-semana { grid-template-columns:1fr 1fr; }
            .productos-grid { grid-template-columns:1fr 1fr; }
        }
        @media(max-width:500px) {
            .rutinas-semana { grid-template-columns:1fr; }
            .productos-grid { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

<div class="topbar">
    <div class="topbar-logo">🐻 BEAR FITNESS</div>
    <div class="topbar-user">
        <span>👤 {{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </div>
</div>

<div class="hero">
    <h1>Bienvenido, {{ auth()->user()->name }}</h1>
    <p>Tu plan de entrenamiento y productos disponibles</p>
</div>

<div class="content">

    <h2>📅 Rutinas de la semana</h2>
    <div class="rutinas-semana">
        @php
            $dias = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'];
        @endphp
        @foreach($dias as $dia)
        <div class="dia-card">
            <div class="dia-nombre">{{ ucfirst($dia) }}</div>
            @php $rutinasDia = $rutinas->where('dia', $dia); @endphp
            @forelse($rutinasDia as $r)
                <div class="rutina-item">
                    <strong>{{ $r->nombre }}</strong>
                    <span>{{ $r->duracion_minutos }} min · {{ ucfirst($r->nivel) }}</span>
                    @if($r->grupo_muscular)
                        <span style="display:block;color:#1a3aff;font-size:0.72rem;">{{ $r->grupo_muscular }}</span>
                    @endif
                </div>
            @empty
                <p class="vacio">Descanso</p>
            @endforelse
        </div>
        @endforeach
    </div>

    <h2>🏋️ Productos disponibles</h2>
    <div class="productos-grid">
        @forelse($productos as $p)
        <div class="producto-card">
            @if($p->imagen)
                <img src="{{ asset('img/productos/' . $p->imagen) }}" alt="{{ $p->nombre }}">
            @else
                <div class="sin-img">🏋️</div>
            @endif
            <div class="producto-info">
                <span class="categoria">{{ ucfirst($p->categoria) }}</span>
                <h3>{{ $p->nombre }}</h3>
                <div class="precio">$ {{ number_format($p->precio_venta, 2) }}</div>
            </div>
        </div>
        @empty
        <p style="color:#aaa;">No hay productos disponibles.</p>
        @endforelse
    </div>

</div>

</body>
</html>
