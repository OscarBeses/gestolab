@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Productos</h2>
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
        <a href="{{ url('/productos/nuevo') }}" class="btn btn-info">Nuevo producto</a>
    </div>

    <ul class="list-group my-3">
        @forelse ($productos as $producto)
            <li class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $producto->prd_descripcion }}</h5>
                    <span>{{ $producto->prd_importe . ' €' }}</span>
                    
                </div>
                <small>{{ 'Observaciones: ' . $producto->prd_observaciones }}</small>
                <a href="{{ route('producto', [$producto->prd_id]) }}" class="btn btn-primary btn-sm float-right boton-editar">
                    <i class="fas fa-edit fa-lg p-1"></i>
                </a>
            </li>
        @empty
            <li class="list-group-item text-center">No hay producos registrados</li>
        @endforelse
    </ul>
    {{ $productos->links() }}

</div>
@endsection
