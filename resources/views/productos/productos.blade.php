@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Productos</h2>
    </div>

    <div class="row justify-content-center">
        <ul>
            @forelse ($productos as $producto)
                <li>
                    {{ $producto->prd_descripcion }}
                    <a href="{{ route('producto', [$producto->prd_id]) }}">
                        Ver detalles
                    </a>
                </li>
            @empty
                <li>No hay prdentes registrados</li>
            @endforelse
        </ul>
    </div>

</div>
@endsection
