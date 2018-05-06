@extends('payment.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Виплати</div>
    <div class="panel-body">
      <a class="btn btn-default" href="{{ route('payments.create') }}" role="button">Створити новий</a>
      <br/>
      <br/>
      <table class="table table-striped">
        <tr>
          <th>Дата</th>
          <th>Проживання</th>
          <th>Газ</th>
          <th>Електроенергія</th>
          <th>Водопостачання</th>
          <th>Разом</th>
          <th>Сплачено</th>
        </tr>
        @foreach($pays as $p)
          <tr>
              <td>
              <a href="{{ url('/payments/livers') }}/{{ $p->date }}">
                {{ implode('.', array_reverse(explode('-',$p->date))) }}
              </a>
            </td>
            <td>{{ $p->live_price }}</td>
            <td>{{ $p->gas_price }}</td>
            <td>{{ $p->elec_price }}</td>
            <td>{{ $p->water_price }}</td>
            <td>{{ $p->total }}</td>
            <td>{{ $p->paid }}</td>
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