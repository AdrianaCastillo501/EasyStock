<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Registro
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Formulario de olvido de contraseña
Route::get('/password/forgot', [AuthController::class, 'showForgotForm'])->name('password.forgot');

// Procesar formulario de recuperación
Route::post('/password/forgot', [AuthController::class, 'sendResetLink'])->name('password.email');

// Mostrar formulario de actualización
Route::get('/dashboard/actualizar', [DashboardController::class, 'edit'])->name('actualizar.datos');

// Procesar actualización
Route::put('/dashboard/update', [DashboardController::class, 'update'])->name('dashboard.update');


// Mostrar la gestión de usuarios
Route::get('/usuarios', [DashboardController::class, 'usuarios'])->name('dashboard.usuarios');
// Eliminar usuario
Route::delete('/usuarios/{id}', [DashboardController::class, 'eliminarUsuario'])->name('usuarios.eliminar');
// Edición de usuarios
Route::get('/usuarios/editar/{id}', [DashboardController::class, 'editarUsuario'])->name('usuarios.editar');
Route::put('/usuarios/editar/{id}', [DashboardController::class, 'actualizarUsuario'])->name('usuarios.actualizar');

//Rutas para módulo de Clientes

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');

// Registrar nuevo cliente
Route::get('/clientes/registro', [ClienteController::class, 'registro'])->name('clientes.registro');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

// Obtener datos JSON (para modal editar)
Route::get('/clientes/{id_cliente}/data', [ClienteController::class, 'getCliente'])->name('clientes.data');

// Actualizar cliente (desde modal)
Route::put('/clientes/{id_cliente}', [ClienteController::class, 'update'])->name('clientes.update');

// Ver detalles (modal "ver cliente")
Route::post('/clientes/{id_cliente}/ver', [ClienteController::class, 'show'])->name('clientes.show');

// Eliminar cliente
Route::post('/clientes/{id_cliente}/eliminar', [ClienteController::class, 'destroy'])->name('clientes.eliminar');

//Proveedores

// Listado de proveedores
Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');

// Formulario para crear un nuevo proveedor
Route::get('/proveedores/crear', [ProveedorController::class, 'create'])->name('proveedores.create');

// Guardar proveedor
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');

// Eliminar proveedor
Route::delete('/proveedores/{id}', [App\Http\Controllers\ProveedorController::class, 'destroy'])
    ->name('proveedores.destroy');

    // Detalles del proveedor
Route::get('/proveedores/{id_proveedor}/detalle', [App\Http\Controllers\ProveedorController::class, 'show'])->name('proveedores.show');

// Mostrar datos del proveedor a editar
Route::get('/proveedores/{id_proveedor}/editar', [ProveedorController::class, 'edit'])->name('proveedores.edit');

// Actualizar proveedor
Route::put('/proveedores/{id_proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
