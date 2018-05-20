@extends('ejection.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Виселення</div>
      <div class="panel-body">
        <form class="form-horizontal" id="search_form" action="{{ route('injections.index') }}" method="get">
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <input class="form-control" type="text" name="q" id="q" placeholder="Кімната">
            </div>
          </div>
        </form>
        <table class="table table-striped">
          <tr>
            <th>Прізвище Ім’я По батькові</th>
            <th>Кімната</th>
            <th>Дата</th>
          @unless(Auth::user()->profile)
              <th>Комендант</th>
              <th>Гуртожиток</th>
            @endunless
          </tr>
          @foreach($ejections as $ejection)
            <tr>
              <td><a href="{{ route('livers.show', ['liver' => $ejection->liver]) }}">{{ $ejection->liver->full_name() }}</a></td>
              <td><a href="{{ route('rooms.show', ['room' => $ejection->room]) }}">{{ $ejection->room->number }}</a></td>
              <td>{{ $ejection->date }}</td>
            @unless(Auth::user()->profile)
                <th>{{ $ejection->watchman->short_full_name() }}</th>
                <th>{{ $ejection->watchman->hostel->name }}</th>
              @endunless
            </tr>
          @endforeach
        </table>
        {{ $ejections->links() }}
      </div>
    </div>
@endsection

@section('script')
  <script>
      $(function()
      {
          $("#q").autocomplete({
              source: '{{route('rooms.autocomplete')}}',
              select: function(event, ui) {
                  $('#q').val(ui.item.id);
                  $('#search_form').submit();
              },
          });
      });
  </script>
@endsection