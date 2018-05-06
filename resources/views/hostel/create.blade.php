@extends('hostel.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Створення</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('hostels.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group required">
              <label class="control-label col-md-2" for="name">Назва</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
            </div>
            <div class="form-group required">
              <label class="control-label col-md-2" for="address">Адреса</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="address" name="address" required>
              </div>
            </div>
            <div class="form-group required">
              <label class="control-label col-md-2" for="phone">Телефон</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="phone" name="phone" required>
              </div>
            </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="area">Площа</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="area" name="area" required>
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