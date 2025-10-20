<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyStock | @yield('title')</title>

    <!-- Fuentes y estilos -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@100..1000&family=Lora:wght@400..700&family=Montserrat:wght@100..900&family=Noto+Sans:wght@100..900&family=Roboto:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('Styles/layouts.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu-icon">&#9776;</div>
        <div class="user-info">
            {{ $usuario->nombre ?? 'Usuario' }} {{ $usuario->apellido ?? '' }}
        </div>
        <div class="menu">
            <span>
                <a href="{{ route('actualizar.datos') }}"><i class="fas fa-sync-alt"></i> Actualizar datos</a>
            </span>
            <span>
                <a href="{{ route('dashboard.usuarios') }}"><i class="fas fa-user-cog"></i> Mantención de usuarios</a>
            </span>
            <span>
                <a href="{{ route('logout') }}" onclick="return confirm('¿Estás seguro que deseas cerrar sesión?');">
                    <i class="fas fa-power-off"></i> Cerrar sesión
                </a>
            </span>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        <header>
    <a href="{{ route('dashboard') }}">
            <img class="contenedor-m" src="{{ asset('image/icono.png') }}" alt="Logo">
    </a>
            <h1>Ferretería El Grillo</h1>
            <h3>{{ $usuario->rol->nombre_rol ?? 'Rol' }}</h3>
        </header>

        <!-- Contenido específico de cada vista -->
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    @stack('scripts')
</body>
</html>
