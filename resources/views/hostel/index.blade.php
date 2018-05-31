@extends('hostel.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Налаштування гуртожитку</div>
    <div class="panel-body">
      @unless($university)
        <div class="alert alert-danger" role="alert">Університет не налаштовано.</div>
        <a class="btn btn-default" href="{{ route('universities.create') }}" role="button">Налаштувати</a>
      @else
        <hr>
        <h4>Гуртожитки</h4>
        <hr>
        <a class="btn btn-default" href="{{ route('hostels.create') }}" role="button">Створити</a>
        <br>
        <br>
        <table class="table table-striped table-hover">
          <tr>
            <th>Назва</th>
            <th>Адреса</th>
            <th>Телефон</th>
            <th></th>
            <th></th>
          </tr>
            @foreach($hostels as $hostel)
              <tr>
                <td><a href="{{ route('hostels.show', ['hostel' => $hostel]) }}">{{$hostel->name}}</a></td>
                <td>{{$hostel->address}}</td>
                <td>{{$hostel->phone}}</td>
                <td><a href="{{ route('hostels.edit', ['hostel' => $hostel]) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td><a class="delete_hostel" rid="{{$hostel->id}}"><span class="glyphicon glyphicon-remove"></span></a></td>
              </tr>
            @endforeach
          </table>
        <hr>
        <h4>Коменданти</h4>
        <hr>
        <a class="btn btn-default" href="{{ route('watchmen.create') }}" role="button">Створити</a>
        <br>
        <br>
        <table class="table table-striped table-hover">
          <tr>
            <th>Імя</th>
            <th>Гуртожиток</th>
            <th>Телефон</th>
            <th></th>
            <th></th>
          </tr>
          @foreach($watchmen as $watchman)
            <tr>
              <td>{{ $watchman->short_name() }}</td>
              <td>{{ $watchman->hostel->name }}</td>
              <td>{{ $watchman->phone }}</td>
              <td><a href="{{ route('watchmen.edit', ['watchman' => $watchman]) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
              <td><a href="{{ route('watchmen.destroy', ['watchman' => $watchman]) }}"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
          @endforeach
        </table>
        @endunless
      </div>
    </div>
@endsection

@section('script')
  <script>
    $('a.delete_hostel').click(function (e) {
        alert($(e.target).attr('rid'));
        $('#hostel_id').val();
        $('#delete_hostel')
    });
  </script>
@endsection