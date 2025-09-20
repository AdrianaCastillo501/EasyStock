<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Formulario de olvido de contraseña
Route::get('/password/forgot', [AuthController::class, 'showForgotForm'])->name('password.forgot');

// Procesar formulario de recuperación
Route::post('/password/forgot', [AuthController::class, 'sendResetLink'])->name('password.email');

