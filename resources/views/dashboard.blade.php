<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Bienvenido</h2>
    <p>Usuario: {{ session('usuario') }}</p>
    <a href="{{ route('logout') }}">Cerrar sesión</a>
</body>
</html>
