@extends('layouts.app')

@section('nav')
  <div class="navbar-header">
    <a class="navbar-brand" href="{{ url('/') }}">{{ Auth::user()->hostel->name  }}</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li><a href="{{ url('/livers') }}">Проживаючі</a></li>
      <li><a href="{{ url('/rooms') }}">Кімнати</a></li>
      <li><a href="{{ url('/violations') }}">Порушення</a></li>
      <li><a href="{{ url('/payments') }}">Виплати</a></li>
      <li><a href="{{ url('/reports') }}">Звіти</a></li>
      @if(Auth::user()->name == 'admin')
      <li><a href="{{ url('/settings') }}">Налаштування</a></li>
      @endif
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::guest())
        <li><a href="{{ url('/login') }}">Війти</a></li>
      @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('/password-reset') }}">Змінити пароль</a></li>
            <li><a href="{{ url('logout') }}">Вийти</a></li>
          </ul>
        </li>
      @endif
    </ul>
  </div>
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Останні виплати</div>
    <div class="panel-body">
      <table class="table table-striped">
        <tr>
          <th>Дата</th>
          <th>Проживання</th>
          <th>Газ</th>
          <th>Електроенергія</th>
          <th>Водопостачання</th>
          <th>Разом</th>
          <th>Сплачено</th>
        </tr>
        @foreach($pays as $p)
          <tr>
            <td>
              <a href="{{ url('/payments/livers') }}/{{ $p->date }}">
                {{ implode('.', array_reverse(explode('-',$p->date))) }}
              </a>
            </td>
            <td>{{ $p->live_price }}</td>
            <td>{{ $p->gas_price }}</td>
            <td>{{ $p->elec_price }}</td>
            <td>{{ $p->water_price }}</td>
            <td>{{ $p->total }}</td>
            <td>{{ $p->paid }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">Останні проживаючі</div>
    <div class="panel-body">
      <table class="table table-striped">
        <tr>
          <th>Прізвище Ім’я По батькові</th>
          <th>Дата народження</th>
          <th>Стать</th>
          <th>Студент</th>
          <th>Баланс</th>
          <th>Кімната</th>
          <th>Заселення</th>
          <th>Виселення</th>
        </tr>
        @foreach($livers as $liver)
          <tr>
            <td>
              <a href="{{ url('/livers/show') }}/{{ $liver->id }}">
                {{ $liver->last_name }} {{ $liver->first_name }} {{ $liver->parent_name }}
              </a>
            </td>
            <td>{{ $liver->birth }}</td>
            <td>@if($liver->sex) Ч @else Ж @endif</td>
            <td>
              @if($liver->student)
                {{ $liver->group->facult->short_name }}-{{ $liver->group->course }}{{ $liver->group->number }}
              @else
                -
              @endif
            </td>
            <td>{{ $liver->balance }}</td>
            <td>
              @if($liver->room)
                {{ $liver->room->number }}
              @else
                <a type="button" class="btn btn-xs btn-default" href="{{ url('livers/settle') }}/{{ $liver->id }}">Заселити</a>
              @endif
            </td>
            <td>
              @if ($liver->live_in)
                {{ $liver->live_in }}
              @else
                -
              @endif
            </td>
            <td>
              @if($liver->live_out)
                {{ $liver->live_out }}
              @else
                -
              @endif
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">Останні порушення</div>
    <div class="panel-body">
      <table class="table table-striped">
        <tr>
          <th>Прізвище Ім’я По батькові</th>
          <th>Опис</th>
          <th>Дата</th>
          <th>Штраф</th>
          <th>Сплачено</th>
        </tr>
        @foreach($violations as $v)
          <tr>
            <td>
              <a href="{{ url('/livers/show') }}/{{ $v->liver->id }}">
                {{ $v->liver->last_name}} {{ $v->liver->first_name}} {{ $v->liver->parent_name}}
              </a>
            </td>
            <td>{{ $v->description }}</td>
            <td>{{ $v->date }}</td>
            <td>{{ $v->penalty }}</td>
            <td>
              @if($v->paid)
                <input type="checkbox" checked onclick="return false;"/>
              @else
                <a class="btn btn-xs btn-default" href="{{ url('/violations/paid') }}/{{ $v->id }}">Сплатити</a>
              @endif
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>

@endsection
