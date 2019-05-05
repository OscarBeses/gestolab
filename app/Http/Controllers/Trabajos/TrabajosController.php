<?php

namespace App\Http\Controllers\Trabajos;

use App\Albaran;
use App\Trabajo;
use App\Producto;
use App\TecnicoTrabajo;
use App\TrabajoDetalle;
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
        $productos = array($trabajo->producto);
        return view('albaranes.trabajo', compact('trabajo', 'productos'));
    }

    /**
     * Abre la ventana del trabajo pero con un trabajo nuevo con los atributos vacíos
     * y pasandole el listado de productos disponibles
     */
    public function mostrarTrabajoNuevo(Request $request, Albaran $albaran)
    {
        $trabajo = new Trabajo();
        $trabajo->alb_id = $albaran->alb_id;

        $productos = Producto::all();
        return view('albaranes.trabajo', compact('trabajo', 'productos'));
    }

    public function guardarTrabajo(Request $request)
    {
        $request->validate([
            'tra_observaciones' => 'nullable', 
            'tra_cantidad' => 'required',
            'tra_precio_unidad' => 'required',
            'prd_id' => 'required',
            'alb_id' => 'required'
        ]);

        Trabajo::create($request->all());
        Session::flash('confirmacion','Se ha creado correctamente');

        return redirect()->route('albaran', $request->get('alb_id'));
    }

    public function editarTrabajo(Request $request, Trabajo $trabajo)
    {
        $request->validate([
            'tra_observaciones' => 'nullable', 
            'tra_cantidad' => 'required',
            'tra_precio_unidad' => 'required',
            'prd_id' => 'required',
            'alb_id' => 'required'
        ]);

        $trabajo->update($request->all());

        Session::flash('confirmacion','El trabajo ha sido editado correctamente');
        return redirect()->route('albaran', $trabajo->alb_id);
    }

    /**
     * Primero se eliminan los tecnico_trabajo
     * Luego los trabajo_detalle
     * y luego el trabajo
     */
    public function eliminarTrabajo(Trabajo $trabajo){
        $idTrabajo = $trabajo->tra_id;
        $idAlbaran = $trabajo->alb_id;

        $trabajoDetalle = TrabajoDetalle::where('tra_id', $idTrabajo)->first();
        if($trabajoDetalle != null)
            $trabajoDetalle->delete();
        
        $tecnicosTrabajo = TecnicoTrabajo::where('tra_id', $idTrabajo)->get();
        foreach ($tecnicosTrabajo as $tecnicoTrabajo ) {
            $tecnicoTrabajo->delete();
        }

        $trabajo->delete();

        Session::flash('confirmacion','El trabajo ha sido eliminado correctamente');
        return redirect()->route('albaran', $idAlbaran);
    }
}
