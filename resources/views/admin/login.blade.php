<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo — IGETIS</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-md p-10 w-full max-w-md">

        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-[#1E4D8C]">IGETIS</h1>
            <p class="text-gray-500 text-sm mt-1">Panel de gestión interna</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 text-sm rounded-lg px-4 py-3 mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Correo electrónico
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1E4D8C]"
                >
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Contraseña
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1E4D8C]"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-[#1E4D8C] hover:bg-[#153A6B] text-white font-medium py-2.5 rounded-lg transition-colors text-sm"
            >
                Ingresar
            </button>
        </form>

    </div>

</body>
</html>