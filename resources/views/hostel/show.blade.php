@extends('hostel.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ route('hostels.index') }}">Налаштування гуртожитку</a></li>
        <li class="active">{{ $hostel->name }}</li>
      </ol>
    </div>
    <div class="panel-body">
      @unless($university)
        <div class="alert alert-danger" role="alert">Університет не налаштовано.</div>
        <a class="btn btn-default" href="{{ route('universities.create') }}" role="button">Налаштувати</a>
      @else
        <hr>
        <h4>Кімнати</h4>
        <hr>
        <a class="btn btn-default" href="{{ route('rooms.create') }}?hostel={{ $hostel->id }}" role="button">Створити</a>
        <br>
        <br>
        <table class="table table-striped table-hover">
          <tr>
            <th>Номер</th>
            <th>Поверх</th>
            <th>Блок</th>
            <td>Кількість мешканців</td>
            <td>Кількість місць</td>
            <th></th>
            <th></th>
          </tr>
          @foreach($rooms as $room)
            <tr>
              <td><a href="{{ route('rooms.show', ['room' => $room]) }}">{{ $room->number }}</a></td>
              <td>{{ $room->block->floor->number }}</td>
              <td>{{ $room->block->number }}</td>
              <td>{{ count($room->livers) }}</td>
              <td>{{ $room->liver_max }}</td>
              <td><a href="{{ route('rooms.edit', ['rooms' => $room]) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
              <td>
                {!! Form::open(['method' => 'Delete', 'route' => ['rooms.destroy', $room->id]]) !!}
                <button style="border: none; background-color: transparent;color: #428bca;" type="submit"><span class="glyphicon glyphicon-remove"></span></button>
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
        </table>
        {{ $rooms->links() }}
      @endunless
      </div>
    </div>
@endsection