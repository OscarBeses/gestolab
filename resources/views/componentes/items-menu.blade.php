<li class="nav-item dropdown">
    <a class="nav-link " href="{{ url('/home') }}">
        <i class="fas fa-home fa-2x"></i> Página principal
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link" href="{{ route('albaranes') }}">
        <i class="fas fa-layer-group fa-2x"></i> Albaranes
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link" href="{{ route('productos') }}">
        <i class="fas fa-tooth fa-2x"></i> Productos
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link" href="{{ route('clientes') }}">
        <i class="fas fa-users fa-2x"></i> Clientes
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link" href="#">{{-- {{ route('facturas') }} --}}
            <i class="fas fa-file-invoice  fa-2x"></i> Facturas
    </a>
</li>