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
            @unless(Auth::user()->profile)
              <th>Комендант</th>
              <th>Гуртожиток</th>
            @endunless
          </tr>
          @foreach($injections as $injection)
            <tr>
              <td><a href="{{ route('livers.show', ['liver' => $injection->liver]) }}">{{ $injection->liver->full_name() }}</a></td>
              <td>{{ $injection->date }}</td>
              <td>{{ $injection->room->number }}</td>
              @unless(Auth::user()->profile)
                <th>{{ $injection->watchman->short_full_name() }}</th>
                <th>{{ $injection->watchman->hostel->name }}</th>
              @endunless
            </tr>
          @endforeach
        </table>
      </div>
    </div>
@endsection