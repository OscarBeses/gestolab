<?php

namespace App\Http\Controllers\Facturas;

use App\Albaran;
use App\Factura;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FacturasController extends Controller
{
    /**
     * Crea una instancia del controlador de Facturas
     * comprobando antes la autenticación
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la ventana de Facturas
     * Con el listado de Facturas
     */
    public function mostrarFacturas()
    {
        $facturas = Factura::orderBy('fac_id', 'desc')->paginate(3);
        return view('facturas.facturas', compact('facturas'));
    }

    public function mostrarGeneradorFacturas()
    {
        $clientes = Cliente::all();
        return view('facturas.generador', compact('clientes'));
    }

    /**
     * Genera la factura con los albaranes correspondientes
     */
    public function generarFacturaNueva(Request $request)
    {
        // Cojo el cliente seleccionado
        $clienteId = $request->session()->get('cliente');
        // Se cojen los albaranes que agrupa la factura (albaranes del cliente pasado y que tengan fecha de emision pero no fac_id)
        $albaranes = Albaran::whereNotNull('alb_fecha_emision')
                        ->whereNull('fac_id')
                        ->where('alb_fecha_emision', '<=', Carbon::now())
                        ->where('cli_id', $clienteId)
                        ->orderBy('alb_id', 'desc')
                        ->get();

        $proxNumFactura = DB::table('albaran')->max('alb_numero') + 1;
        if($proxNumFactura == null)
            $proxNumFactura = 1;

        // Guardo la nueva factura
        $factura = new Factura();
        $factura->fac_numero = $proxNumFactura;
        $factura->fac_fecha_emision = Carbon::now();
        $factura->save();

        // Se actualiza la factura de todos los albaranes incluidos
        foreach ($albaranes as $albaran){
            $albaran->fac_id = $factura->fac_id;
            $albaran->save();
        }

        Session::flash('confirmacion','Se ha creado la nueva factura ' . $proxNumFactura);
        return redirect('/facturas');
    }

    /**
     * Emitir factura
     */
    public function imprimirFactura(Factura $factura)
    {
        $albaranes = $factura->albaranes;
        $primerAlbaran = $albaranes->get(0);
        $cliente = $primerAlbaran->cliente;
        $laboratorio = $primerAlbaran->laboratorio;
        
        $pdf = PDF::loadView('facturas.pdf', compact('factura', 'cliente', 'laboratorio', 'albaranes'));
        // Y ESTO LO SACA EN OTRA PESTAÑA
        return $pdf->stream('factura-'.$factura->fac_numero.'.pdf', array("Attachment" => false));
    }
}
