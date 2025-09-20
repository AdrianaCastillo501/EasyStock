<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyStock | Recuperar Contraseña</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Styles/olvide.css') }}">
</head>

<body>
    <a href="{{ route('login.form') }}">
        <img class="contenedor-m" src="{{ asset('image/icono.png') }}" alt="Logo">
    </a>

    <div class="container">
        <div class="logos">
            <h1 class="logo">EasyStock</h1>
        </div>

        <p class="descripcion-pagina">Recupera tu acceso a EasyStock</p>

        {{-- Formulario de recuperación --}}

                        {{-- Mostrar errores --}}
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
        
        <form action="{{ route('password.email') }}" method="POST" class="formulario" novalidate>
            @csrf

            <div class="campo">
                <label for="no_identificacion">No. Identificacion</label>
                <input type="text" id="no_identificacion" placeholder="No. identificacion" name="no_identificacion" required>

                <label for="correo">Email</label>
                <input type="email" id="correo" placeholder="Tu Email" name="correo" required>
            </div>

            <input type="submit" class="boton" value="Enviar Instrucciones">
        </form>

        <div class="register-text">
            ¿Ya tienes una Cuenta?
            <a href="{{ route('login.form') }}"> Iniciar Sesión</a>
            ¿Aún No Tienes Una Cuenta?
            <a href="{{ route('register.form') }}">Obtener Una</a>
        </div>
    </div>
</body>
</html>
