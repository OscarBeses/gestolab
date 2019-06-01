<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
    <div class="container">

        <!-- TITULO IZQUIERDA Gestolab -->
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name') }}<small class="oculto-en-phablet">{{ ' - LABORATORIO RAMÓN BESES' }}</small>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Side Of Navbar -->
            <!--
                <ul class="navbar-nav mr-auto">
                </ul>
            -->

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif 
                @else
                    <div class="solo-movil">
                        @include('componentes/items-menu')
                        @include('componentes/item-usuario')
                    </div>
                    <div class="oculto-en-phablet">
                        @include('componentes/item-usuario')
                    </div>
                @endguest
            </ul>
        </div>
    </div>
</nav>