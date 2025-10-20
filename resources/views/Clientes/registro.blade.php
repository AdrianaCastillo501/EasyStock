<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EasyStock | Clientes</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Fuentes y estilos -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@100..1000&family=Lora:wght@400..700&family=Montserrat:wght@100..900&family=Noto+Sans:wght@100..900&family=Roboto:wght@100..900&display=swap" rel="stylesheet">

  <!-- Enlace al CSS -->
  <link rel="stylesheet" href="{{ asset('Styles/registrocliente.css') }}">

  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <!-- Sidebar -->
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
        <a href="{{ route('dashboard.usuarios') }}" class="menu-itemcom">
          <i class="fas fa-user-cog"></i> Mantención de usuarios
        </a>
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
    <div class="logo-container">
      <a href="{{ url('/dashboard') }}">
        <img class="contenedor-m" src="{{ asset('image/icono.png') }}" alt="Logo">
      </a>
    </div>

    <h1>Ferretería El Grillo</h1>
    <h3>{{ $usuario->rol->nombre_rol }}</h3>

    <div class="registro">
      <h3><i class="fas fa-user-plus"></i> Registro de Cliente</h3>
    </div>

    <form action="{{ route('clientes.store') }}" method="POST">
      @csrf
      <fieldset>   
        <legend>Agregar</legend>
        <div class="form-row">
          <div class="form-group">
            <label for="id_cliente"><i class="fas fa-id-badge"></i> ID Cliente</label>
            <input type="text" id="id_cliente" name="id_cliente" value="{{ old('id_cliente', $nuevoId) }}" readonly>
          </div>
    <div class="form-group">
      <label for="nombre"><i class="fas fa-user"></i> Nombre completo</label>
      <input type="text" id="nombre" name="nombre" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="tipo_cliente"><i class="fas fa-user-tag"></i> Tipo de Cliente</label>
      <select id="tipo_cliente" name="tipo_cliente" required>
        <option value="">Seleccione...</option>
        <option value="Natural">Persona Natural</option>
        <option value="Juridica">Persona Jurídica</option>
      </select>
    </div>
    <div class="form-group">
      <label for="tipo_documento"><i class="fas fa-id-card"></i> Tipo de Documento</label>
      <select id="tipo_documento" name="tipo_documento" required>
        <option value="">Seleccione...</option>
        <option value="CC">Cédula de Ciudadanía</option>
        <option value="CE">Cédula de Extranjería</option>
        <option value="NIT">NIT</option>
      </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="numero_documento"><i class="fas fa-hashtag"></i> Número de Documento</label>
      <input type="text" id="numero_documento" name="numero_documento" required>
    </div>
    <div class="form-group">
      <label for="correo"><i class="fas fa-envelope"></i> Correo electrónico</label>
      <input type="email" id="correo" name="correo" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="celular"><i class="fas fa-phone"></i> Celular</label>
      <input type="tel" id="celular" name="celular" required>
    </div>
    <div class="form-group">
      <label for="direccion"><i class="fas fa-map-marker-alt"></i> Dirección</label>
      <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion') }}" required>
    </div>

  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="ciudad"><i class="fas fa-city"></i> Ciudad</label>
      <input type="text" id="ciudad" name="ciudad" required>
    </div>
    <div class="form-group">
     <label for="fecha_creacion"><i class="fas fa-calendar-alt"></i> Fecha de Creación</label>
      <input type="date" id="fecha_creacion" name="fecha_creacion" value="{{ date('Y-m-d') }}" readonly>
    </div>
  </div>

  <div class="form-row">
  <div class="form-group">
    <label for="estado"><i class="fas fa-toggle-on"></i> Estado</label>
    <select id="estado" name="estado" required>
      <option value="Activo">Activo</option>
      <option value="Inactivo">Inactivo</option>
    </select>
  </div>
</div>

   </fieldset>

  <div class="form-buttons">
  <button type="submit" class="btn-guardar">
    <i class="fas fa-save"></i> Guardar Cliente
  </button>
  <button type="button" class="btn-cancelar" onclick="history.back()">
    <i class="fas fa-times"></i> Cancelar
  </button>
</div>


    </form>
</body>
</html>