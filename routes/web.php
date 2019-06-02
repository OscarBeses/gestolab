<?php

use App\Producto;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
|
| Aquí es donde puede registrar rutas web para su aplicación. 
| RouteServiceProvider carga estas rutas dentro de un grupo que 
| contiene el grupo de middleware "web". Ahora crea algo genial!
|
*/

/*
|--------------------------------------------------------------------------
| RUTAS GENERADAS AUTOMATICAMENTE (con make:auth)
|--------------------------------------------------------------------------
*/
// Rutas de login y logout...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Rutas de registro que borraré o haré que solo pueda hacer registros alguien registrado...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// Ruta de resetear password...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
// Ruta de verificación de email...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
// Ruta de home que aparece cuando se hace login
Route::get('/home', 'HomeController@mostrarHome');

/*
|--------------------------------------------------------------------------
| RUTAS GENERADAS POR MI
|--------------------------------------------------------------------------
*/
/**
 * Ruta principal en la que solo compruebo si se tiene la sesión iniciada:
 *  - NO: Devuelve la ventana de welcome
 *  - SI: Entra directamente a home
 */ 
Route::get('/', function () {
    if(Auth::check())
        return redirect('/home');
    else
        return view('welcome');
})->name('welcome');
// Ruta clientes y clientes/cli_id
Route::get('/clientes', 'Clientes\ClientesController@mostrarClientes')->name('clientes');// Muestra la vista con los clientes
Route::get('/clientes/nuevo', 'Clientes\ClientesController@mostrarClienteNuevo');// Muestra la vista para crear uno nuevo
Route::put('/clientes/nuevo', 'Clientes\ClientesController@guardarCliente')->name('cliente.guardar');// Guarda el nuevo cliente
Route::get('/clientes/{cliente}', 'Clientes\ClientesController@mostrarCliente')->name('cliente');// Muestra el detalle de un cliente
Route::post('/clientes/{cliente}/editar', 'Clientes\ClientesController@editarCliente')->name('cliente.editar');// Edita el cliente

// Ruta para productos y productos/prd_id
Route::get('/productos', 'Productos\ProductosController@mostrarProductos')->name('productos');// Muestra los productos
Route::get('/productos/nuevo', 'Productos\ProductosController@mostrarProductoNuevo');// Muestra la vista para crear uno nuevo
Route::put('/productos/nuevo', 'Productos\ProductosController@guardarProducto')->name('producto.guardar');// Guarda el nuevo producto
Route::get('/productos/{producto}', 'Productos\ProductosController@mostrarProducto')->name('producto');// Muestra el detalle del producto
Route::post('/productos/{producto}/editar', 'Productos\ProductosController@editarProducto')->name('producto.editar');// Edita el producto
Route::post('/productos/{producto}/eliminar', 'Productos\ProductosController@eliminarProducto')->name('producto.eliminar');

// Ruta para albaranes y albaranes/prod_id
Route::get('/albaranes', 'Albaranes\AlbaranesController@mostrarAlbaranes')->name('albaranes');// Muestra los albaranes
Route::get('/albaranes/nuevo', 'Albaranes\AlbaranesController@mostrarAlbaranNuevo');// Muestra la vista para crear uno nuevo
Route::put('/albaranes/nuevo', 'Albaranes\AlbaranesController@guardarAlbaran')->name('albaran.guardar');// Guarda el nuevo albaran
Route::get('/albaranes/{albaran}', 'Albaranes\AlbaranesController@mostrarAlbaran')->name('albaran');// Muestra el detalle del albaran
Route::post('/albaranes/{albaran}/editar', 'Albaranes\AlbaranesController@editarAlbaran')->name('albaran.editar');// Edita el albaran
Route::get('/albaranes/{albaran}/imprimir', 'Albaranes\AlbaranesController@imprimirAlbaran')->name('albaran.imprimir');// Imprime el albaran
Route::post('/albaranes/{albaran}/eliminar', 'Albaranes\AlbaranesController@eliminarAlbaran')->name('albaran.eliminar');
//Ruta trabajos del albarán
Route::get('/albaranes/{albaran}/trabajos/nuevo', 'Trabajos\TrabajosController@mostrarTrabajoNuevo')->name('trabajo.nuevo');// Muestra la vista para crear uno nuevo
Route::put('/albaranes/trabajos/nuevo', 'Trabajos\TrabajosController@guardarTrabajo')->name('trabajo.guardar');// Guarda el nuevo trabajo
Route::get('/albaranes/trabajos/{trabajo}', 'Trabajos\TrabajosController@mostrarTrabajo')->name('trabajo');
Route::post('/albaranes/trabajos/{trabajo}/editar', 'Trabajos\TrabajosController@editarTrabajo')->name('trabajo.editar');
Route::post('/albaranes/trabajos/{trabajo}/eliminar', 'Trabajos\TrabajosController@eliminarTrabajo')->name('trabajo.eliminar');
Route::get('/ajax-damePrecioProd', function(){
    $prod_id = Input::get('prod_id');
    $producto = Producto::where('prd_id', $prod_id)->get();
    return Response::json($producto);
});

// Ruta para facturas
Route::get('/facturas', 'Facturas\FacturasController@mostrarFacturas')->name('facturas');
Route::get('/facturas/nueva', 'Facturas\FacturasController@mostrarGeneradorFacturas')->name('generador');
Route::put('/facturas/generar', 'Facturas\FacturasController@generarFacturaNueva')->name('generar');
Route::get('/facturas/{factura}/imprimir', 'Facturas\FacturasController@imprimirFactura')->name('factura.imprimir');