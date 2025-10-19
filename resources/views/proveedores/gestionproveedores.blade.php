<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyStock | Proveedores</title>

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- jQuery y DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS local -->
    <link rel="stylesheet" href="{{ asset('Styles/gestionproveedor.css') }}">

</head>

<body>
    <div class="sidebar">
        <div class="menu-icon">&#9776;</div>
        <div class="user-info">Felipe Casanova</div>
        <div class="menu">
            <span><a href="{{ url('/') }}"><i class="fas fa-sync-alt"></i> Actualizar datos</a></span>
            <span><a href="{{ url('/usuarios') }}" class="menu-itemcom"><i class="fas fa-user-cog"></i> Mantención de usuarios</a></span>
            <span><a href="{{ url('/configuracion') }}" class="menu-itemlog"><i class="fas fa-cogs"></i> Configuración</a></span>
        </div>
    </div>
  
    <div class="main-content">
        <a href="{{ url('/') }}">
            <img class="contenedor-m" src="{{ asset('images/icono.png') }}" alt="Logo">
        </a>

        <h1>Ferretería El Grillo</h1>
        <h4>Administrador</h4>

        <section class="proveedor">
            <div class="proveedor-header">
                <h3><i class="fas fa-box-open"></i> Lista de Proveedores</h3>
                <div class="contenedor-botones">
                    <a href="{{ url('/proveedores/crear') }}" class="btn-nuevo-proveedor">
                        <i class="fas fa-plus"></i> Nuevo Proveedor
                    </a>
                    <a href="{{ url('/compras') }}" class="btn-gestion-compras">
                        <i class="fas fa-shopping-cart"></i> Gestión Compras
                    </a>
                </div>
            </div>

            <!-- Tabla dinámica -->
            <section>
                <table class="tabla-proveedor">
                    <thead>
                        <tr>
                            <th>NOMBRE DEL PROVEEDOR</th>
                            <th>NIT</th>
                            <th>CONTACTO PRINCIPAL</th>
                            <th>TELEFONO</th>
                            <th>TIEMPO DE RELACIÓN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proveedores as $proveedor)
                            <tr>
                                <td>{{ $proveedor->nombre_empresa }}</td>
                                <td>{{ $proveedor->numero_identificacion }}</td>
                                <td>{{ $proveedor->nombre_contacto }}</td>
                                <td>{{ $proveedor->telefono_contacto }}</td>
                                <td>{{ $proveedor->tiempoRelacion() }}</td>
                                <td>
                                    <div class="acciones">
                                        <button class="btn-ver" title="Ver">🔍</button>
                                        <button class="btn-editar" title="Editar">🖊</button>
                                        <button class="btn-cancelar" title="Eliminar">🗑</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;">No hay proveedores registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </section>
    </div>

    <!-- Activar DataTables -->
    <script>
        $(document).ready(function () {
            $('.tabla-proveedor').DataTable({
                pageLength: 4,
                lengthMenu: [[4, 8, 10], [4, 8, 10]],
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' }
            });
        });
    </script>
</body>
</html>