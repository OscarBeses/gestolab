<div class="sidebar-sticky h-100 items-aside">
    <ul class="offset-sm-0 offset-md-1 nav flex-column flex-wrap rounded-bottom shadow p-3 mb-5 bg-white">
        <li class="nav-item">
            <a class="nav-link " href="{{ url('/home') }}">
                <i class="fas fa-home fa-2x"></i> Página principal
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('albaranes') }}">
                <i class="fas fa-layer-group fa-2x"></i> Albaranes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('productos') }}">
                <i class="fas fa-tooth fa-2x"></i> Productos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('clientes') }}">
                <i class="fas fa-users fa-2x"></i> Clientes
            </a>
        </li>
    </ul>
</div>