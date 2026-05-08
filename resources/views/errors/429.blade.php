<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demasiados intentos — IGETIS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #EBF1FA;
            padding: 1.5rem;
            -webkit-font-smoothing: antialiased;
        }
        .card {
            background: white;
            border-radius: 1.25rem;
            box-shadow: 0 8px 32px rgba(30,77,140,.12);
            padding: 3rem 2.5rem;
            max-width: 420px;
            width: 100%;
            text-align: center;
        }
        .icon {
            width: 64px; height: 64px;
            background: #fef2f2;
            border-radius: 9999px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
        }
        h1 { font-size: 1.375rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem; }
        p { font-size: 0.875rem; color: #64748b; line-height: 1.7; margin-bottom: 2rem; }
        a {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: #1E4D8C;
            color: white;
            font-weight: 700;
            font-size: 0.875rem;
            border-radius: 0.625rem;
            text-decoration: none;
            transition: background 0.2s;
        }
        a:hover { background: #153A6B; }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">
            <svg width="28" height="28" fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <h1>Demasiados intentos</h1>
        <p>Has realizado demasiadas solicitudes en poco tiempo.<br>Por favor espera unos minutos antes de intentarlo de nuevo.</p>
        <a href="javascript:history.back()">Volver</a>
    </div>
</body>
</html>
