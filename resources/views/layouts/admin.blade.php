<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Panel Admin') — IGETIS</title>
    @vite(['resources/css/app.css'])
    <style>
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; height: 100%; }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 256px;
            min-width: 256px;
            background-color: #1E4D8C;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 10;
        }

        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid #2E6DB4;
        }

        .sidebar-logo h1 {
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        .sidebar-logo p {
            color: #bfdbfe;
            font-size: 0.75rem;
            margin: 0.25rem 0 0;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #bfdbfe;
            text-decoration: none;
            transition: background-color 0.15s, color 0.15s;
        }

        .nav-link:hover {
            background-color: #2E6DB4;
            color: white;
        }

        .nav-link.active {
            background-color: #2E6DB4;
            color: white;
        }

        .nav-link svg {
            width: 1rem;
            height: 1rem;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid #2E6DB4;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
            padding: 0.625rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #bfdbfe;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: background-color 0.15s, color 0.15s;
        }

        .logout-btn:hover {
            background-color: #ef4444;
            color: white;
        }

        .logout-btn svg {
            width: 1rem;
            height: 1rem;
            flex-shrink: 0;
        }

        /* Main content */
        .main-content {
            margin-left: 256px;
            flex: 1;
            background-color: #f3f4f6;
            padding: 2rem;
            min-height: 100vh;
            min-width: 0;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .page-header p {
            color: #6b7280;
            font-size: 0.875rem;
            margin: 0.25rem 0 0;
        }

        .alert {
            font-size: 0.875rem;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            border-width: 1px;
            border-style: solid;
        }

        .alert-success {
            background: #f0fdf4;
            color: #15803d;
            border-color: #bbf7d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }
    </style>
</head>
<body>

    <div class="admin-wrapper">

        <!-- Sidebar -->
        <aside class="sidebar">

            <div class="sidebar-logo">
                <h1>IGETIS</h1>
                <p>Panel de gestión</p>
            </div>

            <nav class="sidebar-nav">

                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Inicio
                </a>

                <a href="{{ route('admin.cursos.index') }}"
                   class="nav-link {{ request()->routeIs('admin.cursos.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Cursos
                </a>

                <a href="{{ route('admin.articulos.index') }}"
                   class="nav-link {{ request()->routeIs('admin.articulos.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    Blog
                </a>

                <a href="{{ route('admin.categorias.index') }}"
                   class="nav-link {{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Categorías
                </a>

                <a href="{{ route('admin.mensajes.index') }}"
                   class="nav-link {{ request()->routeIs('admin.mensajes.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Mensajes
                </a>

                <a href="{{ route('admin.configuracion.index') }}"
                   class="nav-link {{ request()->routeIs('admin.configuracion.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Configuración
                </a>

            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Cerrar sesión
                    </button>
                </form>
            </div>

        </aside>

        <!-- Contenido principal -->
        <main class="main-content">

            <div class="page-header">
                <h2>@yield('titulo', 'Dashboard')</h2>
                @hasSection('subtitulo')
                    <p>@yield('subtitulo')</p>
                @endif
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @yield('contenido')

        </main>

    </div>

</body>
</html>
