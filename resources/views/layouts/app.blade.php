<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Гуртожик</title>
	<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	{{--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>--}}
  <style>
    * {
      font-weight: 300;
    }
  </style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
      @section('nav')
			<div class="navbar-header">
				<a class="navbar-brand" href="{{ url('/') }}">Гуртожиток</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/livers') }}">Проживаючі</a></li>
          <li><a href="{{ url('/rooms') }}">Кімнати</a></li>
          <li><a href="{{ url('/violations') }}">Порушення</a></li>
          <li><a href="{{ url('/payments') }}">Виплати</a></li>
          <li><a href="{{ url('/reports') }}">Звіти</a></li>
          <li><a href="{{ url('/settings') }}">Налаштування</a></li>
        </ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/login') }}">Війти</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/logout') }}">Вийти</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
      @show
		</div>
	</nav>

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        @yield('content')
      </div>
    </div>
  </div>

	<!-- Scripts -->
	<script src="{{ asset('/js/jquery.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
  @yield('script')
</body>
</html>
