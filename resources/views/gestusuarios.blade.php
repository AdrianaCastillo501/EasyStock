<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyStock | Gestión Usuarios</title>

    <!-- Fuentes y estilos -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('Styles/gestusuarios.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- jQuery y DataTables -->
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
                <a href="{{ route('dashboard.usuarios') }}" class="menu-itemcom"><i class="fas fa-user-cog"></i> Mantención de usuarios</a>
            </span>
            <span>
                <a href="{{ route('logout') }}" onclick="return confirm('¿Estás seguro que deseas cerrar sesión?');"><i class="fas fa-power-off"></i> Cerrar sesión
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
                <h3><i class="fas fa-user-check"></i> Gestión Usuarios</h3>
            </div>

            <!-- Filtros -->
            <div class="filtro-usuarios">
                <label for="estado">Estado:</label>
                <select id="estado">
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="suspendido">Suspendido</option>
                </select>

                <label for="cargo">Cargo:</label>
                <select id="cargo">
                    <option value="">Todos</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Vendedor">Vendedor</option>
                    <option value="Inventarista">Inventarista</option>
                </select>

                <button onclick="filtrarUsuarios()">Aplicar filtros</button>
            </div>

            <!-- Tabla de usuarios -->
            <section>
                <table class="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>N. DOCUMENTO</th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>CORREO</th>
                            <th>CARGO</th>
                            <th>CONTRASEÑA</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $u)
                            <tr>
                                <td>{{ $u->no_identificacion }}</td>
                                <td>{{ $u->nombre }}</td>
                                <td>{{ $u->apellido }}</td>
                                <td>{{ $u->correo }}</td>
                                <td>{{ $u->rol->nombre_rol }}</td>
                                <td>{{ $u->contrasena }}</td>
                                <td>{{ $u->estado }}</td>
                                <td>
                                    <div class="acciones">
                                        <a href="{{ route('usuarios.editar', $u->id_usuario) }}" class="btn-editar" title="Editar">🖊</a>
                                        <form action="{{ route('usuarios.eliminar', $u->id_usuario) }}" method="POST" style="display:inline;" onsubmit="return confirm('⚠️ ¿Seguro que deseas eliminar este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-cancelar" title="Eliminar">🗑</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </section>
    </div>

    <!-- Scripts -->
    <script>
        $(document).ready(function () {
            $('.tabla-usuarios').DataTable({
                pageLength: 4,
                lengthMenu: [[4, 8, 10], [4, 8, 10]],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                }
            });
        });

        function filtrarUsuarios() {
            const estado = document.getElementById("estado").value;
            const cargo = document.getElementById("cargo").value;
            const filas = document.querySelectorAll(".tabla-usuarios tbody tr");

            filas.forEach(fila => {
                const cargoFila = fila.cells[4].textContent.trim();
                const estadoFila = fila.cells[6].textContent.trim();

                if ((estado === "" || estado === estadoFila) &&
                    (cargo === "" || cargo === cargoFila)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        }

    </script>
</body>
</html>
