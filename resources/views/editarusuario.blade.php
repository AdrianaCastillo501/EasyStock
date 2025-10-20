<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyStock | Editar Usuario</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Styles/editarusuario.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="sidebar">
    <div class="menu-icon">&#9776;</div>
    <div class="user-info">{{ $usuarioSesion->nombre }} {{ $usuarioSesion->apellido }}</div>
    <div class="menu">
      <span>
        <a href="{{ route('actualizar.datos') }}"><i class="fas fa-sync-alt"></i> Actualizar datos</a>
      </span>
      <span>
        <a href="{{ route('dashboard.usuarios') }}" class="menu-itemcom"><i class="fas fa-user-cog"></i> Mantención de usuarios</a>
      </span>
      <span>
        <a href="{{ route('logout') }}" onclick="return confirm('¿Seguro que deseas cerrar sesión?');"><i class="fas fa-power-off"></i> Cerrar sesión</a>
      </span>
    </div>
  </div>

  <div class="main-content">
    <a href="{{ route('dashboard') }}">
            <img class="contenedor-m" src="{{ asset('image/icono.png') }}" alt="Logo">
    </a>

    <h1>Ferretería El Grillo</h1>
    <h4>{{ $usuarioSesion->rol->nombre_rol }}</h4>

    <div class="Agregar">
      <h3><i class="fas fa-user-edit"></i> Editar Usuario</h3>
    </div>

    {{-- Mensajes de validación --}}
    @if($errors->any())
      <div class="alert-error">
        {{ $errors->first() }}
      </div>
    @endif

    @if(session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- FORMULARIO DE EDICIÓN --}}
    <form action="{{ route('usuarios.actualizar', $usuario->id_usuario) }}" method="POST" class="formulario-usuario">
      @csrf
      @method('PUT')

      <fieldset>
        <legend><i class="fas fa-user"></i> Información</legend>

        <div class="fila">
          <div class="form-group">
            <label for="no_identificacion">N. Documento:</label>
            <input type="text" id="no_identificacion" name="no_identificacion" value="{{ $usuario->no_identificacion }}" required>
          </div>

          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $usuario->nombre }}" required>
          </div>
        </div>

        <div class="fila">
          <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="{{ $usuario->apellido }}" required>
          </div>

          <div class="form-group">
            <label for="id_rol">Rol:</label>
            <select id="id_rol" name="id_rol" required>
              <option value="1" {{ $usuario->id_rol == 1 ? 'selected' : '' }}>Administrador</option>
              <option value="2" {{ $usuario->id_rol == 2 ? 'selected' : '' }}>Vendedor</option>
              <option value="3" {{ $usuario->id_rol == 3 ? 'selected' : '' }}>Inventarista</option>
            </select>
          </div>
        </div>

        <div class="fila">
          <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="{{ $usuario->correo }}" required>
          </div>

          <div class="form-group">
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
              <option value="activo" {{ $usuario->estado == 'activo' ? 'selected' : '' }}>activo</option>
              <option value="inactivo" {{ $usuario->estado == 'inactivo' ? 'selected' : '' }}>inactivo</option>
              <option value="suspendido" {{ $usuario->estado == 'suspendido' ? 'selected' : '' }}>suspendido</option>
            </select>
          </div>
        </div>

        <div class="fila">
          <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" placeholder="Dejar en blanco si no se cambia">
          </div>
        </div>

        <div class="form-buttons">
          <button type="submit" class="btn-guardar">
            <i class="fas fa-save"></i> Guardar Cambios
          </button>
          <a href="{{ route('dashboard.usuarios') }}" class="btn-cancelar">
            <i class="fas fa-times"></i> Cancelar
          </a>
        </div>
      </fieldset>
    </form>
  </div>

</body>
</html>
