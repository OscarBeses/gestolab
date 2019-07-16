<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Gestolab') }}</title>

    <!-- Fuente -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Mis estilos -->
    <link href="{{ asset('css/factura.css') }}" rel="stylesheet">

</head>

<body>

    <main>

        <!-- HEADER -->
        <div id="header">

            <div id="lab-cli">
                <div class="top-left absolute">
                    LABORATORIO DE PRÓTESIS DENTAL
                    <br/>
                    {{ $laboratorio->lab_nombre }}
                    <div class="absolute detalle-izquierda">
                        @php
                            $codPos = $laboratorio->lab_cod_pos;    
                            $ciudad = $laboratorio->lab_ciudad;
                        @endphp
                        {{ $laboratorio->lab_direccion }}<br>
                        {{ $ciudad }} - {{ $codPos }}<br/>
                        {{ $laboratorio->lab_nif }}
                    </div>
                </div>
                <div class="top-right absolute">
                    {{ $cliente->cli_nombre }}
                    <div class="absolute detalle-derecha">
                        {{ $cliente->cli_direccion }}<br>
                        {{ $cliente->cli_ciudad }}
                        @isset($cliente->cli_municipio)
                            ({{$cliente->cli_municipio}})
                        @endisset
                         - {{ $cliente->cli_cod_pos }}<br/>
                        {{ $laboratorio->lab_nif }}
                    </div>
                </div>
            </div> 

        </div>

        <div class="margen-izquierda">
            <p>
                FACTURA Nº {{ $factura->fac_numero }}
            </p>
            <p>
                FECHA: {{ strtoupper($factura
                        ->fac_fecha_emision
                        ->locale('es_ES')
                        ->isoFormat('D [de] MMMM [del] YYYY')) 
                        }}
            </p>
        </div>
    
        <!-- DETALLE DONDE VAN LOS TRABAJOS -->
        <table>
            <thead>
                <tr>
                    <th class="td-izquierda">Descipción</th>
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
                        <td class="td-izquierda">
                            <div>Nº {{ $albaran->alb_numero }} - {{ $albaran->getCadenaTrabajos() }}</div>
                            <div>Paciente: {{ $albaran->alb_paciente }}</div>
                        </td>
                        <td class="td-derecha">{{ number_format($subTotal, 2, ',', ' ') }}</td>
                    </tr>
                @endforeach
                @php
                    $numAlbaranes = count($factura->albaranes);
                @endphp
                @for ($i = 0; $i < 10-$numAlbaranes; $i++)
                    <tr class="contenido"><td class="td-izquierda"></td><td></td></tr>
                @endfor
            </tbody>
            <tfoot>
                <tr>
                    <td class="total-factura">TOTAL FACTURA:</td>
                    <td class="total-factura">{{ number_format($total, 2, ',', ' ') }} €</td>
                </tr>
            </tfoot>
        </table>

    </main>

</body>

</html>
