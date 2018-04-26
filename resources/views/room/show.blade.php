@extends('room.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ url('/rooms') }}">Кімнати</a></li>
        <li class="active">Кімната {{ $room->number }}</li>
      </ol>
    </div>
    <div class="panel-body">
      <table class="table table-striped">
        <tr>
          <th>Прізвище Ім’я По батькові</th>
          <th>Дата народження</th>
          <th>Стать</th>
          <th>Студент</th>
          <th>Група</th>
          <th>Баланс</th>
        </tr>
        @foreach($room->livers as $liver)
          <tr>
            <td>
              <a href="{{ url('/livers/show') }}/{{ $liver->id }}">
                {{ $liver->last_name }} {{ $liver->first_name }} {{ $liver->parent_name }}
              </a>
            </td>
            <td>{{ $liver->birth }}</td>
            <td>@if($liver->sex) Ч @else Ж @endif</td>
            <td><input type="checkbox" @if($liver->student) checked @endif disabled style="cursor: text"/></td>

            <td>
              @if($liver->student)
                {{ $liver->group->facult->short_name }}-{{ $liver->group->course }}{{ $liver->group->number }}</td>
            @else
              -
            @endif
            <td>{{ $liver->balance }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection