@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <h2>Trabajos con entrega próxima</h2>
        <ul class="col-12 list-group my-3">
            @forelse ($albaranes as $albaran)
                <li class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $albaran->alb_numero . ' - ' . $albaran->cliente->cli_nombre_corto }}</h5>
                        <small>{{ $albaran->dameTotal() . ' €' }}</small>
                    </div>
                    <p class="mb-1">{{ $albaran->getCadenaTrabajos() }}</p>
                    <div class="row">
                        <p class="col mt-12 text-center font-weight-bold">
                            Fecha de entrega el día: {{ $albaran->alb_fecha_entrega->format('d/m/Y') }}
                        </p>
                    </div>
                </li>
            @empty
                <p class="text-center">¡Que bien! No hay albaranes sin facturar con fecha de entrega próxima</p>
            @endforelse
        </ul>
        
    </div>
</div>
@endsection
