@extends('layouts.app')

@section('nav')
  <div class="navbar-header">
    <a class="navbar-brand" href="{{ url('/') }}">Адміністрування</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="active"><a href="{{ url('/livers') }}">Проживаючі</a></li>
      <li><a href="{{ url('/violations') }}">Порушення</a></li>
      <li><a href="{{ url('/payments') }}">Нарахування</a></li>
      <li><a href="{{ url('/reports') }}">Заселення</a></li>
      <li><a href="{{ url('/reports') }}">Виселення</a></li>
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
@endsection

@section('content')
  @yield('content')
@endsection

@section('script')
  @yield('script')
@endsection