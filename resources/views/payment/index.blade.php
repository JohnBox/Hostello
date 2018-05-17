@extends('payment.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Нарахування</div>
    <div class="panel-body">
      <table class="table table-striped">
        <tr>
          <th>Дата</th>
        </tr>
        @foreach($payments as $payment)
          <tr>
            <td>
              <a href="{{ route('payments.show', ['payment' => $payment]) }}">
                {{ $payment->date_of_charge }}
              </a>
            </td>
          </tr>
        @endforeach
      </table>
      {{ $payments->links() }}
    </div>
  </div>
@endsection

@section('script')
  <script>
    $('.cp').on('keydown', function (e) {
      if (e.key === 'Backspace' || e.key === 'Tab' || e.key === '.')
        return true;
      return (!(e.key < '0' || e.key > '9'));
    });
  </script>
@endsection