@extends('layouts.app')

@section('nav')
  <li><a href="{{ route('livers.index') }}">Проживаючі</a></li>
  <li><a href="{{ route('rooms.index') }}">Кімнати</a></li>
  @unless(Auth::user()->profile)
    <li class="active"><a href="{{ route('payments.index') }}">Нарахування</a></li>
  @endunless
  <li><a href="{{ route('violations.index') }}">Порушення</a></li>
  <li><a href="{{ route('injections.index') }}">Заселення</a></li>
  <li><a href="{{ route('ejections.index') }}">Виселення</a></li>
  @if(!Auth::user()->profile)
    <li><a href="{{ route('universities.index') }}">Університет</a></li>
    <li><a href="{{ route('hostels.index') }}">Гуртожитки</a></li>
  @endif
@endsection