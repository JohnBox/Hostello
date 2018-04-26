@extends('payment.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Виплати</div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/payments/create') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group col-md-12">
          <label for="live_price">Плата за проживання</label>
          <input type="number" class="form-control cp" id="live_price" name="live_price"/>
        </div>
        <div class="form-group col-md-12">
          <label style="font-size: 1.1em;">Комунальні послуги</label>
        </div>
        <div class="form-group col-md-12">
          <label for="gas_price">Газ</label>
          <input type="number" class="form-control cp" id="gas_price" name="gas_price">
        </div>
        <div class="form-group col-md-12">
          <label for="elec_price">Елекроенергія</label><br/>
          @for ($i=0;$i<$bc;$i++)
          <label for="elec_price_{{$i}}">Блок {{ $i+1 }}</label>
          <input type="number" class="form-control cp" id="elec_price" name="elec_price_{{$i}}">
          @endfor
        </div>
        <div class="form-group col-md-12">
          <label for="water_price">Водопостачання</label><br/>
          @for ($i=0;$i<$bc;$i++)
            <label for="water_price_{{$i}}">Блок {{ $i+1 }}</label>
            <input type="number" class="form-control cp" id="water_price" name="water_price_{{$i}}">
          @endfor
        </div>
        <div class="form-group col-md-12">
          <button class="btn btn-default">Зберегти</button>
        </div>
      </form>
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