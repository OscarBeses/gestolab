@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h2>Productos</h2>
    </div>

    <!-- Si hay un mensaje de confirmación en la sesión lo muestro -->
    @include('componentes/mensajeConfirmacion')

    <div class="row">
        <a href="{{ url('/productos/nuevo') }}" class="btn btn-info">Nuevo producto</a>
    </div>

    <ul class="list-group my-3">
        @forelse ($productos as $producto)
            <li class="list-group-item list-group-item-action flex-column align-items-start"><!-- list-group-item-light -->
                <div class="d-flex w-100 justify-content-between">
                    <h5>{{ $producto->prd_descripcion }}</h5>
                    <div class="small flex-shrink-0">{{ $producto->prd_importe . ' € ' }}</div>
                </div>
                <div class="row">
                    <p class="col">{{ $producto->prd_observaciones }}</p>
                    <div class="col-xs-1">
                        <a href="{{ route('producto', [$producto->prd_id]) }}" class="btn btn-primary btn-sm float-right boton-editar">
                            <i class="far fa-edit"></i>
                        </a>
                    </div>
                </div>
            </li>
        @empty
            <li class="list-group-item text-center">No hay producos registrados</li>
        @endforelse
    </ul>
    {{ $productos->links() }}

</div>
@endsection
