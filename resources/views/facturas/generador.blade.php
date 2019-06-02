@extends('layouts.app') 
@section('content')
<div class="container-fluid">

    <div class="row justify-content-center text-center">
        <h2>Generación de facturas</h2>
    </div>

    <!-- 
        Uso un formulario PUT hacia la ruta de guardar si hay un factura
        Y uso uno de tipo POST hacia la ruta de editar si no hay factura
    -->
    <div class="row">
        <div class="col-12">

            <form class="form-group" action="{{ route('factura.generar') }}" method="POST">
                @method('put')
                @csrf
                <div class="form-row">
                    <div class="form-group col">
                        <label for="cliente">Cliente para el que se realiza la factura:</label>
                        <select class="custom-select mr-sm-2" id="cliente" name="cli_id" @isset($factura->fac_id) readonly @endisset>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->cli_id }}">{{ $cliente }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-12">
                        <button type="submit" class="btn mx-2 btn-warning float-right">
                            Generar Factura
                        </button>
                        <a class="btn mx-2 btn-secondary float-right" href="{{ url('/facturas') }}">
                            Atrás
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>           
</div>
@endsection