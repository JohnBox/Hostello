@extends('report.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Звіти</div>
      <div class="panel-body">
        <ul class="nav nav-tabs">
          <li role="presentation" class="active"><a>Боржини</a></li>
          <li role="presentation"><a href="{{ url('/livers/active') }}">Заселені</a></li>
          <li role="presentation"><a href="{{ url('/livers/nonactive') }}">Незаселені</a></li>
          <li role="presentation"><a href="{{ url('/livers/removed') }}">Виселені</a></li>
        </ul>
        <br/>
        <table class="table table-striped">
          <tr>
            <th>Прізвище Ім’я По батькові</th>
            <th>Дата народження</th>
            <th>Стать</th>
            <th>Студент</th>
            <th>Кімната</th>
            <th>Баланс</th>
          </tr>
          @foreach($livers as $liver)
            <tr>
              <td>
                <a href="{{ url('/livers/show') }}/{{ $liver->id }}">
                  {{ $liver->last_name }} {{ $liver->first_name }} {{ $liver->parent_name }}
                </a>
              </td>
              <td>{{ $liver->birth }}</td>
              <td>@if($liver->sex) Ч @else Ж @endif</td>
                <td>
                @if($liver->student)
                  {{ $liver->group->facult->short_name }}-{{ $liver->group->course }}{{ $liver->group->number }}
                @else
                  -
                @endif
              </td>
              <td>
                @if($liver->room)
                  {{ $liver->room->number }}
                @else
                  <a type="button" class="btn btn-xs btn-default" href="{{ url('livers/settle') }}/{{ $liver->id }}">Заселити</a>
                @endif
              </td>
              <td>{{ $liver->balance }}</td>
            </tr>
          @endforeach
            <tr>
              <td>Сума</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>{{ $total }}</td>
            </tr>
        </table>

      </div>
    </div>
@endsection