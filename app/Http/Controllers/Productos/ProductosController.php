<?php

namespace App\Http\Controllers\Productos;

use App\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    public function mostrarProductos()
    {
        // $productos = DB::table('producto')->get();
        $productos = Producto::orderBy('prd_id', 'desc')->paginate(3);

        return view('productos.productos', compact('productos'));
    }

    /**
     * Muestra la ventana de productos
     * Con el listado de productos
     */
    public function mostrarProducto(Producto $producto)
    {
        return view('productos.producto', compact('producto'));
    }

    /**
     * Abre la ventana del producto pero con un producto nuevo con los atributos vacíos
     */
    public function mostrarProductoNuevo()
    {
        $producto = new Producto();
        return view('productos.producto', compact('producto'));
    }

    public function guardarProducto(Request $request)
    {
            $request->validate([
                'prd_descripcion' => 'required',
                'prd_importe' => 'required',
                'prd_observaciones' => 'nullable'
            ]);
    
            Producto::create($request->all());
            Session::flash('confirmacion','Se ha guardado correctamente');
    
            return redirect('/productos');
    }

    public function editarProducto(Request $request, Producto $producto)
    {
        $request->validate([
            'prd_descripcion' => 'required',
            'prd_importe' => 'required',
            'prd_observaciones' => 'nullable'
        ]);

        $producto->update($request->all());

        Session::flash('confirmacion','Se ha editado correctamente');
        return redirect('/productos');
    }

}
