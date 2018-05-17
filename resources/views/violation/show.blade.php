@extends('violation.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Порушення</div>
    <div class="panel-body">
      @if(Auth::user()->profile)
      <a type="button" class="btn btn-sm btn-default" href="{{ route('violations.create') }}">Створити</a>
      <br/>
      <br/>
      @endif
        <table class="table table-striped">
          <tr>
            <th>Прізвище Ім’я По батькові</th>
            <th>Дата народження</th>
            <th>Стать</th>
            <th>Студент</th>
            <th>Кімната</th>
            @if(Auth::user()->profile)
              <th></th>
              <th></th>
            @endif
          </tr>
          @foreach($violation->livers as $liver)
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
              <td>
                @if($liver->room)
                  {{ $liver->room->number }}
                @else
                  @if(Auth::user()->profile)
                    <a type="button" class="btn btn-xs btn-default" href="{{ route('injections.create', ['liver' => $liver]) }}">Заселити</a>
                  @else
                    -
                  @endif
                @endif
              </td>
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

@section('script')
@endsection