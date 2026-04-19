<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso — IGETIS Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh; display: flex;
            -webkit-font-smoothing: antialiased;
        }
        .login-left {
            flex: 1; display: none;
            background: linear-gradient(135deg, #0f172a 0%, #1E4D8C 60%, #2E6DB4 100%);
            position: relative; overflow: hidden;
            align-items: center; justify-content: center; padding: 3rem;
        }
        @media (min-width: 900px) { .login-left { display: flex; } }
        .login-left-bg {
            position: absolute; inset: 0;
            background-image: url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1200&q=80');
            background-size: cover; background-position: center; opacity: 0.08;
        }
        .login-left-pattern {
            position: absolute; inset: 0; opacity: 0.05;
            background-image: radial-gradient(circle at 30% 40%, white 1px, transparent 1px);
            background-size: 36px 36px;
        }
        .login-left-content { position: relative; z-index: 1; max-width: 380px; }
        .login-left-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
            border-radius: 9999px; padding: 0.375rem 0.875rem;
            font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,.8);
            margin-bottom: 1.5rem;
        }
        .login-left-title {
            font-size: clamp(1.75rem, 4vw, 2.5rem); font-weight: 900; color: white;
            line-height: 1.15; letter-spacing: -0.03em; margin-bottom: 1rem;
        }
        .login-left-desc { color: rgba(255,255,255,.6); font-size: 0.9rem; line-height: 1.7; margin-bottom: 2rem; }
        .login-features { display: flex; flex-direction: column; gap: 0.75rem; }
        .login-feature {
            display: flex; align-items: center; gap: 0.75rem;
            font-size: 0.85rem; color: rgba(255,255,255,.75);
        }
        .login-feature-dot {
            width: 8px; height: 8px; border-radius: 9999px;
            background: #F97316; flex-shrink: 0;
        }
        .login-right {
            width: 100%; max-width: 480px;
            background: #f8fafc; display: flex; align-items: center; justify-content: center;
            padding: 2rem;
        }
        @media (min-width: 900px) { .login-right { min-width: 420px; max-width: 420px; } }
        .login-box { width: 100%; max-width: 380px; }
        .login-logo {
            display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2.5rem;
        }
        .login-logo-icon {
            width: 42px; height: 42px; border-radius: 0.75rem;
            background: linear-gradient(135deg, #1E4D8C, #2E6DB4);
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 0.9rem; color: white;
        }
        .login-logo-text h1 { font-size: 1.1rem; font-weight: 800; color: #0f172a; }
        .login-logo-text p  { font-size: 0.72rem; color: #94a3b8; }
        .login-heading { font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-bottom: 0.375rem; }
        .login-subheading { font-size: 0.875rem; color: #64748b; margin-bottom: 2rem; }
        .login-alert {
            display: flex; align-items: center; gap: 0.625rem;
            background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.625rem;
            padding: 0.75rem 1rem; margin-bottom: 1.5rem;
            font-size: 0.8rem; color: #dc2626;
        }
        .field { display: flex; flex-direction: column; gap: 0.375rem; margin-bottom: 1.125rem; }
        .field label { font-size: 0.8rem; font-weight: 600; color: #374151; }
        .field input {
            padding: 0.75rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem;
            font-size: 0.875rem; font-family: inherit; color: #1e293b; outline: none;
            transition: border-color 0.15s, box-shadow 0.15s; background: white;
        }
        .field input:focus { border-color: #1E4D8C; box-shadow: 0 0 0 3px rgba(30,77,140,.1); }
        .login-submit {
            width: 100%; padding: 0.8rem; background: #1E4D8C; color: white;
            font-size: 0.9rem; font-weight: 700; border: none; border-radius: 0.625rem;
            cursor: pointer; font-family: inherit; transition: all 0.2s; margin-top: 0.5rem;
        }
        .login-submit:hover { background: #153A6B; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(30,77,140,.35); }
    </style>
</head>
<body>

    <div class="login-left">
        <div class="login-left-bg"></div>
        <div class="login-left-pattern"></div>
        <div class="login-left-content">
            <div class="login-left-badge">
                <span style="width:6px;height:6px;border-radius:9999px;background:#22c55e;flex-shrink:0;"></span>
                Panel de Administración
            </div>
            <h2 class="login-left-title">Gestiona IGETIS desde un solo lugar</h2>
            <p class="login-left-desc">Administra cursos, artículos, mensajes y configuración del sitio de forma simple y eficiente.</p>
            <div class="login-features">
                <div class="login-feature"><div class="login-feature-dot"></div>Gestión completa de cursos y categorías</div>
                <div class="login-feature"><div class="login-feature-dot"></div>Blog y publicación de artículos</div>
                <div class="login-feature"><div class="login-feature-dot"></div>Mensajes de contacto en tiempo real</div>
                <div class="login-feature"><div class="login-feature-dot"></div>Configuración del sitio web</div>
            </div>
        </div>
    </div>

    <div class="login-right">
        <div class="login-box">
            <div style="margin-bottom:2rem;">
                <a href="{{ route('home') }}"
                   style="display:inline-flex; align-items:center; gap:0.4rem; font-size:0.8rem; font-weight:600; color:#64748b; text-decoration:none; transition:color 0.15s;"
                   onmouseover="this.style.color='#1E4D8C'"
                   onmouseout="this.style.color='#64748b'">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                    Volver al sitio
                </a>
            </div>

            <div class="login-logo">
                <div class="login-logo-icon">IG</div>
                <div class="login-logo-text">
                    <h1>IGETIS</h1>
                    <p>Instituto de Gestión y Tecnología</p>
                </div>
            </div>

            <h2 class="login-heading">Bienvenido de vuelta</h2>
            <p class="login-subheading">Ingresa tus credenciales para continuar.</p>

            @if ($errors->any())
                <div class="login-alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="field">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@igetis.com" required autofocus>
                </div>
                <div class="field">
                    <label>Contraseña</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="login-submit">Ingresar al panel</button>
            </form>
        </div>
    </div>

</body>
</html>
