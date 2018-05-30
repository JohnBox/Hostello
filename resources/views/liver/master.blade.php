@extends('layouts.app')

@section('nav')
    <li class="active"><a href="{{ route('livers.index') }}">Проживаючі</a></li>
    @if(Auth::user()->profile)
    <li><a href="{{ route('rooms.index') }}">Кімнати</a></li>
    @endif
    <li><a href="{{ route('violations.index') }}">Порушення</a></li>
    @unless(Auth::user()->profile)
    <li><a href="{{ route('payments.index') }}">Нарахування</a></li>
    @endunless
    <li><a href="{{ route('injections.index') }}">Заселення</a></li>
    <li><a href="{{ route('ejections.index') }}">Виселення</a></li>
    @unless(Auth::user()->profile)
    <li><a href="{{ route('universities.index') }}">Університет</a></li>
    <li><a href="{{ route('hostels.index') }}">Гуртожитки</a></li>
    @endunless
@endsection