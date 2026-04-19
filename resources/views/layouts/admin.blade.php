<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Panel Admin') — IGETIS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Layout ──────────────────────────────────────────── */
        .admin-wrapper { display: flex; min-height: 100vh; }

        /* ── Sidebar ─────────────────────────────────────────── */
        .sidebar {
            width: 260px; min-width: 260px;
            background: #0f172a;
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; height: 100vh;
            overflow-y: auto; z-index: 50;
            border-right: 1px solid rgba(255,255,255,.05);
        }
        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.06);
            display: flex; align-items: center; gap: 0.75rem;
        }
        .sidebar-logo-icon {
            width: 38px; height: 38px; border-radius: 0.625rem;
            background: linear-gradient(135deg, #1E4D8C, #2E6DB4);
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 0.875rem; color: white; flex-shrink: 0;
        }
        .sidebar-logo-text h1 { color: white; font-size: 1rem; font-weight: 800; letter-spacing: -0.3px; }
        .sidebar-logo-text p  { color: #64748b; font-size: 0.72rem; margin-top: 0.1rem; }

        .sidebar-section-label {
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: #475569;
            padding: 1.25rem 1.25rem 0.5rem;
        }
        .sidebar-nav { flex: 1; padding: 0.75rem; }
        .nav-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.625rem 0.875rem; border-radius: 0.625rem;
            font-size: 0.875rem; color: #94a3b8; text-decoration: none;
            font-weight: 500; transition: all 0.15s; margin-bottom: 0.125rem;
        }
        .nav-item:hover { background: rgba(255,255,255,.06); color: #e2e8f0; }
        .nav-item.active {
            background: rgba(30,77,140,.35);
            color: white; font-weight: 600;
            border-left: 3px solid #2E6DB4;
            padding-left: calc(0.875rem - 3px);
        }
        .nav-item svg { width: 17px; height: 17px; flex-shrink: 0; opacity: 0.8; }
        .nav-item.active svg { opacity: 1; }
        .nav-badge {
            margin-left: auto; background: #ef4444; color: white;
            font-size: 0.65rem; font-weight: 700;
            padding: 0.1rem 0.45rem; border-radius: 9999px;
        }

        .sidebar-footer { padding: 1rem; border-top: 1px solid rgba(255,255,255,.06); }
        .sidebar-user {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.625rem 0.875rem; border-radius: 0.625rem;
            margin-bottom: 0.5rem;
        }
        .sidebar-user-avatar {
            width: 32px; height: 32px; border-radius: 9999px;
            background: linear-gradient(135deg, #1E4D8C, #F97316);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem; font-weight: 700; color: white; flex-shrink: 0;
        }
        .sidebar-user-name  { font-size: 0.8rem; font-weight: 600; color: #e2e8f0; }
        .sidebar-user-role  { font-size: 0.68rem; color: #64748b; }
        .logout-btn {
            display: flex; align-items: center; gap: 0.75rem;
            width: 100%; padding: 0.5rem 0.875rem; border-radius: 0.5rem;
            font-size: 0.825rem; color: #64748b; background: transparent;
            border: none; cursor: pointer; font-family: inherit; font-weight: 500;
            transition: all 0.15s;
        }
        .logout-btn:hover { background: rgba(239,68,68,.12); color: #f87171; }
        .logout-btn svg { width: 15px; height: 15px; flex-shrink: 0; }

        /* ── Main ────────────────────────────────────────────── */
        .main-content {
            margin-left: 260px; flex: 1;
            display: flex; flex-direction: column; min-width: 0;
        }
        .topbar {
            background: white; height: 64px;
            border-bottom: 1px solid #e2e8f0;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2rem; position: sticky; top: 0; z-index: 40;
        }
        .topbar-title { font-size: 1rem; font-weight: 700; color: #0f172a; }
        .topbar-subtitle { font-size: 0.78rem; color: #94a3b8; margin-top: 0.1rem; }
        .topbar-right { display: flex; align-items: center; gap: 0.875rem; }
        .topbar-badge {
            display: flex; align-items: center; gap: 0.4rem;
            font-size: 0.78rem; color: #64748b; font-weight: 500;
        }
        .topbar-btn {
            display: flex; align-items: center; gap: 0.4rem;
            padding: 0.4rem 0.875rem; border-radius: 0.5rem;
            font-size: 0.8rem; font-weight: 600; text-decoration: none;
            transition: all 0.15s; border: none; cursor: pointer;
        }
        .topbar-btn-primary { background: #1E4D8C; color: white; }
        .topbar-btn-primary:hover { background: #153A6B; }
        .page-body { padding: 2rem; flex: 1; }

        /* ── Alertas ─────────────────────────────────────────── */
        .alert {
            display: flex; align-items: flex-start; gap: 0.875rem;
            padding: 1rem 1.25rem; border-radius: 0.75rem;
            font-size: 0.875rem; margin-bottom: 1.5rem; border: 1px solid;
        }
        .alert-success { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
        .alert-error   { background: #fef2f2; color: #dc2626; border-color: #fecaca; }

        /* ── Cards ───────────────────────────────────────────── */
        .card {
            background: white; border-radius: 0.875rem;
            box-shadow: 0 1px 2px rgba(0,0,0,.04), 0 2px 8px rgba(0,0,0,.06);
            border: 1px solid #f1f5f9;
        }
        .card-header {
            padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between; gap: 1rem;
        }
        .card-title { font-size: 0.925rem; font-weight: 700; color: #0f172a; }
        .card-body  { padding: 1.5rem; }

        /* ── Form ────────────────────────────────────────────── */
        .form-section { margin-bottom: 2rem; }
        .form-section-title {
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: #94a3b8;
            padding-bottom: 0.875rem; border-bottom: 1px solid #f1f5f9;
            margin-bottom: 1.25rem;
        }
        .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
        .form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.25rem; }
        .form-group { display: flex; flex-direction: column; gap: 0.375rem; }
        .form-label {
            font-size: 0.8rem; font-weight: 600; color: #374151;
            display: flex; align-items: center; gap: 0.25rem;
        }
        .form-label .required { color: #ef4444; }
        .form-hint { font-size: 0.72rem; color: #94a3b8; }
        .form-input, .form-select, .form-textarea {
            padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0;
            border-radius: 0.5rem; font-size: 0.875rem; font-family: inherit;
            color: #1e293b; background: white; outline: none;
            transition: border-color 0.15s, box-shadow 0.15s; width: 100%;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: #1E4D8C;
            box-shadow: 0 0 0 3px rgba(30,77,140,.1);
        }
        .form-input.error, .form-select.error, .form-textarea.error {
            border-color: #f87171;
            box-shadow: 0 0 0 3px rgba(239,68,68,.1);
        }
        .form-textarea { resize: vertical; }
        .form-error { font-size: 0.75rem; color: #ef4444; display: flex; align-items: center; gap: 0.25rem; }

        .file-upload-area {
            border: 1.5px dashed #cbd5e1; border-radius: 0.625rem;
            padding: 1.5rem; text-align: center; cursor: pointer;
            transition: all 0.2s; background: #f8fafc;
        }
        .file-upload-area:hover { border-color: #1E4D8C; background: #f0f7ff; }

        .toggle-switch {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.875rem 1rem; background: #f8fafc;
            border: 1.5px solid #e2e8f0; border-radius: 0.625rem;
            cursor: pointer; transition: all 0.15s;
        }
        .toggle-switch:hover { border-color: #1E4D8C; background: #f0f7ff; }
        .toggle-switch input { width: 18px; height: 18px; accent-color: #1E4D8C; cursor: pointer; }

        /* ── Tabla ───────────────────────────────────────────── */
        .data-table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }
        .data-table th {
            padding: 0.75rem 1rem; text-align: left;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; color: #64748b;
            background: #f8fafc; border-bottom: 1px solid #e2e8f0;
        }
        .data-table td {
            padding: 0.875rem 1rem; border-bottom: 1px solid #f1f5f9;
            color: #374151;
        }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #f8fafc; }

        /* ── Botones ─────────────────────────────────────────── */
        .btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.5rem 1rem; border-radius: 0.5rem;
            font-size: 0.8rem; font-weight: 600; text-decoration: none;
            cursor: pointer; border: none; transition: all 0.15s; font-family: inherit;
            white-space: nowrap;
        }
        .btn svg { width: 14px; height: 14px; flex-shrink: 0; }
        .btn-primary   { background: #1E4D8C; color: white; }
        .btn-primary:hover   { background: #153A6B; }
        .btn-success   { background: #16a34a; color: white; }
        .btn-success:hover   { background: #15803d; }
        .btn-danger    { background: #fee2e2; color: #dc2626; }
        .btn-danger:hover    { background: #fecaca; }
        .btn-ghost     { background: #f1f5f9; color: #475569; }
        .btn-ghost:hover     { background: #e2e8f0; }
        .btn-outline   { background: transparent; color: #475569; border: 1.5px solid #e2e8f0; }
        .btn-outline:hover   { border-color: #1E4D8C; color: #1E4D8C; }
        .btn-sm { padding: 0.375rem 0.75rem; font-size: 0.75rem; }
        .btn-lg { padding: 0.75rem 1.75rem; font-size: 0.9rem; border-radius: 0.625rem; }

        /* ── Badge ───────────────────────────────────────────── */
        .badge {
            display: inline-flex; align-items: center; gap: 0.25rem;
            padding: 0.2rem 0.625rem; border-radius: 9999px;
            font-size: 0.7rem; font-weight: 700;
        }
        .badge-blue    { background: #dbeafe; color: #1d4ed8; }
        .badge-green   { background: #dcfce7; color: #15803d; }
        .badge-red     { background: #fee2e2; color: #dc2626; }
        .badge-yellow  { background: #fef9c3; color: #92400e; }
        .badge-gray    { background: #f1f5f9; color: #475569; }

        /* ── Stat card ───────────────────────────────────────── */
        .stat-card {
            background: white; border-radius: 0.875rem; padding: 1.5rem;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 2px rgba(0,0,0,.04), 0 2px 8px rgba(0,0,0,.05);
            text-decoration: none; display: block; transition: all 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(0,0,0,.1); }
        .stat-icon {
            width: 44px; height: 44px; border-radius: 0.75rem;
            display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;
        }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-number { font-size: 2rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.375rem; }
        .stat-label  { font-size: 0.82rem; color: #64748b; font-weight: 500; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="admin-wrapper">

    {{-- Sidebar --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">IG</div>
            <div class="sidebar-logo-text">
                <h1>IGETIS</h1>
                <p>Panel de gestión</p>
            </div>
        </div>

        <nav class="sidebar-nav">
            <p class="sidebar-section-label">Principal</p>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                Dashboard
            </a>

            <p class="sidebar-section-label">Contenido</p>

            <a href="{{ route('admin.cursos.index') }}"
               class="nav-item {{ request()->routeIs('admin.cursos.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Cursos
            </a>

            <a href="{{ route('admin.articulos.index') }}"
               class="nav-item {{ request()->routeIs('admin.articulos.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                Blog / Artículos
            </a>

            <a href="{{ route('admin.categorias.index') }}"
               class="nav-item {{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                Categorías
            </a>

            <a href="{{ route('admin.docentes.index') }}"
               class="nav-item {{ request()->routeIs('admin.docentes.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Equipo docente
            </a>

            <p class="sidebar-section-label">Comunicación</p>

            <a href="{{ route('admin.mensajes.index') }}"
               class="nav-item {{ request()->routeIs('admin.mensajes.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Mensajes
                @php $noLeidos = \App\Models\Mensaje::where('leido', false)->count(); @endphp
                @if ($noLeidos > 0)
                    <span class="nav-badge">{{ $noLeidos }}</span>
                @endif
            </a>

            <p class="sidebar-section-label">Sistema</p>

            <a href="{{ route('admin.configuracion.index') }}"
               class="nav-item {{ request()->routeIs('admin.configuracion.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Configuración
            </a>

            <a href="{{ route('home') }}" target="_blank"
               class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Ver sitio web
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
                <div>
                    <div class="sidebar-user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="sidebar-user-role">Administrador</div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="main-content">
        <header class="topbar">
            <div>
                <div class="topbar-title">@yield('titulo', 'Dashboard')</div>
                @hasSection('subtitulo')
                    <div class="topbar-subtitle">@yield('subtitulo')</div>
                @endif
            </div>
            <div class="topbar-right">
                <span class="topbar-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ now()->format('d M Y') }}
                </span>
                @yield('topbar_action')
            </div>
        </header>

        <main class="page-body">
            @if (session('success'))
                <div class="alert alert-success">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @yield('contenido')
        </main>
    </div>
</div>
</body>
</html>
