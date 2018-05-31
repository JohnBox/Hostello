@extends('violation.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Порушення</div>
    <div class="panel-body">
        <form class="form-inline" id="search_form" action="{{ route('violations.index') }}" method="get">
          <div class="form-group">
            @if($hostels)
              <label for="hostel">Гуртожиток</label>
              <select name="hostel" id="hostel" class="form-control">
                @foreach($hostels as $hostel)
                  <option value="{{ $hostel->id}}" @if($currentHostel == $hostel) selected @endif>{{ $hostel->name }}</option>
                @endforeach
              </select>
            @elseif(Auth::user()->profile)
              <a type="button" class="btn btn-default" href="{{ route('violations.create') }}">Створити</a>
            @endif
          </div>
          <div class="form-group">
              <label for="q" class="control-label">Дата</label>
          </div>
          <div class="form-group">
              <input class="form-control" type="date" name="q" id="q"@if($q)value="{{ $q }}"@endif>
          </div>
        </form>
      <br>
      <table class="table table-striped">
        <tr>
          <th>Опис</th>
          <th>Дата</th>
          <th>Комендант</th>
          @if(Auth::user()->profile)
          <th></th>
          <th></th>
          @endif
        </tr>
        @foreach($violations as $violation)
          <tr>
            <td><a href="{{ route('violations.show', ['$violation' => $violation]) }}">{{ $violation->description }}</a></td>
            <td>{{ $violation->date }}</td>
            <td>{{ $violation->watchman->short_name() }}</td>
            @if(Auth::user()->profile)
            <td><a href="{{ route('violations.edit', ['violation' => $violation]) }}">E</a></td>
            <td>
              {{ Form::open([ 'method'  => 'delete', 'route' => [ 'violations.destroy', $violation] ]) }}
              {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
              {{ Form::close() }}
            </td>
            @endif
          </tr>
        @endforeach
      </table>
      {{ $violations->links() }}
    </div>
  </div>
@endsection

@section('script')
  <script>
      $(function() {
          let q = $('#q'), form = $('#search_form'), hostel = $('#hostel');
          q.change(function (e) {
              form.submit();
          });
          hostel.change(function (e) {
              form.submit();
          });
      });
  </script>
@endsection