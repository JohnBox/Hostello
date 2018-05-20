@extends('payment.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Нарахування</div>
    <div class="panel-body">
      <form class="form-inline" id="search_form" action="{{ route('payments.show', ['payment' => $payment]) }}" method="get">
        <div class="form-group">
          <label for="q">Ім'я</label>
          <input type="text" name="q" id="q">
        </div>
        <button type="submit" class="btn btn-default btn-sm">Пошук</button>
      </form>
      <br>
      <table class="table table-striped">
        <tr>
          <th>Імя</th>
          <th>Проживання</th>
          <th>Сплачено</th>
        </tr>
        @foreach($livers as $liver)
          <tr>
            <td><a href="{{ route('livers.show', ['liver' => $liver]) }}">{{ $liver->full_name() }}</a></td>
            <td>{{ $liver->pivot->live_price }}</td>
            <td>@if($liver->pivot->paid){{ $liver->pivot->paid }}@else -@endif</td>
          </tr>
        @endforeach
      </table>
      {{ $livers->links() }}
    </div>
  </div>
@endsection

@section('script')
  <script>
      $(function()
      {
          $("#q").autocomplete({
              source: '{{route('payments.autocomplete')}}',
              select: function(event, ui) {
                  $('#q').val(ui.item.value);
                  $('#q').attr('qid', ui.item.id)
              }
          });
          $('#search_form').submit(function (e) {
              $('#q').val($('#q').attr('qid'));
          })
      });
  </script>
@endsection