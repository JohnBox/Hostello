@extends('violation.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Порушення</div>
    <div class="panel-body">
      <a type="button" class="btn btn-sm btn-default" href="{{ url('/violations/create') }}">Створити</a>
      <br/>
      <br/>
      <table class="table table-striped">
        <tr>
          <th>Прізвище Ім’я По батькові</th>
          <th>Опис</th>
          <th>Дата</th>
          <th>Штраф</th>
          <th>Сплачено</th>
          <th></th>
          <th></th>
        </tr>
        @foreach($violations as $violation)
          <tr>
            <td>
              <a href="{{ url('/livers/show') }}">
                {{ $violation->liver->full_name()}}
              </a>
            </td>
            <td>{{ $violation->description }}</td>
            <td>{{ $violation->date }}</td>
            <td>{{ $violation->penalty }}</td>
            <td>
              @if($violation->paid)
                <input type="checkbox" checked onclick="return false;"/>
              @else
                <input type="checkbox"onclick="return false;"/>
              @endif
            </td>
            <td><a href="{{ route('violations.edit', ['violation' => $violation]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
            <td>
              {{ Form::open([ 'method'  => 'delete', 'route' => [ 'violations.destroy', $violation] ]) }}
              {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection

@section('script')
@endsection