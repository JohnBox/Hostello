@extends('injection.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Заселення</div>
      <div class="panel-body">
        <form class="form-inline" id="search_form" action="{{ route('injections.index') }}" method="get">
          @if($hostels)
            <div class="form-group">
            <label for="hostel" class="control-label">Гуртожиток</label>
            <select name="hostel" id="hostel" class="form-control">
              @foreach($hostels as $hostel)
                <option value="{{ $hostel->id}}" @if($currentHostel == $hostel) selected @endif>{{ $hostel->name }}</option>
              @endforeach
            </select>
            </div>
          @endif
          <div class="form-group">
            <label for="q" class="control-label">Кімната</label>
            <input class="form-control" type="text" name="q" id="q">
          </div>
        </form>
        <br>
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
          @foreach($injections as $injection)
            <tr>
              <td><a href="{{ route('livers.show', ['liver' => $injection->liver]) }}">{{ $injection->liver->full_name() }}</a></td>
              <td><a href="{{ route('rooms.show', ['room' => $injection->room]) }}">{{ $injection->room->number }}</a></td>
              <td>{{ $injection->date }}</td>
            @unless(Auth::user()->profile)
                <th>{{ $injection->watchman->short_full_name() }}</th>
                <th>{{ $injection->watchman->hostel->name }}</th>
              @endunless
            </tr>
          @endforeach
        </table>
        {{ $injections->links() }}
      </div>
    </div>
@endsection

@section('script')
  <script>
      $(function() {
          let q = $('#q'), form = $('#search_form'), hostel = $('#hostel');
          q.autocomplete({
              source: '{{route('rooms.autocomplete')}}',
              select: function(event, ui) {
                  q.val(ui.item.id);
                  form.submit();
              },
          });
          hostel.change(function (e) {
              form.submit();
          });
      });
  </script>
@endsection