@extends('liver.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ route('livers.index') }}">Проживаючі</a></li>
        <li class="active">{{ $liver->full_name() }}</li>
      </ol>
    </div>
    <div class="panel-body">
      <ul class="nav nav-tabs">
        <li role="presentation" @if($page == 'profile') class="active" @endif>
          <a href="{{ route('livers.show', ['liver' => $liver]) }}">Профіль</a>
        </li>
        <li @if($page == 'payments') class="active" @endif>
          <a href="{{ route('livers.show', ['liver' => $liver, 'page' => 'payments']) }}">Виплати</a>
        </li>
        <li @if($page == 'violations') class="active" @endif>
          <a href="{{ route('livers.show', ['liver' => $liver, 'page' => 'violations']) }}">Порушення</a>
        </li>
        <li @if($page == 'injections') class="active" @endif>
          <a href="{{ route('livers.show', ['liver' => $liver, 'page' => 'injections']) }}">Заселення</a>
        </li>
        <li @if($page == 'ejections') class="active" @endif>
          <a href="{{ route('livers.show', ['liver' => $liver, 'page' => 'ejections']) }}">Виселення</a>
        </li>
      </ul>
      <br>
      @if($page == 'profile')
      <div class="show">
        <div class="form-group col-md-12">
          <div class="form-group col-md-4">
            <label for="last_name">Прізвище</label>
            <p class="form-control-static">{{ $liver->last_name }}</p>
          </div>
          <div class="form-group col-md-4">
            <label for="first_name">Ім’я</label>
            <p class="form-control-static">{{ $liver->first_name }}</p>
          </div>
          <div class="form-group col-md-4">
            <label for="second_name">По батькові</label>
            <p class="form-control-static">{{ $liver->second_name }}</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group col-md-4">
            <label for="birth_date">Дата народження</label>
            <p class="form-control-static">{{ $liver->birth_date }}</p>
          </div>
          <div class="form-group col-md-4">
            <label for="gender">Стать</label>
            <p class="form-control-static">@if($liver->gender)Чоловіча @elseЖіноча @endif</p>
          </div>
          <div class="form-group col-md-4">
            <label for="bad_habit">Шкідливі звички</label>
            <p class="form-control-static">@if($liver->bad_habit)Так @elseНі @endif</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group col-md-4">
            <label for="is_student">Студент</label>
            <p class="form-control-static">@if($liver->group)Так @elseНі @endif</p>
          </div>
          <div class="form-group col-md-4" style="background: #aaa;">
            <label for="doc_number">Номер @if($liver->group) студентського квитка @else паспорта @endif </label>
            <p class="form-control-static">{{ $liver->doc_number }}</p>
          </div>
          <div class="form-group col-md-4">
            <label for="phone">Телефон</label>
            <p class="form-control-static">{{ $liver->phone }}</p>
          </div>
        </div>
        @if($liver->group)
          <div class="col-md-12">
            <div class="form-group col-md-4">
              <label for="faculty">Факультет</label>
              <p class="form-control-static">{{ $liver->group->course->specialty->faculty->name }}</p>
            </div>
            <div class="form-group col-md-4">
              <label for="specialty">Спеціальність</label>
              <p class="form-control-static">{{ $liver->group->course->specialty->name }}</p>
            </div>
            <div class="form-group col-md-2">
              <label for="course">Курс</label>
              <p class="form-control-static">{{ $liver->group->course->number }}</p>
            </div>
            <div class="form-group col-md-2">
              <label for="group">Група</label>
              <p class="form-control-static">{{ $liver->group->name }}</p>
            </div>
          </div>
        @endif
        <div class="col-md-12">
          <div class="form-group col-md-4">
            <label for="room">Кімната</label>
            <p class="form-control-static">
              @if($liver->room)
                <a href="{{ route('rooms.show', ['room' => $liver->room]) }}">{{ $liver->room->number }}</a>
              @else
                -
              @endif
            </p>
          </div>
          <div class="form-group col-md-4">
            <label for="payments">Несплати за проживання</label>
            <p class="form-control-static">{{ count($liver->payments) }}</p>
          </div>
          <div class="form-group col-md-4">
            <label for="violations">Несплати на порушення</label>
            <p class="form-control-static">{{ count($liver->violations)}}</p>
          </div>
        </div>
        @if(Auth::user()->profile)
        <div class="form-group col-md-12">
          <div class="col-md-12">
            @if($liver->room)
              <a href="{{ route('injections.create', ['liver' => $liver, 'update' => true]) }}" id="settle" class="btn btn-default">Переселити</a>
              <a href="{{ route('ejections.create', ['liver' => $liver]) }}" id="remove" class="btn btn-default" style="color: #f66">Виселити</a>
            @else
              <a href="{{ route('injections.create', ['liver' => $liver]) }}" id="settle" class="btn btn-default">Заселити</a>
            @endif
          </div>
        </div>
        @endif
      </div>
      @elseif($page == 'payments')
        <table class="table table-striped">
          <tr>
            <th>Дата</th>
            <th>Сума</th>
            <th>Сплачено</th>
          </tr>
          @foreach($liver->payments as $payment)
            <tr>
              <td>{{ $payment->date}}</td>
              <td>{{ $payment->pivot->price }}</td>
              <td>@if($payment->pivot->paid){{ $payment->pivot->paid }}@else -@endif</td>
            </tr>
          @endforeach
        </table>
      @elseif($page == 'violations')
        <table class="table table-striped">
          <tr>
            <th>Опис</th>
            <th>Комендант</th>
            <th>Дата</th>
            <th>Штраф</th>
            <th>Сплачено</th>
          </tr>
          @foreach($liver->violations as $violation)
            <tr>
              <td><a href="{{ route('violations.show', ['violation' => $violation]) }}">{{ $violation->description }}</a></td>
              <td>{{ $violation->watchman->short_name() }}</td>
              <td>{{ $violation->date }}</td>
              <td>{{ $violation->pivot->price }}</td>
              <td>
                @if($violation->pivot->paid)
                  {{ $violation->pivot->paid }}
                @else
                  -
                @endif
              </td>
            </tr>
          @endforeach
        </table>
      @elseif($page == 'injections')
        <table class="table table-striped">
          <tr>
            <th>Кімната</th>
            <th>Комендант</th>
            <th>Дата</th>
          </tr>
          @foreach($liver->injections as $injection)
            <tr>
              <td><a href="{{ route('rooms.show', ['room' => $injection->room]) }}">{{ $injection->room->number }}</a></td>
              <th>{{ $injection->watchman->short_name() }}</th>
              <td>{{ $injection->date }}</td>
            </tr>
          @endforeach
        </table>
      @elseif($page == 'ejections')
        <table class="table table-striped">
          <tr>
            <th>Кімната</th>
            <th>Комендант</th>
            <th>Дата</th>
          </tr>
          @foreach($liver->ejections as $ejection)
            <tr>
              <td><a href="{{ route('rooms.show', ['room' => $ejection->room]) }}">{{ $ejection->room->number }}</a></td>
              <th>{{ $ejection->watchman->short_name() }}</th>
              <td>{{ $ejection->date }}</td>
            </tr>
          @endforeach
        </table>
      @endif
    </div>
  </div>
@endsection