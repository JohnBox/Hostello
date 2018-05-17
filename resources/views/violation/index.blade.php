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
          <th>Опис</th>
          <th>Дата</th>
          <th>Штраф</th>
          <th>Сплачено</th>
          <th></th>
        </tr>
        @foreach($violations as $violation)
          <tr>
            <td><a href="{{ route('violations.show', ['$violation' => $violation]) }}">{{ $violation->description }}</a></td>
            <td>{{ $violation->date_of_charge }}</td>
            <td>{{ $violation->pivot}}</td>
            <td>
              @if($violation->pivot)
                {{ $violation->pivot}}
              @else
                -
              @endif
            </td>
            <td><a href="{{ route('violations.edit', ['violation' => $violation]) }}">E</a></td>
            <td>
              {{ Form::open([ 'method'  => 'delete', 'route' => [ 'violations.destroy', $violation] ]) }}
              {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </table>
      {{ $violations->links() }}
    </div>
  </div>
@endsection

@section('script')
@endsection