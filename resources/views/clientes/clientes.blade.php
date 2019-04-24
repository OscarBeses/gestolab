@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Clientes</h2>
    </div>

    <div class="row justify-content-center">
        <ul>
            @forelse ($clientes as $cliente)
                <li>
                    {{ $cliente->cli_nombre }}
                    <a href="{{ route('cliente', [$cliente->cli_id]) }}">
                        Ver detalles
                    </a>
                </li>
                {{-- $cliente->cli_id
                $cliente->cli_nif
                $cliente->cli_nombre
                $cliente->cli_nombre_corto
                $cliente->cli_cod_pos
                $cliente->cli_cuidad
                $cliente->cli_municipio
                $cliente->cli_direccion
                $cliente->cli_borrado --}}
            @empty
                <li>No hay clientes registrados</li>
            @endforelse
        </ul>
    </div>

</div>
@endsection
