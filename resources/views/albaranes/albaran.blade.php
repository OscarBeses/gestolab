@extends('layouts.app') 

@section('content')
<div class="container-fluid">

    <div class="row justify-content-center text-center">
        <h2>Crear o modificar albarán</h2>
    </div>

    <!-- Si hay errores en el formulario por parte del servidor los muestro encima -->
    @include('componentes/mensajesErrores')

    <!-- 
        Uso un formulario PUT hacia la ruta de guardar si hay un albaran
        Y uso uno de tipo POST hacia la ruta de editar si no hay albaran
    -->
    <div class="row">
        @isset($albaran->alb_id)
        <form class="form-group" action="{{ route('albaran.editar', $albaran->alb_id) }}" method="POST">
        @else
        <form class="form-group" action="{{ route('albaran.guardar') }}" method="POST">
        @method('put')
        @endisset
            @csrf        
            <div class="form-row">
                <div class="form-group col-3">
                    <label>Nº de albarán</label>
                    <input type="text" class="form-control" name="alb_numero" 
                        value="{{ Helper::getDatoAnterior($albaran, 'alb_numero') }}" readonly>
                </div>
                <div class="form-group col-lg-9 col-md-12">
                    <label>Laboratorio</label>
                    <label class="form-control overflow-auto">{{ $albaran->laboratorio }}</label>
                    <input type="hidden" name="lab_id" value="{{ $albaran->laboratorio->lab_id }}">
                    {{-- Mientras solo haya un laboratorio lo dejaré así
                    <select class="custom-select mr-2" name="lab_id" readonly>
                        <option value="{{ $albaran->laboratorio->lab_id }}">{{ $albaran->laboratorio }}</option>
                    </select> --}}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="cliente">Cliente</label>
                    <select class="custom-select mr-sm-2" id="cliente" name="cli_id" @isset($albaran->alb_id) readonly @endisset>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->cli_id }}">{{ $cliente }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-4 col-md-12">
                    <label for="alb_fecha_entrega">Fecha estimada de entrega</label>
                    <input type="date" class="form-control datepicker" id="alb_fecha_entrega" placeholder="Fecha de entrega" name="alb_fecha_entrega" 
                        value="{{ Helper::getDatoAnterior($albaran, 'alb_fecha_entrega') }}">
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div>
                <p>Productos del albarán:</p>
                <div class="mb-2">
                    <a href="{{ url('/trabajos/nuevo') }}" class="btn btn-info btn-sm"><i class="fas fa-plus-circle"></i> Añadir trabajo</a>
                </div>
                @include('componentes/mensajeConfirmacion')
                <table class="table table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="col min-width-55 d-none d-sm-block">Cantidad</th>
                            <th scope="col" class="col ">Descripción producto</th>
                            <th scope="col" class="col min-width-120 d-none d-sm-block text-right">Precio / Unidad</th>
                            <th scope="col" class="col text-right min-width-55">Total</th>
                            <th scope="col" class="col "></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($albaran->trabajos as $trabajo)
                            <tr class="mt-0">
                                <div class="row">
                                    <td class="col min-width-55 d-none d-sm-block">{{$trabajo->tra_cantidad}}</td>
                                    <td class="col ">{{$trabajo->tra_descripcion}}</td>
                                    <td class="col min-width-120 d-none d-sm-block text-right">{{$trabajo->tra_precio_unidad}} €</td>
                                    <td class="col text-right min-width-55">{{$trabajo->tra_precio_unidad * $trabajo->tra_cantidad}} €</td>
                                    <td class="col ">
                                        <div class="btn-group btn-group-toggle">
                                            <button type="button" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></button>
                                            <form action="{{ route('trabajo.eliminar', $trabajo->tra_id) }}" method="POST">
                                                    @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </div>
                            </tr>
                            @php $total += $trabajo->tra_precio_unidad * $trabajo->tra_cantidad; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5"><p class="float-right p-2 m-1 border border-secondary rounded">Total: {{$total}} €</p></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="dropdown-divider mt-4"></div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="font-weight-bold">
                        @if (is_null($albaran->factura))
                            Sin facturar
                        @else
                            Facturado en la factura nº {{ $albaran->factura->fac_numero }} emitida a fecha {{ $albaran->factura->fac_fecha_emision->format('d/m/Y') }}
                        @endif
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="btn btn-primary float-right" type="submit" value="Guardar">
                <a class="btn mx-2 btn-warning float-right" href="{{ url('/albaranes') }}" >Imprimir Albarán</a>
                <a class="btn mx-2 btn-secondary float-right" href="{{ url('/albaranes') }}" >Atrás</a>
            </div>

        </form>
    </div>
</div>
@endsection