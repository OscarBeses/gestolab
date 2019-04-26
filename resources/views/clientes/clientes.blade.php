@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Clientes</h2>
    </div>

    <!-- Si hay un mensaje de confirmación en la sesión lo muestro -->
    <div>
        @if ($message = Session::get('confirmacion'))
        <div class="alert alert-success justify-content-center">
            <p>{{ $message }}</p>
        </div>
        @endif
    </div>

    <div class="row">
        <a href="{{ url('/clientes/nuevo') }}" class="btn btn-info">Nuevo cliente</a>
    </div>

    <ul class="list-group my-3">
        @forelse ($clientes as $cliente)
            <li class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $cliente->cli_nombre }}</h5>
                    <small>{{ $cliente->cli_nombre_corto }}</small>
                </div>
                <p class="mb-1">{{ $cliente->cli_direccion }}</p>
                @isset($cliente->cli_municipio)
                    <p class="mb-1">{{ $cliente->cli_municipio }}</p>
                @endisset
                <small>{{ 'C.P. ' . $cliente->cli_cod_pos . ' - ' . $cliente->cli_ciudad}}</small>
                <a href="{{ route('cliente', [$cliente->cli_id]) }}" class="btn btn-primary btn-sm float-right boton-editar">
                    <i class="fas fa-edit fa-lg p-1"></i>
                </a>
            </li>
        @empty
            <li class="list-group-item text-center">No hay clientes registrados</li>
        @endforelse
    </ul>
    {{ $clientes->links() }}
        
</div>
@endsection
