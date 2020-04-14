@extends('layouts.app') 

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Crear o modificar cliente</h2>
    </div>

    <!-- Si hay errores en el formulario por parte del servidor los muestro encima -->
    @include('componentes/mensajesErrores')

    <!-- 
        Uso un formulario PUT hacia la ruta de guardar si el cliente es nuevo
        Y uso uno de tipo POST hacia la ruta de editar si el cliente ya existe en BD
    -->
    @isset($cliente->cli_id)
    <form class="form-group" action="{{ route('cliente.editar', $cliente->cli_id) }}" method="POST">
    @else
    <form class="form-group" action="{{ route('cliente.guardar') }}" method="POST">
    @method('put')
    @endisset
        @csrf        
        <div class="form-row">
            <div class="form-group col-md-8 col-sm-12">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="cli_nombre" 
                    value="{{ Helper::getDatoAnterior($cliente, 'cli_nombre') }}">
            </div>
            <div class="form-group col-md-4 col-sm-12">
                <label for="alias">Alias</label>
                <input type="text" class="form-control" id="alias" placeholder="Alias" name="cli_nombre_corto" 
                    value="{{ Helper::getDatoAnterior($cliente, 'cli_nombre_corto') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nif">NIF</label>
                <input type="text" class="form-control" id="nif" placeholder="NIF" name="cli_nif" 
                    value="{{ Helper::getDatoAnterior($cliente, 'cli_nif') }}">
            </div>
            <div class="form-group col-md-6">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" placeholder="Calle Ejemplo 4" name="cli_direccion" 
                    value="{{ Helper::getDatoAnterior($cliente, 'cli_direccion') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="municipio">Municipio</label>
                <input type="text" class="form-control" id="municipio" placeholder="Municipio" name="cli_municipio" 
                    value="{{ Helper::getDatoAnterior($cliente, 'cli_municipio') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="cod_pos">CP</label>
                <input type="text" class="form-control" id="cod_pos" placeholder="Código postal" name="cli_cod_pos" 
                    value="{{ Helper::getDatoAnterior($cliente, 'cli_cod_pos') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="ciudad">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" name="cli_ciudad" 
                    value="{{ Helper::getDatoAnterior($cliente, 'cli_ciudad') }}">
            </div>
        </div>

        <div class="form-group">
            <input class="btn btn-primary float-right" type="submit" value="Guardar">
            <a class="btn mx-2 btn-secondary float-right" href="{{ url('/clientes') }}" >Atrás</a>
        </div>

    </form>

</div>
@endsection