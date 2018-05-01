@extends('payment.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ url('/payments') }}">Виплати</a></li>
        <li class="active">Проживаючі</li>
      </ol>
    </div>
    <div class="panel-body">

      <table class="table table-striped">
        <tr>
          <th>Прізвище Ім’я По батькові</th>
          <th>Газ</th>
          <th>Електроенергія</th>
          <th>Водопостачання</th>
          <th>Загалом</th>
          <th>Сплачено</th>
        </tr>
        @foreach($pays as $p)
          <tr>
            <td>
              <a href="{{ url('/livers/show') }}/{{ $p->liver->id }}">
                {{ $p->liver->last_name }} {{ $p->liver->first_name }} {{ $p->liver->parent_name }}
              </a>
            </td>
            <td>{{ $p->gas_price }}</td>
            <td>{{ $p->elec_price }}</td>
            <td>{{ $p->water_price }}</td>
            <td>{{ $p->total }}</td>
            <td>
              @if($p->paid == $p->total)
                <input type="checkbox" checked onclick="return false;"/>
              @else
                <a type="button" class="btn btn-xs btn-default" href="{{ url('payments/paid') }}/{{ $p->id }}">Сплатити</a>
              @endif
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $('.cp').on('keydown', function (e) {
      if (e.key == 'Backspace' || e.key == '.')
        return true;
      if ((e.key < '0' || e.key > '9'))
        return false;
      return true;
    });
  </script>
@endsection