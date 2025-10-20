@extends('layouts.app')

@section('title', 'Proveedores')


@section('content')
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

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
                <tr data-id="{{ $proveedor->id_proveedor }}">
                    <td>{{ $proveedor->nombre_empresa }}</td>
                    <td>{{ $proveedor->numero_identificacion }}</td>
                    <td>{{ $proveedor->nombre_contacto }}</td>
                    <td>{{ $proveedor->telefono_contacto }}</td>
                    <td>{{ $proveedor->tiempoRelacion() }}</td>
                    <td>
                        <div class="acciones">
                            <button class="btn-ver" title="Ver">🔍</button>
                            <button class="btn-editar" title="Editar">🖊</button>
                            <form action="{{ route('proveedores.destroy', $proveedor->id_proveedor) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-cancelar" title="Eliminar"
                                    onclick="return confirm('¿Seguro que deseas eliminar este proveedor?');">🗑</button>
                            </form>

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

<!-- Modal Detalle Proveedor -->
<div id="detalleModal">
    <div class="modal-contenido">
        <span class="close-btn">&times;</span>
        <h2>Detalle del Proveedor</h2>

        <div class="detalle-grid">
            <div class="detalle-item"><strong>Nombre Empresa:</strong> <span id="detalle-nombre_empresa"></span></div>
            <div class="detalle-item"><strong>Número Identificación:</strong> <span id="detalle-numero_identificacion"></span></div>
            <div class="detalle-item"><strong>Nombre Contacto:</strong> <span id="detalle-nombre_contacto"></span></div>
            <div class="detalle-item"><strong>Teléfono Contacto:</strong> <span id="detalle-telefono_contacto"></span></div>
            <div class="detalle-item"><strong>Email Contacto:</strong> <span id="detalle-email_contacto"></span></div>
            <div class="detalle-item"><strong>Dirección:</strong> <span id="detalle-direccion"></span></div>
            <div class="detalle-item"><strong>Ciudad:</strong> <span id="detalle-ciudad"></span></div>
            <div class="detalle-item"><strong>Tipo Proveedor:</strong> <span id="detalle-tipo_proveedor"></span></div>
            <div class="detalle-item"><strong>Condiciones de Pago:</strong> <span id="detalle-condiciones_pago"></span></div>
            <div class="detalle-item"><strong>Fecha Creación:</strong> <span id="detalle-fecha_creacion"></span></div>
            <div class="detalle-item"><strong>Última Actualización:</strong> <span id="detalle-ultima_actualizacion"></span></div>
        </div>
    </div>
</div>

<!-- === MODAL EDITAR PROVEEDOR === -->
<div id="editarModal">
    <div class="modal-contenido">
        <span class="close-btn" id="closeEditar">&times;</span>
        <h2>Editar Proveedor</h2>

        <form id="editarForm">
            @csrf
            @method('PUT')

            <div class="detalle-grid">
                <div class="detalle-item">
                    <strong>Nombre Empresa:</strong>
                    <input type="text" name="nombre_empresa" id="edit-nombre_empresa">
                </div>
                <div class="detalle-item">
                    <strong>Número Identificación:</strong>
                    <input type="text" name="numero_identificacion" id="edit-numero_identificacion">
                </div>
                <div class="detalle-item">
                    <strong>Nombre Contacto:</strong>
                    <input type="text" name="nombre_contacto" id="edit-nombre_contacto">
                </div>
                <div class="detalle-item">
                    <strong>Teléfono Contacto:</strong>
                    <input type="text" name="telefono_contacto" id="edit-telefono_contacto">
                </div>
                <div class="detalle-item">
                    <strong>Email Contacto:</strong>
                    <input type="email" name="email_contacto" id="edit-email_contacto">
                </div>
                <div class="detalle-item">
                    <strong>Dirección:</strong>
                    <input type="text" name="direccion" id="edit-direccion">
                </div>
                <div class="detalle-item">
                    <strong>Ciudad:</strong>
                    <input type="text" name="ciudad" id="edit-ciudad">
                </div>
                <div class="detalle-item">
                    <strong>Tipo Proveedor:</strong>
                    <select name="tipo_proveedor" id="edit-tipo_proveedor">
                        <option value="">-- Seleccione tipo --</option>
                        <option value="Minorista">Minorista</option>
                        <option value="Mayorista">Mayorista</option>
                        <option value="Servicios">Servicios</option>
                    </select>
                </div>
                <div class="detalle-item">
                    <strong>Condiciones de Pago:</strong>
                    <select name="condiciones_pago" id="edit-condiciones_pago">
                        <option value="">-- Seleccione condición --</option>
                        <option value="Contado">Contado</option>
                        <option value="Crédito 15 días">Crédito 15 días</option>
                        <option value="Crédito 30 días">Crédito 30 días</option>
                        <option value="Crédito 60 días">Crédito 60 días</option>
                    </select>
                </div>
            </div>

            <div class="botones-modal">
                <button type="submit" class="btn-guardar">Guardar cambios</button>
                <button type="button" id="cancelarEditar" class="btn-cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</div>


