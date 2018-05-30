@extends('payment.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Нарахування</div>
    <div class="panel-body">
      <ul class="nav nav-tabs">
        <li @if($paid) class="active" @endif>
          <a href="{{ route('payments.show', ['payment' => $payment, 'paid' => true]) }}">Сплаченні</a>
        </li>
        <li @unless($paid) class="active" @endif>
          <a href="{{ route('payments.show', ['payment' => $payment, 'paid' => false]) }}">Несплаченні</a>
        </li>
      </ul>
      <br>
      <form class="form-inline" id="search_form" action="{{ route('payments.show', ['payment' => $payment]) }}" method="get">
        <div class="form-group">
          @if($hostels)
            <label for="hostel" class="control-label">Гуртожиток</label>
            <select name="hostel" id="hostel" class="form-control">
              @foreach($hostels as $hostel)
                <option value="{{ $hostel->id}}" @if($currentHostel == $hostel) selected @endif>{{ $hostel->name }}</option>
              @endforeach
            </select>
          @endif
        </div>
        <div class="form-group">
          <label for="q" class="control-label">Ім'я</label>
          <input type="text" name="q" id="q" class="form-control">
        </div>
      </form>
      <br>
      <table class="table table-striped">
        <tr>
          <th>Імя</th>
          <th>Проживання</th>
          <th>Сплачено</th>
        </tr>
        @foreach($payment->livers as $liver)
          @if($paid && $liver->pivot->paid)
            <tr>
              <td><a href="{{ route('livers.show', ['liver' => $liver]) }}">{{ $liver->full_name() }}</a></td>
              <td>{{ $liver->pivot->live_price }}</td>
              <td>{{ $liver->pivot->paid }}</td>
            </tr>
          @elseif(!$paid && !$liver->pivot->paid)
            <tr>
              <td><a href="{{ route('livers.show', ['liver' => $liver]) }}">{{ $liver->full_name() }}</a></td>
              <td>{{ $liver->pivot->live_price }}</td>
              <td>-</td>
            </tr>
          @endif
        @endforeach
      </table>
      {{ $livers->links() }}
    </div>
  </div>
@endsection

@section('script')
  <script>
      $(function() {
          let q = $('#q'), form = $('#search_form'), hostel = $('#hostel');
          q.autocomplete({
              source: '{{route('payments.autocomplete')}}?payment={{$payment->id}}&paid={{$paid}}',
              select: function(event, ui) {
                  q.val(ui.item.id);
                  form.submit();
              }
          });
          hostel.change(function (e) {
              form.submit();
          });
      });
  </script>
@endsection