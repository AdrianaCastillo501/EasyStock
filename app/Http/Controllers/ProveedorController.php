<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Usuario;

class ProveedorController extends Controller
{
    // Mostrar la lista de proveedores
    public function index()
    {
        $usuario = Usuario::find(session('id_usuario'));
        $proveedores = Proveedor::all();
        return view('proveedores.gestionproveedores', compact('proveedores', 'usuario'));
    }

    // Mostrar el formulario para crear un nuevo proveedor
public function create()
{
    $usuario = \App\Models\Usuario::find(session('id_usuario'));
    return view('proveedores.registroproveedores', compact('usuario'));
}


    // Guardar un nuevo proveedor en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_contacto' => 'required|string|max:255',
            'nombre_empresa' => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:50',
            'telefono_contacto' => 'required|string|max:20',
            'email_contacto' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:100',
            'tipo_proveedor' => 'required|string|max:50',
            'condiciones_pago' => 'nullable|string|max:50',
        ]);

        $proveedor = new Proveedor();
        $proveedor->nombre_contacto = $request->nombre_contacto;
        $proveedor->nombre_empresa = $request->nombre_empresa;
        $proveedor->numero_identificacion = $request->numero_identificacion;
        $proveedor->telefono_contacto = $request->telefono_contacto;
        $proveedor->email_contacto = $request->email_contacto;
        $proveedor->direccion = $request->direccion;
        $proveedor->ciudad = $request->ciudad;
        $proveedor->tipo_proveedor = $request->tipo_proveedor;
        $proveedor->condiciones_pago = $request->condiciones_pago;
        $proveedor->save();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado correctamente.');
    }

    public function destroy($id_proveedor)
    {
        $proveedor = Proveedor::findOrFail($id_proveedor);
        $proveedor->delete();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }

    public function edit($id_proveedor)
    {
        $proveedor = Proveedor::findOrFail($id_proveedor);
        return response()->json($proveedor);
    }

    public function update(Request $request, $id_proveedor)
    {
        $proveedor = Proveedor::findOrFail($id_proveedor);
        $proveedor->update($request->all());
        return response()->json(['success' => true]);
    }

    public function show($id_proveedor)
    {
        $proveedor = Proveedor::findOrFail($id_proveedor);
        return response()->json($proveedor);
    }
}
