@extends('layouts.app') 

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Albarán: {{$albaran->alb_numero }}</h2>
    </div>
    @isset($albaran->alb_fecha_entrega)
        <div class="row justify-content-center">
            <p>Fecha entrega: {{$albaran->alb_fecha_entrega}}</p>
        </div>    
    @endisset
    <div class="row justify-content-center">
        <p>Fecha emisión: {{$albaran->alb_fecha_emision}}</p>
    </div>
    <div class="row justify-content-center">
        <p>Cliente: {{$albaran->cliente}}</p>
    </div>
    <div class="row justify-content-center">
        <p>Laboratorio: {{$albaran->laboratorio}}</p>
    </div>
    <div class="row justify-content-center">
        <p>Factura: {{$albaran->factura}}</p>
    </div>
    <div>
        Productos del albarán:
        <ul>
            <?php $total = 0; ?>
            @foreach ($albaran->trabajos as $trabajo)
                <li>{{$trabajo}}</li>
                <?php $total += $trabajo->tra_precio_unidad * $trabajo->tra_cantidad; ?>
            @endforeach
        </ul>
        <p>Total: {{$total}}</p>
    </div>

</div>
@endsection