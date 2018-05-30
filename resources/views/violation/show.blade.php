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
      <ul class="nav nav-tabs">
        <li @if($paid) class="active" @endif>
          <a href="{{ route('violations.show', ['violation' => $violation, 'paid' => true]) }}">Сплаченні</a>
        </li>
        <li @unless($paid) class="active" @endif>
          <a href="{{ route('violations.show', ['violation' => $violation, 'paid' => false]) }}">Несплаченні</a>
        </li>
      </ul>
      <br>
        <table class="table table-striped">
          <tr>
            <th>Прізвище Ім’я По батькові</th>
            <th>Студент</th>
            <th>Кімната</th>
            <th>Штраф</th>
            <th>Сплаченно</th>
          </tr>
          @foreach($violation->livers as $liver)
            @if($paid && $liver->pivot->paid)
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
            @endif
          @endforeach
        </table>
      {{ $livers->links() }}
    </div>

  </div>
@endsection

@section('script')
@endsection