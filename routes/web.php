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
