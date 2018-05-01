@extends('layouts.app')

@section('nav')
  <div class="navbar-header">
    <a class="navbar-brand" href="{{ url('/') }}">{{ Auth::user()->hostel->name }}</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li><a href="{{ url('/livers') }}">Проживаючі</a></li>
      <li class="active"><a href="{{ url('/rooms') }}">Кімнати</a></li>
      <li><a href="{{ url('/violations') }}">Порушення</a></li>
      <li><a href="{{ url('/payments') }}">Виплати</a></li>
      <li><a href="{{ url('/reports') }}">Звіти</a></li>
      <li><a href="{{ url('/settings') }}">Налаштування</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::guest())
        <li><a href="{{ url('/auth/login') }}">Війти</a></li>
      @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('/auth/logout') }}">Вийти</a></li>
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