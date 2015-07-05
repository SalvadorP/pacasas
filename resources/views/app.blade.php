<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pacasas</title>

	<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"> -->
	<!-- <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet"> -->
	<!-- <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/readable/bootstrap.min.css" rel="stylesheet"> -->
	<!-- <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/spacelab/bootstrap.min.css" rel="stylesheet"> -->
	<!-- <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/slate/bootstrap.min.css" rel="stylesheet"> -->
	<link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/darkly/bootstrap.min.css" rel="stylesheet">

	<!-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> -->

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">PACASAS</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Inicio</a></li>
					@if (!Auth::guest())
						<li><a href="{{ url('/totales') }}">Ver Apuestas</a></li>
						<li>{!! link_to_route('apuestas.create', 'Crear Apuesta') !!}</li>												
						<li>{!! link_to_route('apuestas.estadisticas', 'Estadisticas') !!}</li>												
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<?php /* <li><a href="{{ url('/auth/register') }}">Register</a></li> */ ?>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		@if (Session::has('message'))
			<div class="alert alert-dismissible alert-success">
			  <button type="button" class="close" data-dismiss="alert">×</button>
				<p>{{ Session::get('message') }}</p>
			</div>
		@endif
		@if ($errors->any())
			<div class="alert alert-dismissible alert-danger">
			  <button type="button" class="close" data-dismiss="alert">×</button>
				@foreach ( $errors->all() as $error )
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif

		@yield('content')
	</div>

	<div class = "pull-right">
		<small class = "text-muted">Los datos mostrados aquí son meramente informativos.</small>
	</div>

</body>
</html>
