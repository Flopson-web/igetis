<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="flex bg-blue-500 text-white p-8 min-h-screen">
        <div class="w-64 bg-red-500 p-4">Sidebar</div>
        <div class="flex-1 bg-green-500 p-4">Contenido</div>
    </div>
</body>
</html>