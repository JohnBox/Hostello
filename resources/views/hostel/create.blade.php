@extends('hostel.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Створення</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('hostels.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group required">
            <div class="col-md-4">
              <label class="control-label" for="name">Назва гутожитку</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-4">
              <label class="control-label" for="address">Адреса гутожитку</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="address" name="address" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-4">
              <label class="control-label" for="phone">Телефон гутожитку</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-4">
              <label class="control-label" for="floor_count">Кількість поверхів</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="floor_count" name="floor_count" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-4">
              <label class="control-label" for="block_count">Кількість блоків на поверсі</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="block_count" name="block_count" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-4">
              <label class="control-label" for="room_count">Кількість кімнат у блоці</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="room_count" name="room_count" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-4">
              <label class="control-label" for="liver_count">Кількість місць у кімнаті</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="liver_count" name="liver_count" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-4">
              <label class="control-label" for="room_price">Плата за проживання</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="room_price" name="room_price" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-4">
              <label class="control-label" for="room_price_summer">Плата за проживання у літній період</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="room_price_summer" name="room_price_summer" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-4">
              <label class="control-label" for="merchant">Мерчант</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="merchant" name="merchant" value="{{ $university->merchant }}" required>
            </div>
          </div>

          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
      </div>
    </div>
@endsection