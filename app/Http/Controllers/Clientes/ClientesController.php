<?php

namespace App\Http\Controllers\Clientes;

use App\Cliente;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ClientesController extends Controller
{
    /**
     * Crea una instancia del controlador de clientes
     * comprobando antes la autenticación
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la ventana de clientes
     * Con el listado de clientes
     */
    public function indexClientes()
    {
        // $clientes = DB::table('cliente')->get();
        $clientes = Cliente::all();

        return view('clientes.clientes', compact('clientes'));
    }

    /**
     * Muestra la ventana de clientes
     * Con el listado de clientes
     */
    public function indexClienteDetalle(Cliente $cliente)
    {
        // Al usar findOrFail en lugar de solo find se redirigirá al blade de error si se diera alguno
        // Aunque ni siquiera hace falta hacerlo
        // $cliente = Cliente::findOrFail($id);

        return view('clientes.cliente', compact('cliente'));
    }
}
