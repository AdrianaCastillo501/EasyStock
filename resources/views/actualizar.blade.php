<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyStock | Actualizar Datos</title>

    <!-- Fuentes y estilos -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('styles/actualizar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- jQuery y DataTables (si los necesitas) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="menu-icon">&#9776;</div>
        <div class="user-info">{{ $usuario->nombre }} {{ $usuario->apellido }}</div>
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
        <a href="{{ route('dashboard') }}">
            <img class="contenedor-m" src="{{ asset('image/icono.png') }}" alt="Logo">
        </a>

        <h1>Ferretería El Grillo</h1>
        <h4>{{ $usuario->rol->nombre_rol }}</h4>

        <!-- Mensaje de éxito -->
@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif


        <section class="Usuarios">
            <div class="GestionUsuarios">
                <h3><i class="fas fa-user-check"></i> Actualizar Datos</h3>
            </div>

            <form action="{{ route('dashboard.update') }}" method="POST">
                @csrf
                @method('PUT')

                <fieldset>
                    <legend>Información Personal</legend>
                    <div class="grid-2">
                        <div>
                            <label for="nombre">Nombres</label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
                        </div>
                        <div>
                            <label for="apellido">Apellidos</label>
                            <input type="text" id="apellido" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" required>
                        </div>
                        <div>
                            <label for="identificacion">No. Identificación</label>
                            <input type="text" id="identificacion" name="no_identificacion" value="{{ old('no_identificacion', $usuario->no_identificacion) }}" required>
                        </div>
                        <div>
                            <label for="correo">Correo Electrónico</label>
                            <input type="email" id="correo" name="correo" value="{{ old('correo', $usuario->correo) }}" required>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Información Laboral</legend>
                    <div class="grid-2">
                        <div>
                            <label for="cargo">Cargo</label>
                            <select id="cargo" name="id_rol" required>
                                <option value="">-- Selecciona un cargo --</option>
                                <option value="1" {{ old('id_rol', $usuario->id_rol) == 1 ? 'selected' : '' }}>Administrador</option>
                                <option value="2" {{ old('id_rol', $usuario->id_rol) == 2 ? 'selected' : '' }}>Vendedor</option>
                                <option value="3" {{ old('id_rol', $usuario->id_rol) == 3 ? 'selected' : '' }}>Inventarista</option>
                            </select>
                        </div>
                        <div>
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="contrasena" placeholder="Contraseña" required>
                        </div>
                    </div>
                </fieldset>

                <div class="form-buttons">
                    <button type="submit" class="btn-guardar">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <button type="button" class="btn-cancelar" onclick="window.location='{{ route('dashboard') }}'">
                        <i class="fas fa-times"></i> Cancelar
                    </button>

                </div>
            </form>
        </section>
    </div>
</body>
</html>
