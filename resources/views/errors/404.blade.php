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
	
	<style>
		.papa {
			display: flex;
			flex-direction: column;
			align-items: center;
		}
	</style>

</head>

<body id="app" class="container-fluid px-0">
	<main>
		
		<div class="papa">
			<h1>Gestolab</h1>
			<h2>Página no encontrada</h2>
			<h5><a href="{{ route('welcome') }}">Volver a la página principal</a></h5>
		</div>
	</main>
</body>

</html>