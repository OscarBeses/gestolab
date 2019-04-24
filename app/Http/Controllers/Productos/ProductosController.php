<?php

namespace App\Http\Controllers\Productos;

use App\Producto;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductosController extends Controller
{
    /**
     * Crea una instancia del controlador de productos
     * comprobando antes la autenticación
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la ventana de productos
     * Con el listado de productos
     */
    public function indexProductos()
    {
        // $productos = DB::table('producto')->get();
        $productos = Producto::all();

        return view('productos.productos', compact('productos'));
    }

    /**
     * Muestra la ventana de productos
     * Con el listado de productos
     */
    public function indexProductoDetalle(Producto $producto)
    {
        // Al usar findOrFail en lugar de solo find se redirigirá al blade de error si se diera alguno
        // Aunque ni siquiera hace falta hacerlo
        // $producto = Producto::findOrFail($id);

        return view('productos.producto', compact('producto'));
    }
}
