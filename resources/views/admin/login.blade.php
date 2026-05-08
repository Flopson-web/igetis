<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso — IGETIS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@700;800;900&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0f172a;
            background-image: radial-gradient(rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: 32px 32px;
            -webkit-font-smoothing: antialiased;
            padding: 1.5rem;
        }

        .card {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 1.25rem;
            box-shadow: 0 25px 50px rgba(0,0,0,.4), 0 8px 16px rgba(0,0,0,.3);
            overflow: hidden;
        }

        .card-top {
            background: #0f172a;
            padding: 2rem 2rem 1.75rem;
            text-align: center;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            margin-bottom: 0.5rem;
        }

        .logo-name {
            font-family: 'Figtree', system-ui, sans-serif;
            font-size: 1.5rem;
            font-weight: 900;
            color: white;
            letter-spacing: -0.04em;
            line-height: 1;
        }

        .logo-sub {
            font-size: 0.72rem;
            font-weight: 500;
            color: rgba(255,255,255,.6);
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .card-body {
            padding: 2rem;
        }

        .card-heading {
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.25rem;
        }

        .card-sub {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-bottom: 1.75rem;
        }

        .alert-error {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 0.625rem;
            padding: 0.7rem 0.875rem;
            margin-bottom: 1.25rem;
            font-size: 0.8rem;
            color: #dc2626;
        }

        .field {
            margin-bottom: 1rem;
        }

        .field label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.375rem;
        }

        .field input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.625rem;
            font-size: 0.875rem;
            font-family: inherit;
            color: #1e293b;
            background: #f8fafc;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
        }

        .field input:focus {
            border-color: #1E4D8C;
            background: white;
            box-shadow: 0 0 0 3px rgba(30,77,140,.1);
        }

        .btn-submit {
            width: 100%;
            padding: 0.8rem;
            background: #1E4D8C;
            color: white;
            font-size: 0.9rem;
            font-weight: 700;
            font-family: 'Figtree', system-ui, sans-serif;
            border: none;
            border-radius: 0.625rem;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            margin-top: 0.5rem;
            letter-spacing: 0.01em;
        }

        .btn-submit:hover {
            background: #F97316;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(249,115,22,.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .card-footer {
            padding: 1rem 2rem 1.5rem;
            text-align: center;
            border-top: 1px solid #f1f5f9;
        }

        .back-link {
            font-size: 0.78rem;
            font-weight: 600;
            color: #94a3b8;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: color 0.15s;
        }

        .back-link:hover { color: #1E4D8C; }
    </style>
</head>
<body>

    <div class="card">

        <div class="card-top">
            <div class="brand">
                <img src="{{ asset('img/logos/Version en blanconegativo para el navbar oscuro .png') }}" alt="" style="height:36px; width:auto;">
                <span class="logo-name">IGE<span style="color:#F97316">TIS</span></span>
            </div>
            <div class="logo-sub">Panel de administración</div>
        </div>

        <div class="card-body">
            <h2 class="card-heading">Bienvenido de vuelta</h2>
            <p class="card-sub">Ingresa tus credenciales para continuar.</p>

            @if ($errors->any())
                <div class="alert-error">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                {{-- honeypot: campo invisible para humanos, los bots lo llenan --}}
                <div style="position:absolute;left:-9999px;top:-9999px;opacity:0;pointer-events:none;" aria-hidden="true">
                    <input type="text" name="_business_url" value="" tabindex="-1" autocomplete="off">
                </div>
                <div class="field">
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           placeholder="admin@igetis.com" required autofocus>
                </div>
                <div class="field">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" name="password"
                           placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-submit">Ingresar al panel</button>
            </form>
        </div>

        <div class="card-footer">
            <a href="{{ route('home') }}" class="back-link">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                Volver al sitio
            </a>
        </div>

    </div>

</body>
</html>
