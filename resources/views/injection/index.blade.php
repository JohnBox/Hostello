@extends('injection.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Заселення</div>
      <div class="panel-body">
        <table class="table table-striped">
          <tr>
            <th>Прізвище Ім’я По батькові</th>
            <th>Дата</th>
            <th>Кімната</th>
          </tr>
          @foreach($injections as $injection)
            <tr>
              <td>{{ $injection->liver->full_name() }}</td>
              <td>{{ $injection->date }}</td>
              <td>{{ $injection->room->number }}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
@endsection