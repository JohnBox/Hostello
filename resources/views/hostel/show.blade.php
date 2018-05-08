@extends('hostel.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Налаштування гуртожитку</div>
    <div class="panel-body">
      @unless($university)
        <div class="alert alert-danger" role="alert">Університет не налаштовано.</div>
        <a class="btn btn-default" href="{{ route('universities.create') }}" role="button">Налаштувати</a>
      @else
        <hr>
        <h4>Кімнати</h4>
        <hr>
        <a class="btn btn-default" href="{{ route('rooms.create') }}?hostel={{ $hostel->id }}" role="button">Створити новий</a>
        <br>
        <br>
        <table class="table table-striped table-hover">
          <tr>
          <th>Номер</th>
          <th>Поверх</th>
          <th>Блок</th>
          <td>Кількість місць</td>
          <th></th>
          <th></th>
          </tr>
          @foreach($rooms as $room)
              <tr>
                <td>{{ $room->number }}</td>
                <td>{{ $room->block->floor->number }}</td>
                <td>{{ $room->block->number }}</td>
                <td>{{ $room->liver_max }}</td>
                <td><a href="{{ route('rooms.edit', ['rooms' => $room]) }}?hostel={{ $hostel->id }}">E</a></td>
                <td>
                  {{ Form::open([ 'method'  => 'delete', 'route' => [ 'rooms.destroy', $room] ]) }}
                  {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
                  {{ Form::close() }}
                </td>
              </tr>
          @endforeach
        </table>
        @endunless
      </div>
    </div>
@endsection