@extends('violation.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ route('violations.index') }}">Порушення</a></li>
        <li class="active">{{ $violation->date_of_charge }}</li>
        <li class="active">{{ $violation->description }}</li>
      </ol>
    </div>
    <div class="panel-body">
      @if(Auth::user()->profile)
      <a type="button" class="btn btn-sm btn-default" href="{{ route('violations.create') }}">Створити</a>
      <br/>
      <br/>
      @endif
        <table class="table table-striped">
          <tr>
            <th>Прізвище Ім’я По батькові</th>
            <th>Студент</th>
            <th>Кімната</th>
            <th>Штраф</th>
            <th>Сплаченно</th>
          </tr>
          @foreach($violation->livers as $liver)
            <tr>
              <td>
                <a href="{{ route('livers.show', ['liver' => $liver]) }}">
                  {{ $liver->full_name() }}
                </a>
              </td>
              <td>
                @if($liver->group)
                  {{ $liver->group->name }}
                @else
                  -
                @endif
              </td>
              <td>
                @if($liver->room)
                  {{ $liver->room->number }}
                @else
                    -
                @endif
              </td>
              <td>
                {{ $liver->pivot->penalty }}
              </td>
              <td>
                @if($liver->pivot->paid)
                  {{ $liver->pivot->paid }}
                @else
                  -
                @endif
              </td>
            </tr>
          @endforeach
        </table>
      {{ $livers->links() }}
    </div>

  </div>
@endsection

@section('script')
@endsection