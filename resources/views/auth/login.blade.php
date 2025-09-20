<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyStock | Login</title>
    <link rel="stylesheet" href="{{ asset('Styles/login.css') }}">
</head>

<body>
    <a href="{{ route('login.form') }}">
        <img class="contenedor-m" src="{{ asset('image/icono.png') }}" alt="Logo">
    </a>

    <div class="login-container">
        <div class="login-card">
            <h1 class="Iniciar_name">Iniciar Sesión</h1>

            {{-- Mostrar errores --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="formulario" novalidate>
                @csrf

                <label for="no_identificacion">No. Identificación</label>
                <input type="text" id="no_identificacion" name="no_identificacion" placeholder="No. identificación" value="{{ old('identificacion') }}" required autofocus>

                <div class="password-section">
                    <label for="contrasena">Contraseña</label>
                    <a href="{{ route('password.forgot') }}"class="forgot-password">Olvidaste tu contraseña?</a>
                </div>
                
                <input type="password" id="contrasena" name="contrasena" placeholder="Tu contraseña" required>

                <div class="recordarme">
                     <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                     <label for="remember">Recordarme</label>
                </div>
                
                <input type="submit" class="boton" value="Ingresar">
            </form>
         
            <div class="register-text">¿Aún No Tienes Una Cuenta?
                <a href="{{ route('register.form') }}"> Obtener una</a></p>
            </div>
        </div>
    </div>    
</body>
</html>
