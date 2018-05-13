@extends('hostel.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Створення</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('hostels.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group required">
              <label class="control-label col-md-2" for="name">Назва гутожитку</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
            </div>
            <div class="form-group required">
              <label class="control-label col-md-2" for="address">Адреса гутожитку</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="address" name="address" required>
              </div>
            </div>
            <div class="form-group required">
              <label class="control-label col-md-2" for="phone">Телефон гутожитку</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="phone" name="phone" required>
              </div>
            </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="area">Площа гутожитку</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="area" name="area" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="floor_count">Кількість поверхів</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="floor_count" name="floor_count" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="block_count">Кількість блоків на поверсі</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="block_count" name="block_count" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="room_count">Кількість кімнат у блоці</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="room_count" name="room_count" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="liver_count">Кількість місць у кімнаті</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="liver_count" name="liver_count" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="room_area">Площа кімнати</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="room_area" name="room_area" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="room_price">Плата за проживання у період навчання</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="room_price" name="room_price" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="room_price_summer">Плата за проживання у літній період</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="room_price_summer" name="room_price_summer" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="merchant">Мерчант</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="merchant" name="merchant" value="{{ $university->merchant }}" required>
            </div>
          </div>
          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
      </div>
    </div>
@endsection