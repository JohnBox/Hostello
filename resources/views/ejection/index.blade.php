@extends('ejection.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Виселення</div>
      <div class="panel-body">
        <table class="table table-striped">
          <tr>
            <th>Прізвище Ім’я По батькові</th>
            <th>Дата</th>
            <th>Кімната</th>
          </tr>
          @foreach($ejections as $ejection)
            <tr>
              <td>{{ $ejection->liver->full_name() }}</td>
              <td>{{ $ejection->date }}</td>
              <td>{{ $ejection->room->number }}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
@endsection