@extends('liver.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Проживаючі</div>
    <div class="panel-body">
      <ul class="nav nav-tabs">
        @if($filter == 'active')
          <li role="presentation"><a href="{{ route('livers.index') }}">Всі</a></li>
          <li role="presentation" class="active"><a>Заселені</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['f' => 'nonactive']) }}">Незаселені</a></li>
        @elseif($filter == 'nonactive')
          <li role="presentation"><a href="{{ route('livers.index') }}">Всі</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['f' => 'active']) }}">Заселені</a></li>
          <li role="presentation" class="active"><a>Незаселені</a></li>
        @else
          <li role="presentation" class="active"><a>Всі</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['f' => 'active']) }}">Заселені</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['f' => 'nonactive']) }}">Незаселені</a></li>
        @endif
      </ul>
      <br/>
      @if(Auth::user()->profile)
        <a type="button" class="btn btn-sm btn-default" href="{{ route('livers.create') }}">Створити новий</a>
        <br/>
        <br/>
      @endif
      <table class="table table-striped">
        <tr>
          <th>Прізвище Ім’я По батькові</th>
          <th>Дата народження</th>
          <th>Стать</th>
          <th>Студент</th>
          <th>Баланс</th>
          <th>Кімната</th>
          <th>Активний</th>
          @if(Auth::user()->profile)
          <th></th>
          <th></th>
          @endif
        </tr>
            @foreach($livers as $liver)
          <tr>
            <td>
              <a href="{{ route('livers.show', ['liver' => $liver]) }}">
                {{ $liver->full_name() }}
              </a>
            </td>
            <td>{{ $liver->birth_date }}</td>
            <td>@if($liver->gender) Чоловіча @else Жіноча @endif</td>
            <td>
              @if($liver->is_student && $liver->group)
                {{ $liver->group->name }}
              @else
                -
              @endif
            </td>
            <td>{{ $liver->balance }}</td>
            <td>
              @if($liver->room)
                {{ $liver->room->number }}
              @else
                <a type="button" class="btn btn-xs btn-default" href="{{ route('rooms.injection', ['liver' => $liver]) }}">Заселити</a>
              @endif
            </td>
            <td>
              @if($liver->is_active)
                Так
              @else
                Ні
            @endif
            @if(Auth::user()->profile)
            <td><a href="{{ route('livers.edit', ['liver' => $liver]) }}">E</a></td>
            <td>
              {{ Form::open([ 'method'  => 'delete', 'route' => [ 'livers.destroy', $liver] ]) }}
              {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
              {{ Form::close() }}
            </td>
            @endif
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection