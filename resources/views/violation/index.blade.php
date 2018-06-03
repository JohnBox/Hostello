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
          @unless(Auth::user()->profile)
          <th>Комендант</th>
          @endunless
          @if(Auth::user()->profile)
          <th></th>
          <th></th>
          @endif
        </tr>
        @foreach($violations as $violation)
          <tr>
            <td><a href="{{ route('violations.show', ['violation' => $violation]) }}">{{ $violation->description }}</a></td>
            <td>{{ $violation->date }}</td>
            @unless(Auth::user()->profile)
            <td>{{ $violation->watchman->short_name() }}</td>
            @endunless
            @if(Auth::user()->profile)
            <td><a href="{{ route('violations.edit', ['violation' => $violation]) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td>
              {!! Form::open(['method' => 'Delete', 'route' => ['violations.destroy', $violation->id]]) !!}
              <button style="border: none; background-color: transparent;color: #428bca;" type="submit"><span class="glyphicon glyphicon-remove"></span></button>
              {!! Form::close() !!}
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