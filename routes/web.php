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
Route::get('/home', 'HomeController@index');

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
Route::get('/clientes', 'Clientes\ClientesController@indexClientes')->name('clientes');
Route::get('/clientes/nuevo', 'Clientes\ClientesController@crearCliente');// Esta ruta muestra la vista para crear
Route::put('/clientes/nuevo', 'Clientes\ClientesController@guardarCliente')->name('cliente.guardar');// Esta guarda el nuevo cliente
Route::get('/clientes/{cliente}', 'Clientes\ClientesController@indexCliente')->name('cliente');
Route::post('/clientes/{cliente}/editar', 'Clientes\ClientesController@editarCliente')->name('cliente.editar');// Este edita el que se le pase

// Ruta para productos y productos/prd_id
Route::get('/productos', 'Productos\ProductosController@indexProductos')->name('productos');
Route::get('/productos/{producto}', 'Productos\ProductosController@indexProductoDetalle')->name('producto');

// Ruta para albaranes y albaranes/prod_id
Route::get('/albaranes', 'Albaranes\AlbaranesController@indexAlbaranes')->name('albaranes');
Route::get('/albaranes/{albaran}', 'Albaranes\AlbaranesController@indexAlbaranDetalle')->name('albaran');