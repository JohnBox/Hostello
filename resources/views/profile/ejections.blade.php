@extends('profile.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Виселення</div>
    <div class="panel-body">
      <table class="table table-striped">
        <tr>
          <th>Кімната</th>
          <th>Дата</th>
          <th>Комендант</th>
        </tr>
        @foreach($profile->ejections as $ejection)
          <tr>
            <td>{{ $ejection->room->number }}</td>
            <td>{{ $ejection->date }}</td>
            <th>{{ $ejection->watchman->short_name() }}</th>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection