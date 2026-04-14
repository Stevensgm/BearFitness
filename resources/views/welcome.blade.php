<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bear Fitness</title>
    <link rel="icon" href="{{ asset('img/oso_log.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        :root {
            --azul:#1a3aff; --dorado:#FFD700; --oscuro:#0a0a0a;
            --blanco:#ffffff; --gris:#f4f4f4;
        }
        html { scroll-behavior:smooth; }
        body { font-family:'Roboto',sans-serif; color:var(--oscuro); }

        /* ── NAV ── */
        .nav {
            position:fixed; top:0; left:0; width:100%; height:70px;
            background:rgba(0,0,0,0.88); display:flex; align-items:center;
            justify-content:space-between; padding:0 50px; z-index:1000;
            backdrop-filter:blur(6px);
        }
        .nav-logo { display:flex; align-items:center; gap:12px; }
        .nav-logo img { height:45px; }
        .nav-logo span { font-family:'Bebas Neue',sans-serif; font-size:1.6rem; color:var(--dorado); letter-spacing:2px; }
        .nav-links { display:flex; list-style:none; gap:30px; align-items:center; }
        .nav-links a { color:white; text-decoration:none; font-size:0.9rem; text-transform:uppercase; letter-spacing:1px; transition:color .3s; }
        .nav-links a:hover { color:var(--dorado); }
        .btn-nav-login    { border:1px solid white;   padding:7px 18px; border-radius:4px; }
        .btn-nav-register { background:var(--dorado); color:var(--oscuro) !important; padding:7px 18px; border-radius:4px; font-weight:700; }
        .btn-nav-register:hover { opacity:0.85; }
        .btn-nav-panel { background:var(--azul); color:white !important; padding:7px 18px; border-radius:4px; font-weight:700; }
        .menu-btn { display:none; background:none; border:none; color:white; font-size:1.8rem; cursor:pointer; }

        /* ── HERO ── */
        .header {
            background:url('{{ asset('img/oso.jpg') }}') no-repeat center center/cover;
            background-attachment:fixed;
            height:100vh; display:flex; flex-direction:column;
            justify-content:center; align-items:center; text-align:center; color:white;
            position:relative;
        }
        .header::before { content:''; position:absolute; inset:0; background:rgba(0,0,0,0.45); }
        .texto-header { position:relative; z-index:1; }
        .texto-header h1 { font-family:'Bebas Neue',sans-serif; font-size:5.5rem; letter-spacing:5px;
            text-shadow:3px 3px 15px rgba(0,0,0,0.6); line-height:1; }
        .texto-header h1 span { color:var(--dorado); }
        .texto-header p { font-size:1.2rem; font-weight:300; letter-spacing:3px; margin:15px 0 35px; opacity:.9; }
        .btn-hero { display:inline-block; background:var(--dorado); color:var(--oscuro); padding:15px 45px;
            text-decoration:none; font-weight:700; font-size:1rem; letter-spacing:2px; text-transform:uppercase;
            border-radius:4px; transition:transform .2s,box-shadow .2s; }
        .btn-hero:hover { transform:translateY(-3px); box-shadow:0 10px 30px rgba(255,215,0,.4); }

        /* ── SECCIONES ── */
        .seccion { padding:90px 60px; min-height:80vh; display:flex; flex-direction:column; justify-content:center; align-items:center; }
        .seccion-titulo { font-family:'Bebas Neue',sans-serif; font-size:2.8rem; letter-spacing:3px; text-align:center; margin-bottom:10px; }
        .seccion-sub { text-align:center; color:#666; margin-bottom:50px; font-size:1.05rem; }

        /* Productos */
        .productos { background:var(--gris); }
        .cards { display:grid; grid-template-columns:repeat(3,1fr); gap:25px; max-width:1100px; width:100%; }
        .card { background:white; border-radius:12px; padding:35px 25px; text-align:center;
            box-shadow:0 4px 20px rgba(0,0,0,0.07); transition:transform .3s; }
        .card:hover { transform:translateY(-7px); }
        .card-icon { font-size:3rem; margin-bottom:15px; }
        .card h3 { font-family:'Bebas Neue',sans-serif; font-size:1.5rem; letter-spacing:2px; color:var(--azul); margin-bottom:10px; }
        .card p { color:#666; line-height:1.6; margin-bottom:20px; }

        /* Nosotros */
        .nosotros { background:linear-gradient(135deg,#0a0a0a,#1a3aff); color:white; }
        .nosotros-grid { display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:center; max-width:1100px; width:100%; }
        .nosotros-texto .seccion-titulo { text-align:left; color:white; }
        .nosotros-texto p { line-height:1.8; opacity:.9; margin-bottom:12px; }
        .nosotros-texto ul { list-style:none; margin-top:20px; display:flex; flex-direction:column; gap:8px; }
        .nosotros-img img { width:100%; max-width:350px; display:block; margin:0 auto; }

        /* Testimonios */
        .testimonios { background:white; }
        .test-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:25px; max-width:1100px; width:100%; }
        .test-card { background:var(--gris); border-radius:10px; padding:28px; border-left:4px solid var(--azul); }
        .test-card p { font-style:italic; color:#444; line-height:1.7; margin-bottom:15px; }
        .test-card strong { color:var(--azul); }

        /* Footer */
        .footer { background:#0a0a0a; color:white; padding:50px 60px 20px; }
        .footer-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:40px; max-width:1100px; margin:0 auto 40px; }
        .footer-grid img { height:55px; margin-bottom:10px; }
        .footer-grid p { opacity:.7; font-size:.9rem; margin-bottom:5px; }
        .footer-grid h4 { font-family:'Bebas Neue',sans-serif; font-size:1.2rem; letter-spacing:2px; color:var(--dorado); margin-bottom:12px; }
        .footer-grid a { display:block; color:white; text-decoration:none; opacity:.7; margin-bottom:5px; transition:opacity .3s; }
        .footer-grid a:hover { opacity:1; color:var(--dorado); }
        .footer-bottom { border-top:1px solid rgba(255,255,255,.1); padding-top:18px; text-align:center; opacity:.4; font-size:.82rem; max-width:1100px; margin:0 auto; }

        /* Responsive */
        @media(max-width:900px) {
            .cards,.test-grid { grid-template-columns:1fr 1fr; }
            .nosotros-grid { grid-template-columns:1fr; text-align:center; }
            .nosotros-texto .seccion-titulo { text-align:center; }
            .footer-grid { grid-template-columns:1fr 1fr; }
        }
        @media(max-width:600px) {
            .nav { padding:0 20px; }
            .nav-links { display:none; flex-direction:column; position:absolute; top:70px; left:0;
                width:100%; background:rgba(0,0,0,.95); padding:20px 0; gap:0; }
            .nav-links.activo { display:flex; }
            .nav-links li { text-align:center; padding:12px 0; }
            .menu-btn { display:block; }
            .seccion { padding:70px 25px; }
            .texto-header h1 { font-size:3rem; }
            .cards,.test-grid { grid-template-columns:1fr; }
            .footer-grid { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="nav">
        <div class="nav-logo">
            <img src="{{ asset('img/oso_log.png') }}" alt="Logo">
            <span>BEAR FITNESS</span>
        </div>
        <ul class="nav-links" id="navLinks">
            <li><a href="#productos">Productos</a></li>
            <li><a href="#nosotros">Nosotros</a></li>
            <li><a href="#testimonios">Testimonios</a></li>
            <li><a href="#contacto">Contacto</a></li>

            @auth
                <li>
                    <a href="{{ auth()->user()->esAdmin() ? route('admin.dashboard') : route('cliente.dashboard') }}"
                        class="btn-nav-panel">
                        Mi Panel
                    </a>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="btn-nav-login">Iniciar Sesión</a></li>
                <li><a href="{{ route('register') }}" class="btn-nav-register">Registrarse</a></li>
            @endauth
        </ul>
        <button class="menu-btn" onclick="document.getElementById('navLinks').classList.toggle('activo')">&#9776;</button>
    </nav>

    <!-- HERO -->
    <header class="header" id="inicio">
        <div class="texto-header">
            <h1>BEAR <span>FITNESS</span></h1>
            <p>No Pain, No Gain</p>
            <a href="#productos" class="btn-hero">Ver Productos</a>
        </div>
    </header>

    <!-- PRODUCTOS -->
    <section class="seccion productos" id="productos">
        <h2 class="seccion-titulo">Productos</h2>
        <p class="seccion-sub">Todo lo que necesitas para rendir al máximo</p>
        <div class="cards">
            <div class="card">
                <div class="card-icon">🏋️</div>
                <h3>Suplementos</h3>
                <p>Proteínas, creatina y pre-entrenos para maximizar tu rendimiento.</p>
            </div>
            <div class="card">
                <div class="card-icon">👕</div>
                <h3>Ropa Deportiva</h3>
                <p>Prendas cómodas y resistentes diseñadas para el atleta.</p>
            </div>
            <div class="card">
                <div class="card-icon">🥊</div>
                <h3>Accesorios</h3>
                <p>Guantes, cinturones, correas y todo lo que necesitas en el gym.</p>
            </div>
        </div>
    </section>

    <!-- NOSOTROS -->
    <section class="seccion nosotros" id="nosotros">
        <div class="nosotros-grid">
            <div class="nosotros-texto">
                <h2 class="seccion-titulo">Sobre Nosotros</h2>
                <p>En <strong>Bear Fitness</strong> creemos que cada persona lleva una bestia dentro. Desde 2018 ayudamos a atletas a alcanzar su máximo potencial.</p>
                <p>Nuestro lema: <em>No Pain, No Gain</em>. Los resultados se ganan con esfuerzo y disciplina.</p>
                <ul>
                    <li>✅ +5 años de experiencia</li>
                    <li>✅ +10.000 clientes satisfechos</li>
                    <li>✅ Productos de calidad certificada</li>
                </ul>
            </div>
            <div class="nosotros-img">
                <img src="{{ asset('img/oso_log.png') }}" alt="Bear Fitness">
            </div>
        </div>
    </section>

    <!-- TESTIMONIOS -->
    <section class="seccion testimonios" id="testimonios">
        <h2 class="seccion-titulo">Testimonios</h2>
        <p class="seccion-sub">Lo que dicen nuestros clientes</p>
        <div class="test-grid">
            <div class="test-card">
                <p>"Desde que uso los suplementos de Bear Fitness mis entrenamientos mejoraron muchísimo."</p>
                <strong>Juan Martínez</strong>
            </div>
            <div class="test-card">
                <p>"La ropa es súper cómoda y duradera. La uso todos los días y sigue como nueva."</p>
                <strong>Laura Pérez</strong>
            </div>
            <div class="test-card">
                <p>"El servicio al cliente es excelente. Me ayudaron a elegir el plan perfecto."</p>
                <strong>Carlos Rodríguez</strong>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer" id="contacto">
        <div class="footer-grid">
            <div>
                <img src="{{ asset('img/oso_log.png') }}" alt="Logo">
                <p>No Pain, No Gain.</p>
            </div>
            <div>
                <h4>Contacto</h4>
                <p>📧 info@bearfitness.com</p>
                <p>📞 +57 300 123 4567</p>
                <p>📍 Cali, Valle del Cauca</p>
            </div>
            <div>
                <h4>Síguenos</h4>
                <a href="#">Instagram</a>
                <a href="#">Facebook</a>
                <a href="#">YouTube</a>
            </div>
        </div>
        <p class="footer-bottom">&copy; {{ date('Y') }} Bear Fitness. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
