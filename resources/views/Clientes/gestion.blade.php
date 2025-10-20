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
    <link rel="stylesheet" href="{{ asset('Styles/gestionclientes.css') }}">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

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
    <div class="logo-container">
      <a href="{{ url('/dashboard') }}">
        <img class="contenedor-m" src="{{ asset('image/icono.png') }}" alt="Logo">
      </a>
    </div>

    <h1>Ferretería El Grillo</h1>
    <h3>{{ $usuario->rol->nombre_rol }}</h3>

    <section class="Clientes">
      <div class="Clientes">
        <h3><i class="fas fa-user"></i> Gestión Clientes</h3>
      </div>

      <div class="clientes-header">
        <div class="boton-nuevo-cliente">
          <a href="{{ route('clientes.registro') }}">
            <button class="btn-nuevo-cliente"><i class="fas fa-plus"></i> Nuevo Cliente</button>
          </a>
        </div>
      </div>

      <!-- Tarjetas KPI -->
      <div class="cards-container">
        <div class="card">
          <h3>TOTAL CLIENTES</h3>
          <p>{{ $totalClientes }}</p>
        </div>
        <div class="card">
          <h3>CLIENTES ACTIVOS</h3>
          <p>{{ $clientesActivos }}</p>
        </div>
      </div>

      @if (session('success'))
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger">
          <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
      @endif

      <!-- Tabla de Clientes -->
      <section>
        <table class="tabla-cliente">
          <thead>
            <tr>
              <th>No. IDENTIFICACIÓN</th>
              <th>NOMBRE</th>
              <th>DIRECCIÓN</th>
              <th>EMAIL</th>
              <th>CELULAR</th>
              <th>ESTADO</th>
              <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($clientes as $cliente)
              <tr>
                <td>{{ $cliente->numero_documento }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->correo }}</td>
                <td>{{ $cliente->celular ?? '—' }}</td>
                <td>
                  @if ($cliente->estado == 'Activo')
                    <span class="estado-activo">Activo</span>
                  @else
                    <span class="estado-inactivo">Inactivo</span>
                  @endif
                </td>
                <td>
                  <div class="acciones">
                    <button class="btn-ver" title="Ver"
                      onclick="verDetallesCliente(
                        '{{ $cliente->id_cliente }}',
                        '{{ $cliente->nombre }}',
                        '{{ $cliente->tipo_cliente }}',
                        '{{ $cliente->tipo_documento }}',
                        '{{ $cliente->numero_documento }}',
                        '{{ $cliente->correo }}',
                        '{{ $cliente->celular }}',
                        '{{ $cliente->direccion }}',
                        '{{ $cliente->ciudad }}',
                        '{{ $cliente->fecha_creacion }}',
                        '{{ $cliente->fecha_actualizacion }}',
                        '{{ $cliente->estado }}'
                      )">🔍
                    </button>

                    <button class="btn-editar" title="Editar" onclick="editarCliente({{ $cliente->id_cliente }})">🖊</button>

                    <button class="btn-cancelar" title="Eliminar" onclick="abrirConfirmEliminar({{ $cliente->id_cliente }})">🗑</button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </section>
    </section>
  </div>

  <!-- Modal Ver Cliente -->
  <div id="modalVerCliente" class="modal">
    <div class="modal-content">
      <span class="close" onclick="cerrarModalVer()">&times;</span>
      <h2><i class="fas fa-user-circle"></i> Detalles del Cliente</h2>

      <form id="form-ver-cliente">
        <div class="form-row">
          <div class="form-group">
            <label>ID Cliente</label>
            <input type="text" id="ver_id_cliente" readonly>
          </div>
          <div class="form-group">
            <label>Nombre Completo</label>
            <input type="text" id="ver_nombre" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Tipo de Cliente</label>
            <input type="text" id="ver_tipo_cliente" readonly>
          </div>
          <div class="form-group">
            <label>Tipo de Documento</label>
            <input type="text" id="ver_tipo_documento" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Número de Documento</label>
            <input type="text" id="ver_numero_documento" readonly>
          </div>
          <div class="form-group">
            <label>Correo</label>
            <input type="text" id="ver_correo" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Celular</label>
            <input type="text" id="ver_celular" readonly>
          </div>
          <div class="form-group">
            <label>Dirección</label>
            <input type="text" id="ver_direccion" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group mitad">
            <label>Ciudad</label>
            <input type="text" id="ver_ciudad" readonly>
          </div>
          <div class="form-group mitad">
            <label>Estado</label>
            <input type="text" id="ver_estado" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Fecha de Creación</label>
            <input type="text" id="ver_fecha_creacion" readonly>
          </div>
          <div class="form-group">
            <label>Última Modificación</label>
            <input type="text" id="ver_fecha_actualizacion" readonly>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Editar Cliente -->
  <div id="modalEditarCliente" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close" onclick="document.getElementById('modalEditarCliente').style.display='none'">&times;</span>
        <h2>Editar Cliente</h2>
      </div>

      <form id="formEditarCliente">
        <div class="form-grid">
          <div>
            <label>ID Cliente</label>
            <input type="text" id="edit_id_cliente" readonly>
          </div>
          <div>
            <label>Nombre completo</label>
            <input type="text" id="edit_nombre" required>
          </div>
          <div>
            <label>Tipo de Cliente</label>
            <select id="edit_tipo_cliente">
              <option value="Natural">Natural</option>
              <option value="Jurídico">Jurídico</option>
            </select>
          </div>
          <div>
            <label>Tipo de Documento</label>
            <select id="edit_tipo_documento">
              <option value="CC">CC</option>
              <option value="NIT">NIT</option>
            </select>
          </div>
          <div>
            <label>Número de Documento</label>
            <input type="text" id="edit_numero_documento" required>
          </div>
          <div class="full">
            <label>Correo electrónico</label>
            <input type="email" id="edit_correo" required>
          </div>
          <div>
            <label>Celular</label>
            <input type="text" id="edit_celular">
          </div>
          <div>
            <label>Ciudad</label>
            <input type="text" id="edit_ciudad">
          </div>
          <div class="full">
            <label>Dirección</label>
            <input type="text" id="edit_direccion">
          </div>
          <div>
            <label>Estado</label>
            <select id="edit_estado">
              <option value="Activo">Activo</option>
              <option value="Inactivo">Inactivo</option>
            </select>
          </div>

          <button type="submit" class="btn-actualizar">Actualizar Cliente</button>
          <button type="button" class="btn-cancelar" onclick="document.getElementById('modalEditarCliente').style.display='none'">Cancelar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Eliminar Cliente -->
  <div id="modalConfirmarEliminar" class="modal" style="display:none;">
    <div class="modal-content modal-confirmar">
      <h2>¿Estás segura de eliminar este cliente?</h2>
      <p>Esta acción no se puede deshacer.</p>
      <div class="botones-confirmacion">
        <button id="btnConfirmarEliminar" class="btn-si">Sí, eliminar</button>
        <button id="btnCancelarEliminar" class="btn-no">No, cancelar</button>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script>
    // Activar DataTables
    $(document).ready(function () {
      $('.tabla-cliente').DataTable({
        pageLength: 4,
        lengthMenu: [[4, 8, 10], [4, 8, 10]],
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
      });
    });
  </script>

  <!-- Script ver cliente -->
  <script>
  function verDetallesCliente(id, nombre, tipoCliente, tipoDocumento, numeroDoc, correo, celular, direccion, ciudad, fechaCreacion, fechaModificacion, estado) {
    document.getElementById('ver_id_cliente').value = id;
    document.getElementById('ver_nombre').value = nombre;
    document.getElementById('ver_tipo_cliente').value = tipoCliente;
    document.getElementById('ver_tipo_documento').value = tipoDocumento;
    document.getElementById('ver_numero_documento').value = numeroDoc;
    document.getElementById('ver_correo').value = correo;
    document.getElementById('ver_celular').value = celular;
    document.getElementById('ver_direccion').value = direccion;
    document.getElementById('ver_ciudad').value = ciudad;

    document.getElementById('ver_fecha_creacion').value = formatearFecha(fechaCreacion);
    document.getElementById('ver_fecha_actualizacion').value = formatearFecha(fechaModificacion);
    document.getElementById('ver_estado').value = estado;
    document.getElementById('modalVerCliente').style.display = 'block';
  }

  function cerrarModalVer() {
    document.getElementById('modalVerCliente').style.display = 'none';
  }

  function formatearFecha(fecha) {
    if (!fecha) return '—';
    const f = new Date(fecha);
    return f.toLocaleDateString('es-CO', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  }
  </script>

  <!-- Script editar cliente -->
<script>
  function editarCliente(id_cliente) {
    document.getElementById('modalEditarCliente').style.display = 'block';

    fetch(`/clientes/${id_cliente}/data`, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest', 
        'Accept': 'application/json'
      }
    })
    .then(response => {
      if (!response.ok) throw new Error('Error al obtener datos del cliente.');
      return response.json();
    })
    .then(data => {
      document.getElementById('edit_id_cliente').value = data.id_cliente;
      document.getElementById('edit_nombre').value = data.nombre;
      document.getElementById('edit_tipo_cliente').value = data.tipo_cliente;
      document.getElementById('edit_tipo_documento').value = data.tipo_documento;
      document.getElementById('edit_numero_documento').value = data.numero_documento;
      document.getElementById('edit_correo').value = data.correo;
      document.getElementById('edit_celular').value = data.celular;
      document.getElementById('edit_direccion').value = data.direccion;
      document.getElementById('edit_ciudad').value = data.ciudad;
      document.getElementById('edit_estado').value = data.estado;
    })
    .catch(err => alert(err.message));
  }

  document.getElementById('formEditarCliente').addEventListener('submit', function(e) {
    e.preventDefault();

    const id_cliente = document.getElementById('edit_id_cliente').value;

    const campos = ['nombre', 'tipo_cliente', 'tipo_documento', 'numero_documento', 
                    'correo', 'celular', 'direccion', 'ciudad', 'estado'];
    const data = {};

    campos.forEach(campo => {
      const valor = document.getElementById(`edit_${campo}`).value;
      if (valor !== '') { 
        data[campo] = valor;
      }
    });

    data['_method'] = 'PUT';

    fetch(`/clientes/${id_cliente}`, {
      method: 'POST', 
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then(async res => {
      if (!res.ok) {
        let msg = 'Error al actualizar';
        try { 
          const j = await res.json(); 
          if(j.errors) {
            msg = Object.values(j.errors).flat().join('\n'); 
          } else if(j.message) {
            msg = j.message;
          }
        } catch {}
        throw new Error(msg);
      }
      return res.json();
    })
    .then(data => {
      alert(data.message || 'Cliente actualizado correctamente');
      document.getElementById('modalEditarCliente').style.display = 'none';
      location.reload(); 
    })
    .catch(err => alert(err.message));
  });

  window.addEventListener('click', function(e) {
    const modal = document.getElementById('modalEditarCliente');
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
</script>

  <!-- Script eliminar cliente -->
 <script>
document.addEventListener('DOMContentLoaded', function() {
    let clienteAEliminar = null;
    const modal = document.getElementById('modalConfirmarEliminar');
    const btnConfirm = document.getElementById('btnConfirmarEliminar');
    const btnCancel = document.getElementById('btnCancelarEliminar');

    window.abrirConfirmEliminar = function(id_cliente) {
        clienteAEliminar = id_cliente;
        modal.style.display = 'flex';
    };

    btnCancel.addEventListener('click', () => {
        modal.style.display = 'none';
        clienteAEliminar = null;
    });

    window.addEventListener('click', e => {
        if (e.target === modal) {
            modal.style.display = 'none';
            clienteAEliminar = null;
        }
    });

    btnConfirm.addEventListener('click', async function() {
        if (!clienteAEliminar) return;

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const res = await fetch(`/clientes/${clienteAEliminar}/eliminar`, {
                method: 'POST', 
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({}) 
            });

            let data;
            try {
                data = await res.json(); 
            } catch {
                throw new Error('Respuesta inesperada del servidor');
            }

            if (!res.ok) throw new Error(data.message || 'No se pudo eliminar el cliente');

            alert(data.message || 'Cliente eliminado correctamente');
            modal.style.display = 'none';
            location.reload(); 
        } catch (err) {
            alert(err.message || 'No se pudo eliminar el cliente.');
            modal.style.display = 'none';
        }
    });
});
</script>

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