<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        return view('home');
    }
}
