@extends('layouts.app') 

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Cliente: {{$producto->prd_descripcion }}</h2>
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

</div>
@endsection