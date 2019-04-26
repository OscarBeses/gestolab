@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Albaranes</h2>
    </div>

    <div class="row justify-content-center">
        <ul>
            @forelse ($albaranes as $albaran)
                <li>
                    {{ $albaran->alb_numero .' - '.$albaran->cliente->cli_nombre_corto }}
                    <a href="{{ route('albaran', [$albaran->alb_id]) }}">
                        Ver detalles
                    </a>
                </li>
            @empty
                <li>No hay albaranes registrados</li>
            @endforelse
        </ul>
    </div>

</div>
@endsection
