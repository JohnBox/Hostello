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
        @foreach($violations as $v)
          <tr>
            <td>
              <a href="{{ url('/livers/show') }}/{{ $v->liver->id }}">
                {{ $v->liver->last_name}} {{ $v->liver->first_name}} {{ $v->liver->parent_name}}
              </a>
            </td>
            <td>{{ $v->description }}</td>
            <td>{{ $v->date }}</td>
            <td>{{ $v->penalty }}</td>
            <td>
              @if($v->paid)
                <input type="checkbox" checked onclick="return false;"/>
              @else
                <a class="btn btn-xs btn-default" href="{{ url('/violations/paid') }}/{{ $v->id }}">Сплатити</a>
              @endif
            </td>
            <td><a href="{{ url('/violations/edit') }}/{{ $v->id }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
            <td><a href="{{ url('/violations/delete') }}/{{ $v->id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection

@section('script')
@endsection