@extends('payment.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Нарахування</div>
    <div class="panel-body">
      <table class="table table-striped">
        <tr>
          <th>Імя</th>
          <th>Проживання</th>
          <th>Сплачено</th>
        </tr>
        @foreach($payment->livers as $liver)
          <tr>
            <td>
              <a href="{{ route('livers.show', ['liver' => $liver]) }}">
                {{ $liver->full_name() }}
              </a>
            </td>
            <td>{{ $payment->live_price }}</td>
            <td>{{ $payment->is_paid }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $('.cp').on('keydown', function (e) {
      if (e.key == 'Backspace' || e.key == 'Tab' || e.key == '.')
        return true;
      if ((e.key < '0' || e.key > '9'))
        return false;
      return true;
    });
  </script>
@endsection