<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


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
