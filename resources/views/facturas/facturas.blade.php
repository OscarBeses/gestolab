@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Facturas</h2>
    </div>

    <!-- Si hay un mensaje de confirmación en la sesión lo muestro -->
    @include('componentes/mensajeConfirmacion')
    
    <div class="row">
        <a href="{{ url('/facturas/nueva') }}" class="btn btn-info">Nueva factura</a>
    </div>

    <ul class="list-group my-3">
        @forelse ($facturas as $factura)
            <li class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $factura->fac_numero }}</h5>
                    <small>{{ $factura->dameTotal() . ' €' }}</small>
                </div>
                <p class="mb-1">Compuesta por {{ $factura->albaranes->count() }} albaranes</p>
                <div class="row">
                    @isset($factura->fac_fecha_emision)
                        <small class="col mt-2">
                            Emitido el {{ $factura->fac_fecha_emision->format('d/m/Y') }} 
                        </small>
                    @endisset
                    <div class="col-xs-1">
                        <a href="{{ route('factura.imprimir', [$factura->fac_id]) }}" class="btn btn-success btn-sm float-right boton-editar">
                            <i class="fas fa-file-export"></i>
                        </a>
                    </div>
                </div>
            </li>
        @empty
        <li class="list-group-item text-center">No hay facturas registradas</li>
        @endforelse
    </ul>
    {{ $facturas->links() }}

</div>
@endsection
