<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyStock | Registro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Styles/registro.css') }}">
</head>
<body>
    <a href="{{ route('login.form') }}">
        <img class="contenedor-m" src="{{ asset('image/icono.png') }}" alt="Logo">
    </a>

    <div class="login-container">
        <div class="login-card">
            <h1 class="registro_name">Registro de Usuario</h1>

            {{-- Mostrar errores de validación --}}
            @if($errors->any())
                <div style="color:red;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Mostrar mensaje de éxito --}}
            @if(session('success'))
                <div style="color:green;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="formulario" novalidate>
                @csrf

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu nombre" name="nombre" value="{{ old('nombre') }}" required>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" placeholder="Tu apellido" name="apellido" value="{{ old('apellido') }}" required>

                <label for="identificacion">No. Identificacion</label>
                <input type="text" id="identificacion" placeholder="No. identificacion" name="no_identificacion" value="{{ old('no_identificacion') }}" required>

                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" placeholder="Tu Email" name="correo" value="{{ old('correo') }}" required>

                <label for="cargo">Cargo</label>
                <select id="cargo" name="id_rol" required>
                    <option value="">-- Selecciona un cargo --</option>
                    <option value="1" {{ old('id_rol') == 1 ? 'selected' : '' }}>Administrador</option>
                    <option value="2" {{ old('id_rol') == 2 ? 'selected' : '' }}>Vendedor</option>
                    <option value="3" {{ old('id_rol') == 3 ? 'selected' : '' }}>Inventarista</option>
                </select>
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Contraseña" name="contrasena" required>

                <input type="submit" class="boton" value="Crear Cuenta">
            </form>

            <div class="register-text">¿Ya tienes una cuenta?
                <a href="{{ route('login.form') }}"> Iniciar Sesión</a>
            </div>

        </div>
    </div>
</body>
</html>
