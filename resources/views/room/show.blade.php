@extends('room.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ route('rooms.index') }}">Кімнати</a></li>
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
        </tr>
        @foreach($room->livers as $liver)
          <tr>
            <td><a href="{{ route('livers.show', ['liver' => $liver]) }}">{{ $liver->full_name() }}</a></td>
            <td>{{ $liver->birth_date }}</td>
            <td>@if($liver->gender) Чоловіча @else Жіноча @endif</td>
            <td>@if($liver->group){{ $liver->group->number }}@else -@endif</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection