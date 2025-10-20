<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyStock</title>

    <!-- Fuentes y estilos -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@100..1000&family=Lora:wght@400..700&family=Montserrat:wght@100..900&family=Noto+Sans:wght@100..900&family=Roboto:wght@100..900&display=swap" rel="stylesheet">

    <!-- Enlace al CSS -->
    <link rel="stylesheet" href="{{ asset('Styles/stylesheet.css') }}">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    
  <div class="sidebar">
    <div class="menu-icon">&#9776;</div>
    <div class="user-info">
    {{ $usuario->nombre }} {{ $usuario->apellido }}
    </div>
    <div class="menu">
      <span>
        <a href="{{ route('actualizar.datos') }}"><i class="fas fa-sync-alt"></i> Actualizar datos</a>
      </span>
     <span>
        <a href="{{ route('dashboard.usuarios') }}" class="menu-itemcom"><i class="fas fa-user-cog"></i> Mantención de usuarios
  </a>
</span>

      <span>
        <a href="{{ route('logout') }}" onclick="return confirm('¿Estás seguro que deseas cerrar sesión?');">
            <i class="fas fa-power-off"></i> Cerrar sesión
        </a>

      </span>
    </div>
  </div>

  <div class="main-content">
    <img class="contenedor-m" src="{{ asset('image/icono.png') }}" alt="Logo">

    <h1>Ferretería El Grillo</h1>
    <h3>{{ $usuario->rol->nombre_rol }}</h3>

    <div class="icon-grid">
        <a class="icon-button" href="#"><i class="fas fa-shopping-cart"></i> Ventas</a>
        <a class="icon-button" href="#"><i class="fas fa-truck"></i> Operaciones</a>
        <a class="icon-button" href="#"><i class="fas fa-warehouse"></i> Inventario</a>
        <a class="icon-button" href="{{ route('clientes.index') }}"><i class="fas fa-user-plus"></i> Clientes</a>
        <a class="icon-button" href="#"><i class="fas fa-box-open"></i> Proveedores</a>
        <a class="icon-button" href="#"><i class="fas fa-file-alt"></i> Reportes</a>
    </div>
  </div>

<script>
function confirmarCierreSesion(event) {
    event.preventDefault();

    // Mostrar un cuadro de confirmación con mejor diseño
    if (confirm("¿Está seguro de que desea cerrar sesión?")) {
        window.location.href = "{{ route('logout') }}";
    }
}
</script>



</body>
</html>
