@extends('layouts.app') 

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Crear o modificar producto</h2>
    </div>

    <!-- Si hay errores en el formulario por parte del servidor los muestro encima -->
    @include('componentes/mensajesErrores')

    <!-- 
        Uso un formulario PUT hacia la ruta de guardar si hay un producto
        Y uso uno de tipo POST hacia la ruta de editar si no hay producto
    -->
    @isset($producto->prd_id)
    <form class="form-group" action="{{ route('producto.editar', $producto->prd_id) }}" method="POST">
    @else
    <form class="form-group" action="{{ route('producto.guardar') }}" method="POST">
    @method('PUT')
    @endisset
        @csrf        
        <div class="form-row">
            <div class="col-lg-8 col-md-12">
                <label for="descrip">Descripción</label>
                <input type="text" class="form-control" id="descrip" placeholder="Descripción" name="prd_descripcion" 
                    value="{{ Helper::getDatoAnterior($producto, 'prd_descripcion') }}">
            </div>
            <div class="col-lg-4 col-md-12">
                <label for="importe">Importe</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Importe" aria-describedby="euro-span"
                        value="{{ Helper::getDatoAnterior($producto, 'prd_importe') }}" id="importe" name="prd_importe" >
                    <div class="input-group-append"> <span class="input-group-text" id="euro-span">€</span> </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <input type="text" class="form-control" id="observaciones" placeholder="Observaciones" name="prd_observaciones" 
                value="{{ Helper::getDatoAnterior($producto, 'prd_observaciones') }}">
        </div>
        <div class="form-group mt-2">
            <input class="btn btn-primary float-right" type="submit" value="Guardar">
            <a class="btn mx-2 btn-secondary float-right" href="{{ url('/productos') }}" >Atrás</a>
        </div>

    </form>
    
</div>
@endsection