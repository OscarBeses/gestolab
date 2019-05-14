<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Gestolab') }}</title>

    <!-- Fuente -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Mis estilos -->
    <link href="{{ asset('css/albaran.css') }}" rel="stylesheet">

</head>

<body>

    <main>

        <!-- HEADER -->
        <div id="header">

            <div id="titulo">
                <div class="top-left absolute">
                    LABORATORIO PROTESIS DENTAL
                </div>
                <div class="top-right absolute">
                    {{ strtoupper($albaran
                            ->alb_fecha_emision
                            ->locale('es_ES')
                            ->isoFormat('dddd, D [de] MMMM [del] YYYY')) 
                        }}
                </div>
            </div>

            <div id="lab-cli">
                <div class="top-left absolute">
                    {{ $albaran->laboratorio }}
                </div>
                <div class="top-right absolute">
                    {{ $albaran->cliente }}
                </div>
            </div>

        </div>

        <!-- DETALLE DONDE VAN LOS TRABAJOS -->
        <div id="detalle">
            
        <!-- APARTADO DE LOS TRABAJOS DEL ALBARÁN -->
        {{-- @isset($albaran->alb_id)
                <div class="row border rounded pt-2 mt-2">
                    <div class="col-12">
                        <p class="text-center">Trabajos:</p>
                        <div class="mb-2">
                            <form action="{{ route('trabajo.nuevo', $albaran->alb_id) }}" method="GET">
        @csrf
        <button type="submit" class="btn btn-info btn-sm">
            <i class="fas fa-plus-circle"></i><span> Añadir trabajo</span>
        </button>
        </form>
        </div>
        @include('componentes/mensajeConfirmacion')
        <table style="display: table;">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Descripción producto</th>
                    <th>Precio / Unidad</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($albaran->trabajos as $trabajo)
                <form action="{{ route('trabajo.eliminar', $trabajo->tra_id) }}" method="POST">
                    @csrf
                    <tr class="mt-0">
                        <div class="row">
                            <td class="col-2 min-width-55 hide-md">{{$trabajo->tra_cantidad}}</td>
                            <td class="col">{{$trabajo->producto->prd_descripcion}}</td>
                            <td class="col-2 min-width-120 text-right hide-md">
                                {{$trabajo->tra_precio_unidad}} €</td>
                            <td class="col-2 min-width-55 text-right">
                                {{$trabajo->tra_precio_unidad * $trabajo->tra_cantidad}} €</td>
                            <td class="col-2">
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-sm" href="{{ route('trabajo', $trabajo->tra_id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Quiere borrar el trabajo?')">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </div>
                    </tr>
                </form>
                @php $total += $trabajo->tra_precio_unidad * $trabajo->tra_cantidad; @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <p class="float-right p-2 mt-1 border border-secondary rounded">Total:
                            {{$total}} €</p>
                    </td>
                </tr>
            </tfoot>
        </table>
        </div>
        </div>
        @endisset
        <div class="row">
            <div class="col-12">
                <a class="btn mx-2 btn-warning float-right"
                    href="{{ route('albaran.imprimir', $albaran->alb_id) }}">Imprimir Albarán</a>
                <a class="btn mx-2 btn-secondary float-right" href="{{ url('/albaranes') }}">Atrás</a>
            </div>
        </div> --}}

        <label>ALBARAN Nº {{ $albaran->alb_numero }}</label>
        </div><!-- fin del detalle-->

    </main>

</body>

</html>