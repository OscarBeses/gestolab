<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gestolab') }}</title>

    <!-- Iconos -->
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" 
        integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
    <!-- Mi script -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fuente -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Mis estilos -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body id="app" class="container-fluid px-0">

    @auth
        <!-- BARRRA DE NAVEGACIÓN (si se ha hecho login) -->
        @include('componentes/nav')
    @else
        <!-- BOTONES SUPERIORES DE LOGIN, ETC (si no se ha hecho login) -->
        <div class="row top-right links">
            @if (Request::is('login*'))
                <a href="{{ route('welcome') }}">Página principal</a>
            @elseif (Request::is('/'))
                <a href="{{ route('login') }}">Iniciar sesión</a>
            @else
                <a href="{{ route('welcome') }}">Página principal</a>
                <a href="{{ route('login') }}">Iniciar sesión</a>
            @endif
        </div>
    @endauth

    <div class="row">
            <!-- SIDEBAR IZQUIERDA -->
            @auth
                <aside class="col-md-4 col-lg-3 d-none d-md-block sidebar bd-sidebar">
                    @include('componentes/aside')
                </aside>
            @endauth     

            <!-- CONTENIDO PRINCIPAL -->
            <main class="@guest col-12 @else col-sm-12 col-md-8 col-lg-6 @endguest"> 
                @yield('content')
            </main>
    </div>

</body>

</html>