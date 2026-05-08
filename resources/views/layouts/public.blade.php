<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'IGETIS') — Capacitación Profesional en Salud</title>
    <meta name="description" content="@yield('descripcion', 'IGETIS — Capacitación y desarrollo profesional especializado en salud y áreas afines. Cochabamba, Bolivia.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logos/Favicon.png') }}">
    @vite(['resources/css/app.css'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: #f8fafc;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }
        h1, h2, h3, h4, .section-title, .hero-title, .stat-num, .float-val {
            font-family: 'Figtree', system-ui, -apple-system, sans-serif;
        }

        /* ── Variables ──────────────────────────────────────── */
        :root {
            --azul: #1E4D8C;
            --azul-light: #2E6DB4;
            --azul-dark: #153A6B;
            --naranja: #F97316;
            --naranja-dark: #EA6C0A;
        }

        /* ── Navbar ─────────────────────────────────────────── */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            height: 4.5rem;
            transition: background 0.3s, box-shadow 0.3s, backdrop-filter 0.3s;
        }
        .navbar.transparent { background: transparent; }
        .navbar.scrolled {
            background: rgba(21, 58, 107, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 2px 20px rgba(0,0,0,.25);
        }
        .navbar.solid {
            background: var(--azul-dark);
            box-shadow: 0 2px 12px rgba(0,0,0,.2);
        }
        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-brand {
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            text-decoration: none;
            flex-shrink: 0;
        }
        .navbar-brand img {
            height: 38px;
            width: auto;
            display: block;
        }
        .navbar-brand-text {
            font-family: 'Figtree', system-ui, sans-serif;
            font-size: 1.5rem;
            font-weight: 900;
            color: white;
            letter-spacing: -0.04em;
            line-height: 1;
        }
        .navbar-brand-text span { color: var(--naranja); }
        .navbar-menu { display: flex; align-items: center; gap: 0.25rem; }
        .navbar-link {
            color: rgba(255,255,255,.85);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.15s;
            white-space: nowrap;
        }
        .navbar-link:hover, .navbar-link.active {
            color: white;
            background: rgba(255,255,255,.12);
        }
        .navbar-cta {
            background: var(--naranja) !important;
            color: white !important;
            font-weight: 700;
            padding: 0.5rem 1.25rem !important;
        }
        .navbar-cta:hover { background: var(--naranja-dark) !important; }
        .navbar-toggle {
            display: none; flex-direction: column; gap: 5px;
            cursor: pointer; padding: 0.5rem; background: none; border: none;
        }
        .navbar-toggle span {
            display: block; width: 24px; height: 2px;
            background: white; border-radius: 2px; transition: 0.25s;
        }

        /* ── Utilidades ─────────────────────────────────────── */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        .section { padding: 5rem 0; }
        .section-sm { padding: 3rem 0; }

        /* Headings de sección */
        .section-label {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--naranja);
            margin-bottom: 0.75rem;
        }
        .section-title {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #111827;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .section-subtitle {
            font-size: 1.05rem;
            color: #6b7280;
            max-width: 560px;
            line-height: 1.7;
        }

        /* Botones */
        .btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 1.75rem; border-radius: 0.625rem;
            font-weight: 700; font-size: 0.9rem; text-decoration: none;
            cursor: pointer; border: none; transition: all 0.2s;
            white-space: nowrap;
        }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary { background: var(--azul); color: white; box-shadow: 0 4px 14px rgba(30,77,140,.3); }
        .btn-primary:hover { background: var(--azul-dark); box-shadow: 0 6px 20px rgba(30,77,140,.4); }
        .btn-naranja { background: var(--naranja); color: white; box-shadow: 0 4px 14px rgba(249,115,22,.35); }
        .btn-naranja:hover { background: var(--naranja-dark); box-shadow: 0 6px 20px rgba(249,115,22,.45); }
        .btn-outline { background: transparent; color: var(--azul); border: 2px solid var(--azul); box-shadow: none; }
        .btn-outline:hover { background: var(--azul); color: white; box-shadow: 0 4px 14px rgba(30,77,140,.3); }
        .btn-white { background: white; color: var(--azul); box-shadow: 0 4px 16px rgba(0,0,0,.12); }
        .btn-white:hover { background: #f0f7ff; }
        .btn-ghost-white { background: rgba(255,255,255,.15); color: white; border: 2px solid rgba(255,255,255,.4); box-shadow: none; }
        .btn-ghost-white:hover { background: rgba(255,255,255,.25); }
        .btn-lg { padding: 1rem 2.25rem; font-size: 1rem; border-radius: 0.75rem; }

        /* Cards */
        .card {
            background: white; border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.06);
            overflow: hidden; display: flex; flex-direction: column;
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,.12);
        }

        /* Grids */
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(100%, 280px), 1fr));
            gap: 1.75rem;
            align-items: stretch;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(100%, 360px), 1fr));
            gap: 1.75rem;
            align-items: stretch;
        }

        /* Badges */
        .badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.03em; }
        .badge-blue   { background: #dbeafe; color: #1d4ed8; }
        .badge-naranja{ background: #ffedd5; color: #c2410c; }
        .badge-green  { background: #dcfce7; color: #15803d; }

        /* Alertas */
        .alert { padding: 1rem 1.25rem; border-radius: 0.625rem; font-size: 0.875rem; margin-bottom: 1.5rem; border: 1px solid; }
        .alert-success { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
        .alert-error   { background: #fef2f2; color: #dc2626; border-color: #fecaca; }

        /* Sidebar layout */
        .layout-sidebar { display: flex; gap: 2.5rem; align-items: flex-start; }
        .layout-sidebar-aside { width: 260px; flex-shrink: 0; }
        .layout-sidebar-main { flex: 1; min-width: 0; }
        .sidebar-sticky { position: sticky; top: 5.5rem; }

        /* Course card */
        .course-card { border-radius: 1rem; overflow: hidden; }
        .course-img-wrap { position: relative; height: 200px; overflow: hidden; flex-shrink: 0; }
        .course-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
        .course-card:hover .course-img-wrap img { transform: scale(1.06); }
        .course-img-placeholder {
            height: 200px; display: flex; align-items: center;
            justify-content: center; font-size: 3.5rem; flex-shrink: 0;
        }
        .course-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .course-body h3 { overflow-wrap: break-word; word-break: break-word; }

        /* Blog card */
        .blog-card-img { height: 200px; overflow: hidden; flex-shrink: 0; }
        .blog-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
        .card:hover .blog-card-img img { transform: scale(1.06); }

        /* Animaciones */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .animate-fade-up  { animation: fadeUp 0.7s ease both; }
        .animate-fade-in  { animation: fadeIn 0.7s ease both; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        /* Footer */
        .footer { background: #0f172a; color: #94a3b8; margin-top: 0; }
        .footer-top { padding: 4rem 1.5rem; }
        .footer-grid {
            max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 3rem;
        }
        .footer-brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            margin-bottom: 0.875rem;
        }
        .footer-brand-logo img { height: 36px; width: auto; }
        .footer-brand-logo-text {
            font-family: 'Figtree', system-ui, sans-serif;
            font-size: 1.5rem;
            font-weight: 900;
            color: white;
            letter-spacing: -0.04em;
            line-height: 1;
        }
        .footer-brand-logo-text span { color: var(--naranja); }
        .footer-desc { font-size: 0.875rem; line-height: 1.7; max-width: 280px; }
        .footer-col-title { color: white; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1.25rem; }
        .footer-links-list { list-style: none; display: flex; flex-direction: column; gap: 0.625rem; }
        .footer-links-list a { color: #94a3b8; text-decoration: none; font-size: 0.875rem; transition: color 0.15s; }
        .footer-links-list a:hover { color: white; }
        .footer-bottom {
            border-top: 1px solid #1e293b;
            padding: 1.5rem;
            text-align: center;
            font-size: 0.8rem;
            color: #475569;
        }

        /* ── Responsive ─────────────────────────────────────── */
        @media (max-width: 768px) {
            .navbar-toggle { display: flex; }
            .navbar-menu {
                display: none; position: fixed;
                top: 4.5rem; left: 0; right: 0;
                background: var(--azul-dark);
                flex-direction: column; align-items: stretch;
                padding: 1rem 1.25rem 1.5rem; gap: 0.25rem;
                box-shadow: 0 8px 24px rgba(0,0,0,.3);
                max-height: calc(100vh - 4.5rem); overflow-y: auto;
            }
            .navbar-menu.open { display: flex; }
            .navbar-link { padding: 0.875rem 1rem; font-size: 1rem; }
            .section { padding: 3rem 0; }
            .layout-sidebar { flex-direction: column; gap: 1.5rem; }
            .layout-sidebar-aside { width: 100%; order: -1; }
            .sidebar-sticky { position: static; }
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
            .footer-top { padding: 2.5rem 1.25rem; }
            .grid-3 { grid-template-columns: 1fr; gap: 1.25rem; }
            .grid-2 { grid-template-columns: 1fr; gap: 1.25rem; }
        }
        @media (min-width: 480px) and (max-width: 768px) {
            .grid-3 { grid-template-columns: repeat(2, 1fr); }
            .grid-2 { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 480px) {
            .btn-lg { padding: 0.875rem 1.75rem; font-size: 0.9rem; }
            .container { padding: 0 1rem; }
        }
    </style>
</head>
<body>

    <nav class="navbar {{ request()->routeIs('home') ? 'transparent' : 'solid' }}" id="navbar">
        <div class="navbar-inner">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('img/logos/Version en blanconegativo para el navbar oscuro .png') }}" alt="">
                <span class="navbar-brand-text">IGE<span>TIS</span></span>
            </a>

            <button class="navbar-toggle" id="nav-toggle" aria-label="Menú" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>

            <div class="navbar-menu" id="nav-menu">
                <a href="{{ route('home') }}"           class="navbar-link {{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a>
                <a href="{{ route('cursos.index') }}"  class="navbar-link {{ request()->routeIs('cursos.*') ? 'active' : '' }}">Cursos</a>
                <a href="{{ route('blog.index') }}"    class="navbar-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>
                <a href="{{ route('nosotros.index') }}" class="navbar-link {{ request()->routeIs('nosotros.*') ? 'active' : '' }}">Nosotros</a>
                <a href="{{ route('contacto.index') }}" class="navbar-link navbar-cta {{ request()->routeIs('contacto.*') ? 'active' : '' }}">Contacto</a>
            </div>
        </div>
    </nav>

    <main style="padding-top: {{ request()->routeIs('home') ? '0' : '4.5rem' }};">
        @if (session('success'))
            <div class="container" style="padding-top:1.5rem;">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif
        @if (session('error'))
            <div class="container" style="padding-top:1.5rem;">
                <div class="alert alert-error">{{ session('error') }}</div>
            </div>
        @endif

        @yield('contenido')
    </main>

    {{-- Botón flotante WhatsApp --}}
    @php
        $waNumero = preg_replace('/\D/', '', \App\Models\Configuracion::get('whatsapp_numero', ''));
        $waUrlBase = $waNumero ? 'https://wa.me/' . $waNumero : '#';
        $waUrl   = $__env->yieldContent('whatsapp_url', $waUrlBase);
        $waLabel = $__env->yieldContent('whatsapp_label', '');
    @endphp
    @if ($waNumero)
        <div style="position:fixed; bottom:1.75rem; right:1.75rem; z-index:200; display:flex; align-items:center; gap:0.75rem;">
            @if ($waLabel)
                <div style="background:white; color:#1f2937; font-size:0.82rem; font-weight:600;
                            padding:0.625rem 1rem; border-radius:9999px;
                            box-shadow:0 4px 20px rgba(0,0,0,.15); white-space:nowrap;
                            max-width:220px; line-height:1.3; text-align:center;
                            animation: fadeUp 0.5s ease both;">
                    {{ $waLabel }}
                </div>
            @endif
            <a href="{{ $waUrl }}" target="_blank" rel="noopener" title="WhatsApp"
               style="display:flex; align-items:center; justify-content:center;
                      width:58px; height:58px; border-radius:9999px; flex-shrink:0;
                      background:#25D366; box-shadow:0 4px 20px rgba(37,211,102,.45);
                      transition:transform 0.2s, box-shadow 0.2s;"
               onmouseover="this.style.transform='scale(1.12)';this.style.boxShadow='0 8px 28px rgba(37,211,102,.55)'"
               onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 4px 20px rgba(37,211,102,.45)'">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="28" height="28">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
            </a>
        </div>
    @endif

    <footer class="footer">
        <div class="footer-top">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand-logo">
                        <img src="{{ asset('img/logos/Version en blanconegativo para el navbar oscuro .png') }}" alt="">
                        <span class="footer-brand-logo-text">IGE<span>TIS</span></span>
                    </div>
                    <p class="footer-desc">Capacitación y desarrollo profesional especializado en salud y áreas afines. Cochabamba, Bolivia.</p>
                </div>
                <div>
                    <div class="footer-col-title">Navegación</div>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li><a href="{{ route('cursos.index') }}">Cursos</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><a href="{{ route('nosotros.index') }}">Nosotros</a></li>
                        <li><a href="{{ route('contacto.index') }}">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-title">Contacto</div>
                    <ul class="footer-links-list">
                        @php
                            $footerEmail    = \App\Models\Configuracion::get('email','');
                            $footerTelefono = \App\Models\Configuracion::get('telefono','');
                            $footerDir      = \App\Models\Configuracion::get('direccion','');
                            $footerFb       = \App\Models\Configuracion::get('facebook','');
                        @endphp
                        @if ($footerDir)
                            <li style="font-size:0.82rem; line-height:1.6; color:#64748b;">{{ $footerDir }}</li>
                        @endif
                        @if ($footerTelefono)
                            <li><a href="tel:{{ $footerTelefono }}">{{ $footerTelefono }}</a></li>
                        @endif
                        @if ($footerEmail)
                            <li><a href="mailto:{{ $footerEmail }}" style="word-break:break-all;">{{ $footerEmail }}</a></li>
                        @endif
                        @if ($waNumero)
                            <li><a href="https://wa.me/{{ $waNumero }}" target="_blank">WhatsApp</a></li>
                        @endif
                        @if ($footerFb)
                            <li><a href="{{ $footerFb }}" target="_blank" rel="noopener">Facebook</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} IGETIS. Todos los derechos reservados.
            <a href="{{ route('admin.login') }}"
               style="color:#1e293b; text-decoration:none; margin-left:1.5rem; font-size:0.72rem; transition:color 0.2s;"
               onmouseover="this.style.color='#475569'"
               onmouseout="this.style.color='#1e293b'">
                Acceso privado
            </a>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById ? document.getElementById('navbar') : null;
        const isHome = {{ request()->routeIs('home') ? 'true' : 'false' }};
        if (navbar) {
            function updateNav() {
                if (isHome) {
                    navbar.classList.toggle('scrolled', window.scrollY > 60);
                    navbar.classList.toggle('transparent', window.scrollY <= 60);
                }
            }
            window.addEventListener('scroll', updateNav, { passive: true });
            updateNav();
        }

        // Mobile menu
        const toggle = document.getElementById('nav-toggle');
        const menu   = document.getElementById('nav-menu');
        if (toggle && menu) {
            toggle.addEventListener('click', () => {
                const open = menu.classList.toggle('open');
                toggle.setAttribute('aria-expanded', open);
            });
            menu.querySelectorAll('.navbar-link').forEach(l => l.addEventListener('click', () => menu.classList.remove('open')));
        }
    </script>

    @stack('scripts')
</body>
</html>
