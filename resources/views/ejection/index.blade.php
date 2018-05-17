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
            @unless(Auth::user()->profile)
              <th>Комендант</th>
              <th>Гуртожиток</th>
            @endunless
          </tr>
          @foreach($ejections as $ejection)
            <tr>
              <td><a href="{{ route('livers.show', ['liver' => $ejection->liver]) }}">{{ $ejection->liver->full_name() }}</a></td>
              <td>{{ $ejection->date }}</td>
              <td>{{ $ejection->room->number }}</td>
              @unless(Auth::user()->profile)
                <th>{{ $ejection->watchman->short_full_name() }}</th>
                <th>{{ $ejection->watchman->hostel->name }}</th>
              @endunless
            </tr>
          @endforeach
        </table>
        {{ $ejections->links() }}
      </div>
    </div>
@endsection