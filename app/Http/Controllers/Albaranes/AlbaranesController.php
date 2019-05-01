<?php

namespace App\Http\Controllers\Albaranes;

use App\Albaran;
use App\Cliente;
use App\Laboratorio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AlbaranesController extends Controller
{
    /**
     * Crea una instancia del controlador de albaranes
     * comprobando antes la autenticación
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la ventana de albaranes
     * Con el listado de albaranes
     */
    public function mostrarAlbaranes()
    {
        // $albaranes = DB::table('albaran')->get();
        $albaranes = Albaran::all();

        return view('albaranes.albaranes', compact('albaranes'));
    }

    /**
     * Muestra la ventana de albaranes
     * Con el listado de albaranes
     */
    public function mostrarAlbaran(Albaran $albaran)
    {
        $clientes = array($albaran->cliente);
        return view('albaranes.albaran', compact('albaran', 'clientes'));
    }

    /**
     * Abre la ventana del albaran pero con un albaran nuevo con los atributos vacíos
     */
    public function mostrarAlbaranNuevo()
    {
        $albaran = new Albaran();
        $albaran->lab_id = Laboratorio::first()->lab_id; // AQUI EN VEZ DE COGER EL FIRST, COGER EL CORRESPONDIENTE AL USUARIO (o meterlo al principio en sesión y cogerlo ahora)
        $clientes = Cliente::all();
        return view('albaranes.albaran', compact('albaran', 'clientes'));
    }

    public function guardarAlbaran(Request $request)
    {
        $request->validate([
            'alb_numero' => 'required', 
            'cli_id' => 'required', 
            'lab_id' => 'required',
            'alb_fecha_emision' => 'nullable',
            'alb_fecha_entrega' => 'nullable',
            'fac_id' => 'nullable'
        ]);

        Albaran::create($request->all());
        Session::flash('confirmacion','Se ha guardado correctamente');

        return redirect('/albaranes');
    }

    public function editarAlbaran(Request $request, Albaran $albaran)
    {
        $request->validate([
            'alb_numero' => 'required', 
            'cli_id' => 'required', 
            'lab_id' => 'required',
            'alb_fecha_emision' => 'nullable',
            'alb_fecha_entrega' => 'nullable',
            'fac_id' => 'nullable'
        ]);

        $albaran->update($request->all());

        Session::flash('confirmacion','Se ha editado correctamente');
        return redirect('/albaranes');
    }
}
