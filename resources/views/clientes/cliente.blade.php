@extends('layouts.app') 

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Cliente: {{ $cliente->cli_nombre_corto }}</h2>
    </div>
    <div class="row justify-content-center">
        <p>{{$cliente->cli_nif . ' - ' . $cliente->cli_nombre}}</p>
    </div>
    <div class="row justify-content-center">
        <p>{{$cliente->cli_cod_pos}}</p>
    </div>
    <div class="row justify-content-center">
        <p>{{$cliente->cli_cuidad}}</p>
    </div>
    <div class="row justify-content-center">
        <p>{{$cliente->cli_municipio}}</p>
    </div>
    <div class="row justify-content-center">
        <p>{{$cliente->cli_direccion}}</p>
    </div>
    {{-- <div class="row justify-content-center">
        <p>{{$cliente->cli_borrado}}</p>
    </div> --}}

</div>
@endsection