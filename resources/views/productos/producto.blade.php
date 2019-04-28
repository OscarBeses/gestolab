@extends('layouts.app') 

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Producto: {{$producto->prd_descripcion }}</h2>
    </div>
    <div class="row justify-content-center">
        <p>{{$producto->prd_importe}}</p>
    </div>
    <div class="row justify-content-center">
        <p>{{$producto->prd_observaciones}}</p>
    </div>
    {{-- <div class="row justify-content-center">
        <p>{{$producto->prd_borrado}}</p>
    </div> --}}

    <div class="row justify-content-center">
        <h2>Crear o modificar producto</h2>
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
        Uso un formulario put hacia la ruta de guardar si hay un producto
        Y uso uno de tipo hacia la ruta de editar si no hay producto
    -->
    @isset($producto->prd_id)
    <form class="form-group" action="{{ route('producto.editar', $producto->prd_id) }}" method="post">
    @else
    <form class="form-group" action="{{ route('producto.guardar') }}" method="post">
    @method('put')
    @endisset
        @csrf        
        <div class="form-row">
            <div class="form-group col-md-8 col-sm-12">
                <label for="descrip">Descripción</label>
                <input type="text" class="form-control" id="descrip" placeholder="Descripción" name="prd_descripcion" 
                    value="{{ Helper::getDatoAnterior($producto, 'prd_descripcion') }}">
            </div>
            <div class="form-group col-md-4 col-sm-12">
                <label for="importe">Importe</label>
                <input type="text" class="form-control" id="importe" placeholder="Importe del producto" name="prd_importe" 
                    value="{{ Helper::getDatoAnterior($producto, 'prd_importe') }}">
            </div>
        </div>
        <div class="form-row">
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