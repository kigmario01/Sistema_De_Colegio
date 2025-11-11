<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema Escolar')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <nav class="container-fluid">
        <ul>
            <li><strong>Sistema Escolar</strong></li>
        </ul>
        <ul>
            <li><a href="/oferta-educativa">Oferta educativa</a></li>
            <li><a href="/docentes">Docentes</a></li>
            <li><a href="/horarios">Horarios</a></li>
        </ul>
    </nav>
    <main class="container">
        @yield('content')
    </main>
</body>
</html>
