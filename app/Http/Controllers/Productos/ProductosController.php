<?php

namespace App\Http\Controllers\Productos;

use App\Trabajo;
use App\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * Con el listado de productos paginado
     */
    public function mostrarProductos()
    {
        $productos = Producto::where('prd_borrado', 'N')->orderBy('prd_id', 'desc')->paginate(6);
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
                'prd_importe' => 'required|numeric',
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

    /**
     * Se mira si existe en algún TrabajoDetalle que tenga el producto
     * - Si nadie lo usa, se borra.
     * - Si alguien lo usa, se marca como borrado pero no se borra.
     */
    public function eliminarProducto(Producto $producto){
        $idProducto = $producto->prd_id;
        
        $cantUsosProd = Trabajo::where('prd_id', $idProducto)->count();
        if($cantUsosProd == 0)
            $producto->delete();
        else {
            $producto->prd_borrado = 'S';
            $producto->save();
        }

        Session::flash('confirmacion','El producto ha sido eliminado correctamente');
        return redirect('/productos');
    }

}
