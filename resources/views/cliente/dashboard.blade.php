<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bear Fitness — Mi Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: #f0f2f5;
        }

        .topbar {
            background: #0a0a0a;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.5rem;
            color: #FFD700;
            letter-spacing: 2px;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.9rem;
        }

        .topbar-user form button {
            background: none;
            border: 1px solid #555;
            color: #aaa;
            padding: 6px 14px;
            border-radius: 4px;
            cursor: pointer;
        }

        .hero {
            background: linear-gradient(135deg, #1a3aff, #0a0a0a);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .hero h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.5rem;
            letter-spacing: 3px;
        }

        .hero p {
            font-size: 1rem;
            opacity: 0.8;
            margin-top: 6px;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: 2px;
            color: #1a3aff;
            margin: 30px 0 15px;
        }

        /* Rutinas */
        .rutinas-semana {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            margin-bottom: 40px;
        }

        .dia-card {
            background: white;
            border-radius: 10px;
            padding: 12px 10px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        }

        .dia-nombre {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1rem;
            color: #1a3aff;
            letter-spacing: 1px;
            border-bottom: 2px solid #1a3aff;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }

        .rutina-item {
            background: #f4f6ff;
            border-radius: 6px;
            padding: 8px;
            margin-bottom: 8px;
            text-align: left;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .rutina-item:hover {
            transform: translateY(-2px);
            background: #e8ecff;
        }

        .rutina-item img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 6px;
        }

        .rutina-item .sin-img {
            width: 100%;
            height: 60px;
            background: #e0e4ff;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 6px;
        }

        .rutina-item strong {
            display: block;
            color: #222;
            font-size: 0.8rem;
            margin-bottom: 2px;
        }

        .rutina-item span {
            color: #888;
            font-size: 0.72rem;
        }

        .rutina-item .muscular {
            display: block;
            color: #1a3aff;
            font-size: 0.7rem;
            margin-top: 2px;
        }

        .vacio {
            color: #ccc;
            font-size: 0.8rem;
            margin-top: 10px;
        }

        /* Productos */
        .productos-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .producto-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            transition: transform 0.2s;
        }

        .producto-card:hover {
            transform: translateY(-4px);
        }

        .producto-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .sin-img-prod {
            width: 100%;
            height: 180px;
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        .producto-info {
            padding: 15px;
        }

        .producto-info .categoria {
            font-size: 0.75rem;
            color: #888;
            background: #f0f2f5;
            padding: 2px 8px;
            border-radius: 10px;
            display: inline-block;
            margin-bottom: 8px;
        }

        .producto-info h3 {
            font-size: 1rem;
            margin-bottom: 6px;
            color: #222;
        }

        .producto-info .descripcion {
            font-size: 0.82rem;
            color: #666;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .producto-info .precio {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a3aff;
            margin-bottom: 12px;
        }

        .btn-comprar {
            width: 100%;
            padding: 10px;
            background: #1a3aff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-comprar:hover {
            background: #0a1a8a;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.activo {
            display: flex;
        }

        .modal {
            background: white;
            border-radius: 12px;
            padding: 30px;
            max-width: 420px;
            width: 90%;
        }

        .modal h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: #222;
        }

        .modal .modal-precio {
            font-size: 1rem;
            color: #1a3aff;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .modal label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
        }

        .modal input[type=number] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            margin-bottom: 6px;
        }

        .modal .total {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a3aff;
            margin: 10px 0 20px;
        }

        .modal-btns {
            display: flex;
            gap: 10px;
        }

        .modal-btns button {
            flex: 1;
            padding: 11px;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-confirmar {
            background: #1a3aff;
            color: white;
        }

        .btn-confirmar:hover {
            background: #0a1a8a;
        }

        .btn-cancelar {
            background: #eee;
            color: #555;
        }

        .btn-cancelar:hover {
            background: #ddd;
        }

        @media(max-width:900px) {
            .rutinas-semana {
                grid-template-columns: repeat(4, 1fr);
            }

            .productos-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width:500px) {
            .rutinas-semana {
                grid-template-columns: 1fr 1fr;
            }

            .productos-grid {
                grid-template-columns: 1fr;
            }
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
            @php $dias = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo']; @endphp
            @foreach($dias as $dia)
            <div class="dia-card">
                <div class="dia-nombre">{{ ucfirst($dia) }}</div>
                @php $rutinasDia = $rutinas->where('dia', $dia); @endphp
                @forelse($rutinasDia as $r)
                <div class="rutina-item">
                    @if($r->imagen)
                    <img src="{{ asset('img/rutinas/' . $r->imagen) }}" alt="{{ $r->nombre }}">
                    @else
                    <div class="sin-img">💪</div>
                    @endif
                    <strong>{{ $r->nombre }}</strong>
                    <span>{{ $r->duracion_minutos }} min · {{ ucfirst($r->nivel) }}</span>
                    @if($r->grupo_muscular)
                    <span class="muscular">{{ $r->grupo_muscular }}</span>
                    @endif
                    @if($r->descripcion)
                    <p style="font-size:0.7rem;color:#999;margin-top:4px;">{{ $r->descripcion }}</p>
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
                <div class="sin-img-prod">🏋️</div>
                @endif
                <div class="producto-info">
                    <span class="categoria">{{ ucfirst($p->categoria) }}</span>
                    <h3>{{ $p->nombre }}</h3>
                    @if($p->descripcion)
                    <p class="descripcion">{{ $p->descripcion }}</p>
                    @endif
                    <div class="precio">$ {{ number_format($p->precio_venta, 2) }}</div>
                    <button class="btn-comprar"
                        onclick="abrirModal({{ $p->id }}, '{{ addslashes($p->nombre) }}', {{ $p->precio_venta }}, {{ $p->stock }})">
                        🛒 Comprar
                    </button>
                </div>
            </div>
            @empty
            <p style="color:#aaa;">No hay productos disponibles.</p>
            @endforelse
        </div>

    </div>

    <!-- MODAL COMPRA -->
    <div class="modal-overlay" id="modalCompra">
        <div class="modal">
            <h3 id="modalNombre"></h3>
            <p class="modal-precio" id="modalPrecioUnit"></p>
            <label>Cantidad</label>
            <input type="number" id="modalCantidad" min="1" value="1" oninput="calcularTotal()">
            <p class="total" id="modalTotal"></p>
            <div class="modal-btns">
                <button class="btn-confirmar" onclick="confirmarCompra()">✅ Confirmar y descargar recibo</button>
                <button class="btn-cancelar" onclick="cerrarModal()">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- PDF RECIBO via hidden form -->
    <form id="formRecibo" action="{{ route('cliente.recibo') }}" method="POST" target="_blank">
        @csrf
        <input type="hidden" name="producto_id" id="recibo_id">
        <input type="hidden" name="cantidad" id="recibo_cantidad">
    </form>

    <script>
        let precioUnit = 0;

        function abrirModal(id, nombre, precio, stock) {
            precioUnit = precio;
            document.getElementById('modalNombre').textContent = nombre;
            document.getElementById('modalPrecioUnit').textContent = 'Precio unitario: $ ' + precio.toLocaleString('es-CO');
            document.getElementById('modalCantidad').max = stock;
            document.getElementById('modalCantidad').value = 1;
            document.getElementById('recibo_id').value = id;
            calcularTotal();
            document.getElementById('modalCompra').classList.add('activo');
        }

        function cerrarModal() {
            document.getElementById('modalCompra').classList.remove('activo');
        }

        function calcularTotal() {
            const cant = parseInt(document.getElementById('modalCantidad').value) || 1;
            const total = cant * precioUnit;
            document.getElementById('modalTotal').textContent = 'Total: $ ' + total.toLocaleString('es-CO');
        }

        function confirmarCompra() {
            const cant = document.getElementById('modalCantidad').value;
            document.getElementById('recibo_cantidad').value = cant;
            document.getElementById('formRecibo').submit();
            cerrarModal();
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('modalCompra').addEventListener('click', function(e) {
            if (e.target === this) cerrarModal();
        });
    </script>

</body>

</html>