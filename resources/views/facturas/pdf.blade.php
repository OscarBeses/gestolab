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
                    {{ strtoupper($factura
                            ->fac_fecha_emision
                            ->locale('es_ES')
                            ->isoFormat('dddd, D [de] MMMM [del] YYYY')) 
                        }}
                </div>
            </div>

            <div id="lab-cli">
                <div class="top-left absolute">
                    {{ $laboratorio->lab_nombre }}
                    <div class="absolute detalle-izquierda">
                        @php
                            $codPos = $laboratorio->lab_cod_pos;    
                            $ciudad = $laboratorio->lab_ciudad;
                        @endphp
                        {{ $laboratorio->lab_direccion }}<br>
                        C.P. {{ $codPos }} - {{ $ciudad }}<br/>
                        TL. 96 367 21 96
                    </div>
                </div>
                <div class="top-right absolute">
                    {{ $cliente->cli_nombre }}
                    <div class="absolute detalle-derecha">
                        {{ $cliente->cli_direccion }}<br>
                        
                        @isset($cliente->cli_municipio)
                            {{ $cliente->cli_municipio }}<br/>
                        @endisset
                        C.P. {{ $cliente->cli_cod_pos }} - {{ $cliente->cli_ciudad }}
                    </div>
                </div>
            </div> 

        </div>

        <!-- DETALLE DONDE VAN LOS TRABAJOS -->
        <div id="detalle">
            <table>
                <thead>
                    <tr>
                        <th class="izquierda">Descipción</th>
                        <th class="w">Importe</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($albaranes as $albaran)
                        <tr class="contenido">
                            @php
                                $subTotal = $albaran->dameTotal();
                                $total += $subTotal;
                            @endphp
                            <td class="izquierda">
                                <div> Nº {{ $albaran->alb_numero }} - Fecha de emisión: {{ $albaran->alb_fecha_emision->format('d/m/Y') }}</div>
                                <div><small>{{ $albaran->getCadenaTrabajos() }}</small></div>
                            </td>
                            <td>{{ number_format($subTotal, 2, ',', ' ') }}</td>
                        </tr>
                    @endforeach
                    <tr><td></td><td></td></tr>
                    <tr><td></td><td></td></tr>
                    <tr><td></td><td></td></tr>
                    <tr><td></td><td></td></tr>
                    <tr><td></td><td></td></tr>
                    <tr><td></td><td></td></tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>TOTAL FACTURA:</td>
                        <td>{{ number_format($total, 2, ',', ' ') }} €</td>
                    </tr>
                </tfoot>
            </table>
            <label>FACTURA Nº {{ $factura->fac_numero }}</label>
        </div>

    </main>

</body>

</html>
