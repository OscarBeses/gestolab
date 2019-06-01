<?php

namespace App\Http\Controllers;

use App\Albaran;

class HomeController extends Controller
{
    /**
     * Crea una instancia de home sólo si el usuario está autenticado 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra el home de la aplicación
     */
    public function mostrarHome()
    {
        $albaranes = Albaran::whereNotNull('alb_fecha_entrega')->whereNull('fac_id')
                        ->orderBy('alb_fecha_entrega', 'asc')
                        ->paginate(3);
        return view('home', compact('albaranes'));
    }
}
