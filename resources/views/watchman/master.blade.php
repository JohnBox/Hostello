@extends('layouts.app')

@section('nav')
  <div class="navbar-header">
    <a class="navbar-brand" href="{{ url('/') }}">{{ Auth::user()->profile->hostel->name }}</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="active"><a href="{{ route('liver.profile') }}">Проживаючі</a></li>
      <li class=""><a href="{{ route('liver.rooms') }}">Кімнати</a></li>
      <li class=""><a href="{{ route('liver.violations') }}">Порушення</a></li>
      <li class=""><a href="{{ route('liver.payments') }}">Нарахування</a></li>
      <li class=""><a href="{{ route('liver.injections') }}">Заселення</a></li>
      <li class=""><a href="{{ route('liver.ejections') }}">Виселення</a></li>
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