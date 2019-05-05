<?php

namespace App\Http\Controllers\Albaranes;

use App\Albaran;
use App\Cliente;
use App\UsuarioLaboratorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function mostrarAlbaranNuevo(Request $request)
    {
        //Cojo el usuarioLaboratorio de la BD usando el id del usuario de la sesion
        $usuarioId = $request->session()->get('usuario');
        $usuarioLaboratorio = UsuarioLaboratorio::where('usu_id', $usuarioId) -> first();
        // Ahora creo el nuevo albarán con el laboratorio del usuario
        $albaran = new Albaran();
        $albaran->lab_id = $usuarioLaboratorio->lab_id;
        $clientes = Cliente::all();
        return view('albaranes.albaran', compact('albaran', 'clientes'));
    }

    public function guardarAlbaran(Request $request)
    {
        $request->validate([
            'alb_numero' => 'nullable', 
            'cli_id' => 'required', 
            'lab_id' => 'required',
            'alb_fecha_emision' => 'nullable',
            'alb_fecha_entrega' => 'nullable',
            'fac_id' => 'nullable'
        ]);

        $proximoNumAlbaran = DB::table('albaran')->max('alb_numero') + 1;
        if($proximoNumAlbaran == null)
            $proximoNumAlbaran = 1;
        $request->merge(['alb_numero' => $proximoNumAlbaran]);
        Albaran::create($request->all());
        Session::flash('confirmacion','Se ha creado el nuevo albarán ' . $request->get('alb_numero'));

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

        Session::flash('confirmacion','Se ha editado correctamente el albarán ' . $albaran->alb_numero);
        return redirect('/albaranes');
    }

    public function imprimirAlbaran(Albaran $albaran)
    {
        return 'Imprimir jeje';
    }
}
