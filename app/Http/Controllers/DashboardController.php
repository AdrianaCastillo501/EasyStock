<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Session::has('id_usuario')) {
            return redirect()->route('login.form');
        }

        $usuario_id = Session::get('id_usuario');
        $usuario = Usuario::with('rol')->where('id_usuario', $usuario_id)->first();

        if (!$usuario) {
            Session::forget('id_usuario');
            return redirect()->route('login.form');
        }

        return view('dashboard', compact('usuario'));
    }
// Mostrar formulario de actualización de usuario
   public function edit() {
    $usuario = Usuario::with('rol')->find(Session::get('id_usuario'));
    return view('actualizar', compact('usuario'));
}

    // Procesar actualización de usuario
    public function update(Request $request) {
    $usuario = Usuario::find(Session::get('id_usuario'));

    $request->validate([
        'nombre' => 'required',
        'apellido' => 'required',
        'correo' => 'required|email',
        'id_rol' => 'required',
        'contrasena' => 'required',
    ]);

    $usuario->nombre = $request->nombre;
    $usuario->apellido = $request->apellido;
    $usuario->correo = $request->correo;
    $usuario->id_rol = $request->id_rol;
    $usuario->contrasena = $request->contrasena;
    $usuario->save();

    return redirect()->route('actualizar.datos')->with('success', 'Datos actualizados correctamente');
}

// Mostrar todos los usuarios
public function usuarios()
{
    $usuario_id = Session::get('id_usuario'); // obtiene el id del usuario logueado
    $usuario = Usuario::with('rol')->find($usuario_id); // trae info completa
    
    $usuarios = Usuario::all(); // todos los usuarios para la tabla
    
    return view('gestusuarios', compact('usuario', 'usuarios'));
}
public function editarUsuario($id)
{
    $usuario = Usuario::with('rol')->find($id);
    $usuarioSesion = Usuario::with('rol')->find(Session::get('id_usuario'));

    if (!$usuario) {
        return redirect()->route('dashboard.usuarios')->withErrors(['error' => 'Usuario no encontrado']);
    }

    return view('editarusuario', compact('usuario', 'usuarioSesion'));
}

public function actualizarUsuario(Request $request, $id)
{
    
    $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'correo' => 'required|email|max:150',
        'no_identificacion' => 'required|string|max:50',
        'id_rol' => 'required|integer',
        'estado' => 'required|string|max:50',
    ]);

    $usuario = Usuario::find($id);

    if (!$usuario) {
        return redirect()->route('dashboard.usuarios')->withErrors(['error' => 'Usuario no encontrado']);
    }

    $usuario->update([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'correo' => $request->correo,
        'no_identificacion' => $request->no_identificacion,
        'id_rol' => $request->id_rol,
        'estado' => $request->estado,
        'contrasena' => $request->contrasena ? $request->contrasena : $usuario->contrasena,
    ]);

    return redirect()->route('dashboard.usuarios')->with('success', '✅ Usuario actualizado correctamente');
}


// Eliminar usuario
public function eliminarUsuario($id)
{
    $usuario = Usuario::find($id);

    if (!$usuario) {
        return redirect()->route('dashboard.usuarios')->withErrors(['error' => 'Usuario no encontrado']);
    }

    $usuario->delete();

    return redirect()->route('dashboard.usuarios')->with('success', '✅ Usuario eliminado correctamente');
}


}
