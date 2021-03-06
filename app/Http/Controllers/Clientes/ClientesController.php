<?php

namespace App\Http\Controllers\Clientes;

use App\Albaran;
use App\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientesController extends Controller
{
    /**
     * Crea una instancia del controlador de clientes
     * comprobando antes la autenticación
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la ventana de clientes
     * Con el listado de clientes
     */
    public function mostrarClientes()
    {
        $clientes = Cliente::orderBy('cli_id', 'desc')->paginate(6);

        return view('clientes.clientes', compact('clientes'));
    }

    /**
     * Muestra la ventana de clientes
     * Con el listado de clientes
     */
    public function mostrarCliente(Cliente $cliente)
    {
        return view('clientes.cliente', compact('cliente'));
    }

    /**
     * Abre la ventana del cliente pero con un cliente nuevo con los atributos vacíos
     */
    public function mostrarClienteNuevo()
    {
        $cliente = new Cliente();
        return view('clientes.cliente', compact('cliente'));
    }

    public function guardarCliente(Request $request)
    {
        $request->validate([
            'cli_nif' => 'required|max:9', 
            'cli_nombre' => 'required', 
            'cli_nombre_corto' => 'required', 
            'cli_cod_pos' => 'required',
            'cli_ciudad' => 'required',
            'cli_municipio' => 'nullable',
            'cli_direccion' => 'required'
        ]);

        Cliente::create($request->all());
        Session::flash('confirmacion','Se ha guardado correctamente');

        return redirect('/clientes');
    }

    public function editarCliente(Request $request, Cliente $cliente)
    {
        $request->validate([
            'cli_nif' => 'required|max:9', 
            'cli_nombre' => 'required', 
            'cli_nombre_corto' => 'required', 
            'cli_cod_pos' => 'required',
            'cli_ciudad' => 'required',
            'cli_municipio' => 'nullable',
            'cli_direccion' => 'required'
        ]);

        $cliente->update($request->all());

        Session::flash('confirmacion','Se ha editado correctamente');
        return redirect('/clientes');
    }

    /**
     * Se mira si tiene alguna factura 
     * - Si esta en alguna, no lo deberíamos poder borrar
     * - Sino se borra (BORRANDO ANTES LOS TRABAJOS ASOCIADOS)
     */
    public function eliminarCliente(Cliente $cliente){
        $albaranesDondeAparece = Albaran::where('cli_id', $cliente->cli_id)->get();
        $nombreCliente = $cliente->cli_nombre_corto;

        if(sizeof($albaranesDondeAparece) == 0) {
            $cliente->delete();
            Session::flash('confirmacion','El cliente '.$nombreCliente.' ha sido eliminado correctamente');
            return redirect('/clientes');
        } else {
            Session::flash('error','No se puede eliminar un cliente si tiene albaranes');
            return $this->mostrarClientes();
        }
    }

}
