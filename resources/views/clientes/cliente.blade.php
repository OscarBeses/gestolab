@extends('layouts.app') 

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Crear o modificar cliente</h2>
    </div>

    <!-- Si hay errores en el formulario por parte del servidor los muestro encima -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 
        Uso un formulario put hacia la ruta de guardar si hay un cliente
        Y uso uno de tipo hacia la ruta de editar si no hay cliente
    -->
    @isset($cliente->cli_id)
    <form class="form-group" action="{{ route('cliente.editar', $cliente->cli_id) }}" method="post">
    @else
    <form class="form-group" action="{{ route('cliente.guardar') }}" method="post">
    @method('put')
    @endisset
        @csrf        
        <div class="form-row">
            <div class="form-group col-md-8 col-sm-12">
                <label for="nombre">Nombre</label>
                @php
                $cli_nombre = "";
                if (!empty(old('cli_nombre'))){
                    $cli_nombre = old('cli_nombre');
                }elseif (isset($cliente->cli_nombre)){
                    $cli_nombre = $cliente->cli_nombre;
                }
                @endphp
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{$cli_nombre}}" name="cli_nombre">
            </div>
            <div class="form-group col-md-4 col-sm-12">
                <label for="alias">Alias</label>
                @php
                $cli_nombre_corto = "";
                if (!empty(old('cli_nombre_corto'))){
                    $cli_nombre_corto = old('cli_nombre_corto');
                }elseif (isset($cliente->cli_nombre_corto)){
                    $cli_nombre_corto = $cliente->cli_nombre_corto;
                }
                @endphp
                <input type="text" class="form-control" id="alias" placeholder="Alias" name="cli_nombre_corto" value="{{ $cli_nombre_corto }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nif">NIF</label>
                @php
                $nif = "";
                if (!empty(old('cli_nif'))){
                    $nif = old('cli_nif');
                }elseif (isset($cliente->cli_nif)){
                    $nif = $cliente->cli_nif;
                }
                @endphp
                <input type="text" class="form-control" id="nif" placeholder="NIF" name="cli_nif" value="{{ $nif }}">
            </div>
            <div class="form-group col-md-6">
                <label for="direccion">Dirección</label>
                @php
                $cli_direccion = "";
                if (!empty(old('cli_direccion'))){
                    $cli_direccion = old('cli_direccion');
                }elseif (isset($cliente->cli_direccion)){
                    $cli_direccion = $cliente->cli_direccion;
                }
                @endphp
                <input type="text" class="form-control" id="direccion" placeholder="Calle Ejemplo 4" name="cli_direccion" value="{{ $cli_direccion }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="municipio">Municipio</label>
                @php
                $cli_municipio = "";
                if (!empty(old('cli_municipio'))){
                    $cli_municipio = old('cli_municipio');
                }elseif (isset($cliente->cli_municipio)){
                    $cli_municipio = $cliente->cli_municipio;
                }
                @endphp
                <input type="text" class="form-control" id="municipio" placeholder="Municipio" name="cli_municipio" value="{{ $cli_municipio }}">
            </div>
            <div class="form-group col-md-4">
                <label for="cod_pos">CP</label>
                @php
                $cli_cod_pos = "";
                if (!empty(old('cli_cod_pos'))){
                    $cli_cod_pos = old('cli_cod_pos');
                }elseif (isset($cliente->cli_cod_pos)){
                    $cli_cod_pos = $cliente->cli_cod_pos;
                }
                @endphp
                <input type="text" class="form-control" id="cod_pos" placeholder="Código postal" name="cli_cod_pos" value="{{ $cli_cod_pos }}">
            </div>
            <div class="form-group col-md-4">
                <label for="ciudad">Ciudad</label>
                @php
                $cli_ciudad = "";
                if (!empty(old('cli_ciudad'))){
                    $cli_ciudad = old('cli_ciudad');
                }elseif (isset($cliente->cli_ciudad)){
                    $cli_ciudad = $cliente->cli_ciudad;
                }
                @endphp
                <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" name="cli_ciudad" value="{{ $cli_ciudad }}">
            </div>
        </div>

        <div class="form-group">
            <input class="btn btn-primary float-right" type="submit" value="Guardar">
            <a class="btn mx-2 btn-secondary float-right" href="{{ url('/clientes') }}" >Atrás</a>
        </div>

    </form>

</div>
@endsection