@endsection

@push('scripts')
<script>
$(document).ready(function () {
    // Inicializar DataTable (solo si no está ya inicializado)
    if (!$.fn.DataTable.isDataTable('.tabla-proveedor')) {
        $('.tabla-proveedor').DataTable({
            pageLength: 10,
            lengthMenu: [[10, 20, 30], [10, 20, 30]],
            language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' }
        });
    }

    // === MODAL DETALLE ===
    const modal = document.getElementById('detalleModal');
    const closeBtn = document.querySelector('.close-btn');

    closeBtn.onclick = () => modal.style.display = "none";
    window.onclick = e => { if (e.target == modal) modal.style.display = "none"; };

    // Cuando se haga clic en el botón "Ver"
    $('.btn-ver').on('click', function () {
        const id = $(this).closest('tr').data('id');

        $.ajax({
            url: `/proveedores/${id}/detalle`,
            method: 'GET',
            success: function (data) {
                // Llenar el modal con los datos del proveedor
                $('#detalle-nombre_empresa').text(data.nombre_empresa);
                $('#detalle-numero_identificacion').text(data.numero_identificacion);
                $('#detalle-nombre_contacto').text(data.nombre_contacto);
                $('#detalle-telefono_contacto').text(data.telefono_contacto);
                $('#detalle-email_contacto').text(data.email_contacto);
                $('#detalle-direccion').text(data.direccion);
                $('#detalle-ciudad').text(data.ciudad);
                $('#detalle-tipo_proveedor').text(data.tipo_proveedor);
                $('#detalle-condiciones_pago').text(data.condiciones_pago);
                $('#detalle-fecha_creacion').text(data.fecha_creacion);
                $('#detalle-ultima_actualizacion').text(data.ultima_actualizacion);

                modal.style.display = "flex";
            },
            error: function () {
                alert("Error al obtener los detalles del proveedor.");
            }
        });
    });
});

// === MODAL EDITAR ===
const modalEditar = document.getElementById('editarModal');
const closeEditar = document.getElementById('closeEditar');
const cancelarEditar = document.getElementById('cancelarEditar');
let proveedorEditId = null;

closeEditar.onclick = () => modalEditar.style.display = "none";
cancelarEditar.onclick = () => modalEditar.style.display = "none";
window.onclick = e => { if (e.target == modalEditar) modalEditar.style.display = "none"; };

// Abrir modal con datos
$('.btn-editar').on('click', function () {
    const id = $(this).closest('tr').data('id');
    proveedorEditId = id;

    $.ajax({
        url: `/proveedores/${id}/editar`,
        method: 'GET',
        success: function (data) {
            $('#edit-nombre_empresa').val(data.nombre_empresa);
            $('#edit-numero_identificacion').val(data.numero_identificacion);
            $('#edit-nombre_contacto').val(data.nombre_contacto);
            $('#edit-telefono_contacto').val(data.telefono_contacto);
            $('#edit-email_contacto').val(data.email_contacto);
            $('#edit-direccion').val(data.direccion);
            $('#edit-ciudad').val(data.ciudad);
            $('#edit-tipo_proveedor').val(data.tipo_proveedor);
            $('#edit-condiciones_pago').val(data.condiciones_pago);

            modalEditar.style.display = "flex";
        },
        error: function () {
            alert("Error al obtener los datos del proveedor para editar.");
        }
    });
});

// Guardar cambios
$('#editarForm').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: `/proveedores/${proveedorEditId}`,
        method: 'PUT',
        data: $(this).serialize(),
        success: function (response) {
            if (response.success) {
                alert("Proveedor actualizado correctamente.");
                location.reload(); // refresca la tabla
            }
        },
        error: function () {
            alert("Error al actualizar el proveedor.");
        }
    });
});

</script>
@endpush
