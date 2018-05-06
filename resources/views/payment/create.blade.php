@extends('payment.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Створення</div>
    <div class="panel-body">
      <form method="POST" action="{{ route('payments.store') }}">
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
          @for ($block=1; $block<=$blocks; $block++)
            <label for="elec_price_{{$block}}">Блок {{ $block }}</label>
            <input type="number" class="form-control cp" id="elec_price" name="elec_price_{{$block}}">
          @endfor
        </div>
        <div class="form-group col-md-12">
          <label for="water_price">Водопостачання</label><br/>
          @for ($block=1; $block<=$blocks; $block++)
            <label for="water_price_{{$block}}">Блок {{ $block }}</label>
            <input type="number" class="form-control cp" id="water_price" name="water_price_{{$block}}">
          @endfor
        </div>
        <div class="form-group col-md-12">
          <button class="btn btn-default">Зберегти</button>
        </div>
      </form>
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