@extends('profile.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Порушення</div>
    <div class="panel-body">
      <a href="" class="btn btn-default">Сплатити всі</a>
      <br>
      <br>
      <table class="table table-striped">
        <tr>
          <th>Опис</th>
          <th>Дата</th>
          <th>Комендант</th>
          <th>Штраф</th>
          <th>Сплоченно</th>
        </tr>
        @foreach($profile->violations as $violation)
          <tr>
            <td>{{ $violation->description }}</td>
            <td>{{ $violation->date }}</td>
            <td>{{ $violation->watchman->short_name() }}</td>
            <td>{{ $violation->pivot->price }}</td>
            <td>
              @if($violation->pivot->paid)
                {{ $violation->pivot->paid }}
              @else
                <a href="" class="btn btn-xs btn-default">Сплатити</a>
              @endif
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection