@extends('layouts.app')

@section('nav')
  <div class="navbar-header">
    <a class="navbar-brand" href="{{ url('/') }}">Адміністрування</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      @if($university)
        <li><a href="{{ route('livers.index') }}">Проживаючі</a></li>
        <li><a href="{{ route('violations.index') }}">Порушення</a></li>
        <li><a href="{{ route('payments.index') }}">Нарахування</a></li>
        <li><a href="{{ route('injections.index') }}">Заселення</a></li>
        <li><a href="{{ route('ejections.index') }}">Виселення</a></li>
      @endunless
      <li><a href="{{ route('universities.index') }}">Університет</a></li>
      <li class="active"><a href="{{ route('hostels.index') }}">Гуртожитки</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('/logout') }}">Вийти</a></li>
          </ul>
        </li>
    </ul>
  </div>
@endsection

@section('content')
  @yield('content')
@endsection

@section('script')
  @yield('script')
@endsection