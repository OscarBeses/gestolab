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
                    {{ $albaran->laboratorio->lab_nombre }}
                    <div class="absolute detalle-izquierda">
                        @php
                            $codPos = $albaran->laboratorio->lab_cod_pos;    
                            $ciudad = $albaran->laboratorio->lab_ciudad;
                        @endphp
                        {{ $albaran->laboratorio->lab_direccion }}<br>
                        C.P. {{ $codPos }} - {{ $ciudad }}<br/>
                        TL. 96 367 21 96
                    </div>
                </div>
                <div class="top-right absolute">
                    {{ $albaran->cliente->cli_nombre }}
                    <div class="absolute detalle-derecha">
                        {{ $albaran->cliente->cli_direccion }}<br>
                        {{-- Si hay municipio lo muestro --}}
                        @isset($albaran->cliente->cli_municipio)
                            {{ $albaran->cliente->cli_municipio }}<br/>
                        @endisset
                        C.P. {{ $albaran->cliente->cli_cod_pos }} - {{ $albaran->cliente->cli_ciudad }}
                    </div>
                </div>
            </div>

        </div>

        <!-- Linea paciente - profesor -->
        <div id="paciente-profesor">
            @isset($albaran->alb_profesor)
            <div>
                PROFESOR: {{ $albaran->alb_profesor }}
            </div>
            @endisset
            @isset($albaran->alb_paciente)
            <div>
                PACIENTE: {{ $albaran->alb_paciente }}
            </div>
            @endisset
        </div>

        <!-- DETALLE DONDE VAN LOS TRABAJOS -->
        <table>
            <thead>
                <tr>
                    <th class="w">Cantidad</th>
                    <th class="izquierda">Descipción</th>
                    <th class="w">P/U</th>
                    <th class="w">Importe</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($albaran->trabajos as $trabajo)
                    <tr class="contenido">
                        @php
                            $cant = $trabajo->tra_cantidad;
                            $pvp = $trabajo->tra_precio_unidad;
                            $subTotal = $cant * $pvp;
                            $total += $subTotal;
                        @endphp
                        <td> {{ $cant }} </td>
                        <td class="izquierda">{{ $trabajo->producto->prd_descripcion }}
                            <small> {{ $trabajo->tra_observaciones }}</small>
                        </td>
                        <td>{{ number_format($pvp, 2, ',', ' ') }}</td>
                        <td>{{ number_format($subTotal, 2, ',', ' ') }}</td>
                    </tr>
                @endforeach
                @php
                    $numTrabajos = count($albaran->trabajos);
                @endphp
                @for ($i = 0; $i < 10-$numTrabajos; $i++)
                    <tr><td></td><td></td><td></td><td></td></tr>
                @endfor
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total:</td>
                    <td>{{ number_format($total, 2, ',', ' ') }} €</td>
                </tr>
            </tfoot>
        </table>
        <label>ALBARAN Nº {{ $albaran->alb_numero }}</label>

    </main>

</body>

</html>
