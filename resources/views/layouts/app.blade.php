<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Гуртожик</title>
	<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
  <style>
    * {
			font-family: Roboto;
      font-weight: 300;
    }
  </style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{ route('home') }}">
					@if(Auth::user())
						@if(Auth::user()->profile)
							{{ Auth::user()->profile->hostel->name }}
						@else
							Адміністрування
						@endif
					@endif
				</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
					@yield('nav')
        </ul>
				<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								@if(Auth::user())
									@if(Auth::user()->profile)
										{{ Auth::user()->profile->short_full_name() }}<span class="caret"></span>
									@else
										{{ Auth::user()->name }}
									@endif
								@endif
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/logout') }}">Вийти</a></li>
							</ul>
						</li>
				</ul>
			</div>
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
