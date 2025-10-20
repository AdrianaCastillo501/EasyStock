<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
    
    public function __construct()
    {
        
    }

    //  Mostrar la lista de clientes
    public function index()
{
    $clientes = Cliente::paginate(10);
    $totalClientes = Cliente::count();
    $clientesActivos = Cliente::where('estado', 'Activo')->count();

    $usuario_id = Session::get('id_usuario'); 
    $usuario = Usuario::find($usuario_id);    

    return view('clientes.gestion', compact('clientes', 'totalClientes', 'clientesActivos', 'usuario'));
}


    //  Formulario de registro de cliente
    public function registro()
{
    $ultimoCliente = Cliente::orderBy('id_cliente', 'desc')->first();
    $nuevoId = $ultimoCliente ? $ultimoCliente->id_cliente + 1 : 1;

    $usuario_id = Session::get('id_usuario');  
    $usuario = Usuario::find($usuario_id);     

    return view('clientes.registro', compact('nuevoId', 'usuario'));
}


    //  Guardar nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo_cliente' => 'required|string|max:50',
            'tipo_documento' => 'required|string|max:30',
            'numero_documento' => 'required|string|max:30|unique:clientes,numero_documento',
            'correo' => 'required|email|max:100',
            'celular' => 'nullable|string|max:30',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:100',
            'estado' => 'required|string|in:Activo,Inactivo',
        ]);

        Cliente::create($request->only([
            'nombre', 'tipo_cliente', 'tipo_documento', 'numero_documento',
            'correo', 'celular', 'direccion', 'ciudad', 'estado'
        ]));

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    //  Ver cliente
    public function show($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        return view('clientes.ver', compact('cliente'));
    }

    //  Obtener cliente en formato JSON
    public function getCliente($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        return response()->json($cliente);
    }

    //  Mostrar vista de edición
    public function edit($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        return view('clientes.editar', compact('cliente'));
    }

    //  Actualizar cliente
    public function update(Request $request, $id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo_cliente' => 'required|string|max:50',
            'tipo_documento' => 'required|string|max:30',
            'numero_documento' => 'required|string|max:30|unique:clientes,numero_documento,' . $id_cliente . ',id_cliente',
            'correo' => 'required|email|max:100',
            'celular' => 'nullable|string|max:30',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:100',
            'estado' => 'required|string|in:Activo,Inactivo',
        ]);

        $cliente->update($request->only([
            'nombre', 'tipo_cliente', 'tipo_documento', 'numero_documento',
            'correo', 'celular', 'direccion', 'ciudad', 'estado'
        ]));

        return response()->json(['message' => 'Cliente actualizado correctamente']);
    }

    //  Eliminar cliente
    public function destroy($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);

        try {
            $cliente->delete();
            return response()->json(['message' => 'Cliente eliminado correctamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'No se pudo eliminar el cliente, tiene registros asociados.'], 500);
        }
    }
}

