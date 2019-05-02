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

<body id="app" class="container-fluid">

    @auth
        <!-- BARRRA DE NAVEGACIÓN -->
        @include('componentes/nav')
    @else
        <!-- BOTONES SUPERIORES DE LOGIN, ETC -->
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

        @auth
            <!-- SIDEBAR IZQUIERDA -->
            @include('componentes/aside')
        @endauth        

        <!-- CONTENIDO PRINCIPAL -->
        @guest
         <main class="col-12">
        @else
         <main class="col-sm-12 col-md-7 py-4">
        @endguest
            @yield('content')
         </main>

    </div>

</body>

</html>