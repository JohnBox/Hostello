@extends('profile.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Заселення</div>
    <div class="panel-body">
      <table class="table table-striped">
        <tr>
          <th>Кімната</th>
          <th>Дата</th>
          <th>Комендант</th>
        </tr>
        @foreach($profile->injections as $injection)
          <tr>
            <td>{{ $injection->room->number }}</td>
            <td>{{ $injection->date }}</td>
            <th>{{ $injection->watchman->short_name() }}</th>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection