@extends('layouts.app')

@section('title', 'Registrar Proveedor')

@push('styles')
<link rel="stylesheet" href="{{ asset('Styles/registroproveedor.css') }}">
@endpush


@section('content')
<section class="registro-proveedor">

    <div class="registro">
        <h4><i class="fas fa-file-invoice"></i> Registro de Proveedor</h4>
    </div>

    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf

        <fieldset class="grupo-campo">
            <legend><i class="fas fa-user"></i> Datos del Proveedor</legend>

            <div class="form-container">
                <div class="form-grupo">
                    <label for="nombre_contacto"><i class="fas fa-user"></i> Nombre contacto:</label>
                    <input type="text" id="nombre_contacto" name="nombre_contacto" value="{{ old('nombre_contacto') }}" required>
                </div>

                <div class="form-grupo">
                    <label for="nombre_empresa"><i class="fas fa-building"></i> Empresa:</label>
                    <input type="text" id="nombre_empresa" name="nombre_empresa" value="{{ old('nombre_empresa') }}" required>
                </div>

                <div class="form-grupo">
                    <label for="numero_identificacion"><i class="fas fa-id-card"></i> NIT:</label>
                    <input type="text" id="numero_identificacion" name="numero_identificacion" value="{{ old('numero_identificacion') }}" required>
                </div>

                <div class="form-grupo">
                    <label for="telefono_contacto"><i class="fas fa-phone"></i> Teléfono:</label>
                    <input type="tel" id="telefono_contacto" name="telefono_contacto" value="{{ old('telefono_contacto') }}" required>
                </div>

                <div class="form-grupo">
                    <label for="email_contacto"><i class="fas fa-envelope"></i> Correo electrónico:</label>
                    <input type="email" id="email_contacto" name="email_contacto" value="{{ old('email_contacto') }}">
                </div>

                <div class="form-grupo">
                    <label for="direccion"><i class="fas fa-map-marker-alt"></i> Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}">
                </div>

                <div class="form-grupo">
                    <label for="ciudad"><i class="fas fa-city"></i> Ciudad:</label>
                    <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad') }}">
                </div>

                <div class="form-grupo">
                    <label for="tipo_proveedor"><i class="fas fa-list-alt"></i> Tipo de proveedor:</label>
                    <select id="tipo_proveedor" name="tipo_proveedor" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Mayorista" {{ old('tipo_proveedor') == 'Mayorista' ? 'selected' : '' }}>Mayorista</option>
                        <option value="Minorista" {{ old('tipo_proveedor') == 'Minorista' ? 'selected' : '' }}>Minorista</option>
                        <option value="Servicios" {{ old('tipo_proveedor') == 'Servicios' ? 'selected' : '' }}>Servicios</option>
                    </select>
                </div>

                <div class="form-grupo">
                    <label for="condiciones_pago"><i class="fas fa-file-invoice-dollar"></i> Condiciones de pago:</label>
                    <select id="condiciones_pago" name="condiciones_pago">
                        <option value="">Seleccione una opción</option>
                        <option value="contado" {{ old('condiciones_pago') == 'contado' ? 'selected' : '' }}>Contado</option>
                        <option value="credito" {{ old('condiciones_pago') == 'credito' ? 'selected' : '' }}>Crédito</option>
                        <option value="otros" {{ old('condiciones_pago') == 'otros' ? 'selected' : '' }}>Otros</option>
                    </select>
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-guardar">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('proveedores.index') }}" class="btn-cancelar">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </fieldset>
    </form>
</section>
@endsection
