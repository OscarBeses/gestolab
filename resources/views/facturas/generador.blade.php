@extends('layouts.app') 
@section('content')
<div class="container-fluid">

    <div class="row justify-content-center text-center">
        <h2>Generación de facturas</h2>
    </div>

    <!-- 
        Uso un formulario PUT hacia la ruta de guardar si hay un albaran
        Y uso uno de tipo POST hacia la ruta de editar si no hay albaran
    -->
    <div class="row">
        <div class="col-12">
            @isset($albaran->alb_id)
            <form class="form-group" action="{{ route('albaran.editar', $albaran->alb_id) }}" method="POST">
                @else
                <form class="form-group" action="{{ route('albaran.guardar') }}" method="POST">
                    @method('put') @endisset @csrf
                    <div class="form-row">
                        @isset($albaran->alb_numero)
                        <div class="form-group col-md-3 col-lg-3 col-xl-2">
                            <label class="min-width-120">Nº de albarán</label>
                            <input type="text" class="form-control" name="alb_numero" value="{{ $albaran->alb_numero }}" readonly>
                        </div>
                        @endisset
                        <div class="form-group col-md-12 col-lg-9 col-xl-10">
                            <label>Laboratorio</label>
                            <label class="form-control overflow-auto input-ancho">{{ $albaran->laboratorio }}</label>
                            <input type="hidden" name="lab_id" value="{{ $albaran->laboratorio->lab_id }}"> 
                            {{-- Mientras solo haya un laboratorio lo dejaré así
                            <select class="custom-select mr-2" name="lab_id" readonly>
                                <option value="{{ $albaran->laboratorio->lab_id }}">{{ $albaran->laboratorio }}</option>
                            </select> --}}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="cliente">Cliente</label>
                            <select class="custom-select mr-sm-2" id="cliente" name="cli_id" @isset($albaran->alb_id) readonly @endisset>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->cli_id }}">{{ $cliente }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-5 col-xl-4">
                            <label for="alb_fecha_entrega">Fecha estimada de entrega</label>
                            <input type="date" class="form-control datepicker" id="alb_fecha_entrega" placeholder="Fecha de entrega" name="alb_fecha_entrega"
                                value="{{ Helper::getDatoAnterior($albaran, 'alb_fecha_entrega') }}">
                        </div>
                    </div>
                    
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
                    @if(!isset($albaran->alb_fecha_emision))
                        <div class="form-group" id="divGuardar">
                            <form>
                                <input class="btn btn-primary float-right" type="submit" value="Guardar">
                            </form>
                        </div>
                    @endif

                </form>
        </div>
    </div>
    <!-- APARTADO DE LOS TRABAJOS DEL ALBARÁN -->
    @isset($albaran->alb_id)
        <div class="row border rounded pt-2 my-2">
            <div class="col-12">
                <p class="text-center">Trabajos:</p>
                @if(!isset($albaran->alb_fecha_emision))
                    <div class="mb-2" id="divNuevoTrabajo">
                        <form action="{{ route('trabajo.nuevo', $albaran->alb_id) }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm">
                                <i class="fas fa-plus-circle"></i><span> Añadir trabajo</span>
                            </button>
                        </form>
                    </div>
                @endif
                @include('componentes/mensajeConfirmacion')
                <table class="table table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th class="col-2 min-width-55 oculto-en-phablet">Cantidad</th>
                            <th class="col">Descripción producto</th>
                            <th class="col-2 min-width-120 text-right oculto-en-phablet">Precio / Unidad</th>
                            <th class="col-2 min-width-55 text-right">Total</th>
                            <th class="col-2 "></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($albaran->trabajos as $trabajo)
                            <form action="{{ route('trabajo.eliminar', $trabajo->tra_id) }}" method="POST">
                                @csrf
                                <tr class="mt-0">
                                    <div class="row">
                                        <td class="col-2 min-width-55 oculto-en-phablet">{{$trabajo->tra_cantidad}}</td>
                                        <td class="col">{{$trabajo->producto->prd_descripcion}}</td>
                                        <td class="col-2 min-width-120 text-right oculto-en-phablet">{{$trabajo->tra_precio_unidad}} €</td>
                                        <td class="col-2 min-width-55 text-right">{{$trabajo->tra_precio_unidad * $trabajo->tra_cantidad}} €</td>
                                        @if(!isset($albaran->alb_fecha_emision))
                                        <td class="col-2 tdBtnEditarBorrar">
                                            <div class="btn-group">
                                                <a class="btn btn-primary btn-sm" href="{{ route('trabajo', $trabajo->tra_id) }}">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea borrar el trabajo?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                        @endif
                                    </div>
                                </tr>
                            </form>
                            @php $total += $trabajo->tra_precio_unidad * $trabajo->tra_cantidad; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <p class="float-right p-2 mt-1 border border-secondary rounded">Total: {{$total}} €</p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- BOTON IMPRIMIR Y ATRÁS -->
        <div class="row">
            <div class="col-12">
                <a class="btn mx-2 btn-warning float-right" href="{{ route('albaran.imprimir', $albaran->alb_id) }}" target="_blank"
                    onclick="trasEmitir()">
                    @isset($albaran->alb_fecha_emision)
                        Imprimir Albarán
                    @else
                        Emitir Albarán
                    @endif
                </a>
                <a class="btn mx-2 btn-secondary float-right" href="{{ url('/albaranes') }}">
                    Atrás
                </a>
            </div>
        </div>
    @endisset
    
</div>
@endsection