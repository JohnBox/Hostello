@extends('hostel.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Налаштування гуртожитку</div>
    <div class="panel-body">
      @unless($university)
        <div class="alert alert-danger" role="alert">Університет не налаштовано.</div>
      @endunless
        <hr>
        <h4>Гуртожитки</h4>
        <hr>
        @if($university)
          <a class="btn btn-default" href="{{ route('hostels.create') }}" role="button">Створити новий</a>
        @else
          <a class="btn btn-default disabled" href="{{ route('hostels.create') }}" role="button">Створити новий</a>
        @endif
        <br>
        <br>
        <table class="table table-striped table-hover">
          <th>
            <td>Назва</td>
            <td>Адреса</td>
            <td>Телефон</td>
            <td></td>
            <td></td>
          </th>
            @foreach($hostels as $hostel)
              <tr>
                <td></td>
                <td>{{$hostel->name}}</td>
                <td>{{$hostel->address}}</td>
                <td>{{$hostel->phone}}</td>
                <td><a href="{{ route('hostels.edit', ['hostel' => $hostel]) }}">E</a></td>
                <td>
                  {{ Form::open([ 'method'  => 'delete', 'route' => [ 'hostels.destroy', $hostel] ]) }}
                  {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
                  {{ Form::close() }}
                </td>
              </tr>
            @endforeach
          </table>
        <hr>
        <h4>Коменданти</h4>
        <hr>
        @if($university)
          <a class="btn btn-default" href="{{ route('watchmen.create') }}" role="button">Створити новий</a>
        @else
          <a class="btn btn-default disabled" href="{{ route('watchmen.create') }}" role="button">Створити новий</a>
        @endif
        <br>
        <br>
        <table class="table table-striped table-hover">
          <th>
          <td>Імя</td>
          <td>Телефон</td>
          <td></td>
          <td></td>
          </th>
          @foreach($watchmen as $watchman)
            <tr>
              <td></td>
              <td>{{ $watchman->first_name }}</td>
              <td>{{ $watchman->phone}}</td>
              <td><a href="{{ route('watchmen.edit', ['watchman' => $watchman]) }}">E</a></td>
              <td>
                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'watchmen.destroy', $watchman] ]) }}
                {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
@endsection