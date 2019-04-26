<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $connection = DB::connection("mysql");
    $sql = "select * from tecnico";
    $tecnicos = $connection->select($sql);
    
    return view('welcome', compact('tecnicos'));
});

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