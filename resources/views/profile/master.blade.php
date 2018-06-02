@extends('layouts.app')

@section('nav')
  <li @if($page == 'index') class="active"@endif><a href="{{ route('profile.index') }}">Профіль</a></li>
  <li @if($page == 'payments') class="active"@endif><a href="{{ route('profile.payments') }}">Нарахування</a></li>
  <li @if($page == 'violations') class="active"@endif><a href="{{ route('profile.violations') }}">Порушення</a></li>
  <li @if($page == 'injections') class="active"@endif><a href="{{ route('profile.injections') }}">Заселення</a></li>
  <li @if($page == 'ejections') class="active"@endif><a href="{{ route('profile.ejections') }}">Виселення</a></li>
@endsection

@section('content')
  @yield('content')
@endsection

@section('script')
  @yield('script')
@endsection