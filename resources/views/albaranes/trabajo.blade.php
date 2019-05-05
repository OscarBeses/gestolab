@extends('layouts.app') 

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Crear o modificar trabajo</h2>
    </div>

    <!-- Si hay errores en el formulario por parte del servidor los muestro encima -->
    @include('componentes/mensajesErrores')

    <!-- 
        Uso un formulario PUT hacia la ruta de guardar si hay un trabajo
        Y uso uno de tipo POST hacia la ruta de editar si no hay trabajo
    -->
    @isset($trabajo->tra_id)
    <form class="form-group" action="{{ route('trabajo.editar', $trabajo->tra_id) }}" method="POST">
    @else
    <form class="form-group" action="{{ route('trabajo.guardar') }}" method="POST">
    @method('put')
    @endisset
        @csrf
        <div class="form-row">
            <input type="hidden" value="{{ $trabajo->albaran->alb_id }}" name="alb_id">
            <div class="form-group col-sm-12 col-md-3">
                <label for="cant">Cantidad</label>
                <input type="number" class="form-control" id="cant" placeholder="Cantidad" name="tra_cantidad" 
                    value="{{ Helper::getDatoAnterior($trabajo, 'tra_cantidad') }}">
            </div>
            <div class="form-group col-sm-12 col-md-7">
                <label for="prod">Producto</label>
                <select class="custom-select mr-sm-2" id="prod" name="prd_id" @isset($trabajo->albaran->alb_fecha_emision) readonly @endisset>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->prd_id }}">{{ $producto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm-12 col-md-2">
                <label for="imp">Precio unidad</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Importe" aria-describedby="euro-span"
                        value="{{ Helper::getDatoAnterior($trabajo, 'tra_precio_unidad') }}" id="imp" name="tra_precio_unidad" >
                    <div class="input-group-append"> <span class="input-group-text" id="euro-span">€</span> </div>
                </div>
            </div>           
        </div>
        <div class="form-row">
            <div class="form-group col-12 input-ancho">
                <label for="nombre">Observaciones</label>
                <input type="text" class="form-control" id="nombre" placeholder="Descripción" name="tra_observaciones" 
                    value="{{ Helper::getDatoAnterior($trabajo, 'tra_observaciones') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="font-weight-bold">
                    -- pertenece al albarán número {{ $trabajo->albaran->alb_numero }} --
                </label>
            </div>
        </div>
        
        <div class="form-group">
            <input class="btn btn-primary float-right" type="submit" value="Guardar">
            <a class="btn mx-2 btn-secondary float-right" href="{{ route('albaran', $trabajo->albaran->alb_id) }}" >Atrás</a>
        </div>

    </form>

</div>
@endsection