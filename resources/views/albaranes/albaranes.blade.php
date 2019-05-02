@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Albaranes</h2>
    </div>

    <!-- Si hay un mensaje de confirmación en la sesión lo muestro -->
    @include('componentes/mensajeConfirmacion')
    
    <div class="row">
        <a href="{{ url('/albaranes/nuevo') }}" class="btn btn-info">Nuevo albarán</a>
    </div>

    <ul class="list-group my-3">
        @forelse ($albaranes as $albaran)
            <li class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $albaran->alb_numero . ' - ' . $albaran->cliente->cli_nombre_corto }}</h5>
                    <small>{{ $albaran->dameTotal() . ' €' }}</small>
                </div>
                <p class="mb-1">{{ $albaran->getCadenaTrabajos() }}</p>
                <div class="row">
                    <small class="col mt-2">
                        @isset($albaran->alb_fecha_emision)
                            Emitido el {{ $albaran->alb_fecha_emision->format('d/m/Y') }} 
                        @else
                            - Pendiente de emisión - 
                        @endisset
                    </small>
                    <div class="col-xs-1">
                        <a href="{{ route('albaran', [$albaran->alb_id]) }}" class="btn btn-primary btn-sm float-right boton-editar">
                            <i class="far fa-edit"></i>
                        </a>
                    </div>
                </div>
            </li>
        @empty
            <li>No hay albaranes registrados</li>
        @endforelse
    </ul>

</div>
@endsection
