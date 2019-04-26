<?php

namespace App\Http\Controllers\Albaranes;

use App\Albaran;
use Illuminate\Support\Facades\DB;
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
    public function indexAlbaranes()
    {
        // $albaranes = DB::table('albaran')->get();
        $albaranes = Albaran::all();

        return view('albaranes.albaranes', compact('albaranes'));
    }

    /**
     * Muestra la ventana de albaranes
     * Con el listado de albaranes
     */
    public function indexAlbaranDetalle(Albaran $albaran)
    {
        // Al usar findOrFail en lugar de solo find se redirigirá al blade de error si se diera alguno
        // Aunque ni siquiera hace falta hacerlo
        // $albaran = Albaran::findOrFail($id);

        return view('albaranes.albaran', compact('albaran'));
    }
}
