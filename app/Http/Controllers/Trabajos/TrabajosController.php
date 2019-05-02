<?php

namespace App\Http\Controllers\Trabajos;

use App\Trabajo;
use App\Cliente;
use App\Laboratorio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TrabajosController extends Controller
{
    /**
     * Crea una instancia del controlador de trabajos
     * comprobando antes la autenticación
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la ventana de trabajos
     * Con el listado de trabajos
     */
    public function mostrarTrabajo(Trabajo $trabajo)
    {
        $clientes = array($trabajo->cliente);
        return view('trabajos.trabajo', compact('trabajo', 'clientes'));
    }

    /**
     * Abre la ventana del trabajo pero con un trabajo nuevo con los atributos vacíos
     */
    public function mostrarTrabajoNuevo()
    {
        $trabajo = new Trabajo();
        $trabajo->lab_id = Laboratorio::first()->lab_id; // AQUI EN VEZ DE COGER EL FIRST, COGER EL CORRESPONDIENTE AL USUARIO (o meterlo al principio en sesión y cogerlo ahora)
        $clientes = Cliente::all();
        return view('trabajos.trabajo', compact('trabajo', 'clientes'));
    }

    public function guardarTrabajo(Request $request)
    {
        $request->validate([
            'tra_numero' => 'required', 
            'cli_id' => 'required', 
            'lab_id' => 'required',
            'tra_fecha_emision' => 'nullable',
            'tra_fecha_entrega' => 'nullable',
            'fac_id' => 'nullable'
        ]);

        Trabajo::create($request->all());
        Session::flash('confirmacion','Se ha guardado correctamente');

        return redirect()->back();
    }

    public function editarTrabajo(Request $request, Trabajo $trabajo)
    {
        $request->validate([
            'tra_numero' => 'required', 
            'cli_id' => 'required', 
            'lab_id' => 'required',
            'tra_fecha_emision' => 'nullable',
            'tra_fecha_entrega' => 'nullable',
            'fac_id' => 'nullable'
        ]);

        $trabajo->update($request->all());

        Session::flash('confirmacion','Se ha editado correctamente');
        return redirect()->back();
    }

    public function eliminarTrabajo(Trabajo $trabajo){
        $trabajo->delete();
        Session::flash('confirmacion','Se ha eliminado correctamente');
    }
}
