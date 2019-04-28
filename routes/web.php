<?php

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
Route::get('/clientes/nuevo', 'Clientes\ClientesController@crearCliente');// Muestra la vista para crear uno nuevo
Route::put('/clientes/nuevo', 'Clientes\ClientesController@guardarCliente')->name('cliente.guardar');// Guarda el nuevo cliente
Route::get('/clientes/{cliente}', 'Clientes\ClientesController@mostrarCliente')->name('cliente');// Muestra el detalle de un cliente
Route::post('/clientes/{cliente}/editar', 'Clientes\ClientesController@editarCliente')->name('cliente.editar');// Edita el cliente

// Ruta para productos y productos/prd_id
Route::get('/productos', 'Productos\ProductosController@mostrarProductos')->name('productos');// Muestra los productos
Route::get('/productos/nuevo', 'Productos\ProductosController@crearProducto');// Muestra la vista para crear uno nuevo
Route::put('/productos/nuevo', 'Productos\ProductosController@guardarProducto')->name('producto.guardar');// Guarda el nuevo producto
Route::get('/productos/{producto}', 'Productos\ProductosController@mostrarProducto')->name('producto');// Muestra el detalle del producto
Route::post('/productos/{producto}/editar', 'Productos\ProductosController@editarProducto')->name('producto.editar');// Edita el producto

// Ruta para albaranes y albaranes/prod_id
Route::get('/albaranes', 'Albaranes\AlbaranesController@mostrarAlbaranes')->name('albaranes');
Route::get('/albaranes/{albaran}', 'Albaranes\AlbaranesController@mostrarAlbaran')->name('albaran');