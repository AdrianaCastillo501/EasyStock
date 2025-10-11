<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
         return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        //Validación simple
    $request->validate([
        'no_identificacion' => 'required',
        'contrasena' => 'required',
    ]);

    //Limpiar valores para evitar espacios extras
    $no_identificacion = trim($request->no_identificacion);
    $contrasena = trim($request->contrasena);

    //Buscar usuario exacto en la base de datos
    $usuario = Usuario::where('no_identificacion', $no_identificacion)
                      ->where('contrasena', $contrasena)
                      ->first();


   if (!$usuario) {
    return redirect()->route('login.form')
                     ->withErrors(['error' => 'Credenciales incorrectas'])
                     ->withInput();
}

    //Guardar ID del usuario en la sesión
    Session::put('id_usuario', $usuario->id_usuario);


    return redirect()->route('dashboard');
    }




    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('register'); // resources/views/register.blade.php
    }

    // Procesar registro de usuario
    public function register(Request $request)
    {
        // Validación
        $request->validate([
            'no_identificacion' => 'required|unique:usuarios,no_identificacion',
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email|unique:usuarios,correo',
            'id_rol' => 'required',
            'contrasena' => 'required',
        ]);

        // Guardar usuario en la base de datos
        DB::table('usuarios')->insert([
            'no_identificacion' => $request->no_identificacion,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'id_rol' => $request->id_rol,
            'contrasena' => $request->contrasena, // sin hash
            'estado' => 'activo',
            'fecha_creacion' => Carbon::now(),
            'ultima_actualizacion' => Carbon::now()
        ]);

        // Redirigir al login con mensaje de éxito
        return redirect()->route('login.form')->with('success', 'Usuario registrado correctamente');
    }
    // Mostrar formulario de "Olvidaste tu contraseña"
public function showForgotForm()
{
    return view('auth.olvide');
}

// Procesar formulario de recuperación
public function sendResetLink(Request $request)
{
    $request->validate([
        'no_identificacion' => 'required',
        'correo' => 'required|email',
    ]);

    // Verificar si el usuario existe
    $usuario = Usuario::where('no_identificacion', $request->no_identificacion)
                      ->where('correo', $request->correo)
                      ->first();

    if ($usuario) {
        // Por ahora solo mostramos un mensaje de éxito
        return back()->with('success', 'Se enviaron las instrucciones a tu correo.');
    } else {
        return back()->withErrors(['error' => 'No se encontró un usuario con esos datos'])->withInput();
    }
}
// Cerrar sesión
public function logout()
{
    // Eliminar la sesión del usuario
    Session::forget('id_usuario');

    // Redirigir al login con un mensaje opcional
    return redirect()->route('login.form')->with('success', 'Has cerrado sesión correctamente');
}

}

