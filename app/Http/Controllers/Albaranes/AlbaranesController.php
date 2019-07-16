<?php

namespace App\Http\Controllers\Albaranes;

use App\Albaran;
use App\Cliente;
use App\Trabajo;
use App\UsuarioLaboratorio;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Controller;

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
        $albaranes = Albaran::orderBy('alb_id', 'desc')->paginate(6);
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
        if($usuarioId == null) {
            Auth::logout();
            return Redirect::route('home');
        }
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
            'fac_id' => 'nullable',
            'alb_profesor' => 'nullable',
            'alb_paciente' => 'nullable'
        ]);

        $proximoNumAlbaran = DB::table('albaran')->max('alb_numero') + 1;
        if($proximoNumAlbaran == null)
            $proximoNumAlbaran = 1;
        $request->merge(['alb_numero' => $proximoNumAlbaran]);
        $newAlbaran = Albaran::create($request->all());
        Session::flash('confirmacion','Se ha creado el nuevo albarán ' . $request->get('alb_numero'));

        //return redirect('/albaranes');
        return $this->mostrarAlbaran($newAlbaran);
    }

    public function editarAlbaran(Request $request, Albaran $albaran)
    {
        $request->validate([
            'alb_numero' => 'required', 
            'cli_id' => 'required', 
            'lab_id' => 'required',
            'alb_fecha_emision' => 'nullable',
            'alb_fecha_entrega' => 'nullable',
            'fac_id' => 'nullable',
            'alb_profesor' => 'nullable',
            'alb_paciente' => 'nullable'
        ]);

        $albaran->update($request->all());

        Session::flash('confirmacion','Se ha editado correctamente el albarán ' . $albaran->alb_numero);
        return redirect('/albaranes');
    }

    /**
     * Emitir albarán
     */
    public function imprimirAlbaran(Albaran $albaran)
    {
        if(!isset($albaran->alb_fecha_emision)) {
            // Si no se ha emitido se emite.
            $albaran->alb_fecha_emision = Carbon::now();
            $albaran->save();
            return $this->mostrarAlbaran($albaran);
        } else {
            $pdf = PDF::loadView('albaranes.pdf', compact('albaran'));
            // // ESTO LO DESCARGA:
            // //return $pdf->download('albaran-'.$albaran->alb_numero.'.pdf');
            // // Y ESTO LO SACA EN OTRA PESTAÑA
            return $pdf->stream('albaran-'.$albaran->alb_numero.'.pdf', array("Attachment" => false));
        }
    }

    /**
     * Se mira si pertenece a alguna factura
     * - Si esta facturado no lo deberíamos poder borrar
     * - Sino se borra (BORRANDO ANTES LOS TRABAJOS ASOCIADOS)
     */
    public function eliminarAlbaran(Albaran $albaran){
        $idFactura = $albaran->fac_id;
        $trabajos = Trabajo::where('alb_id', $albaran->alb_id)->get();
        $numeroAlbaran = $albaran->alb_numero;

        if($idFactura == null){
            foreach ($trabajos as $trabajo) {
                $trabajo->delete();
            }
            $albaran->delete();
        } else {
            foreach ($trabajos as $trabajo) {
                $trabajo->delete();
            }
            $albaran->delete();
            // $albaran->alb_borrado = 'S';
            // $albaran->save();
        }

        Session::flash('confirmacion','El albarán '.$numeroAlbaran.' ha sido eliminado correctamente');
        return redirect('/albaranes');
    }

}
