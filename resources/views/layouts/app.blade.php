<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PLATAFORMA VIRTUAL  </title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div   class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">INICIO</a>
        @auth
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('tasks.index') }}">TAREAS</a>
                <a class="nav-link" href="{{ route('exam.index') }}">EXÁMENES</a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="d-inline ms-auto">
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm">Cerrar sesión</button>
            </form>
        @endauth
    </div>
</nav>

    @yield('content')
</div>

</body>
</html>
