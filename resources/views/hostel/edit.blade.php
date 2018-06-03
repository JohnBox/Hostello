@extends('hostel.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Редагування</div>
    <div class="panel-body">
      <form class="form-horizontal" method="POST" action="{{ route('hostels.update', ['hostel' => $hostel]) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group required">
          <div class="col-md-4">
            <label class="control-label" for="name">Назва гутожитку</label>
          </div>
          <div class="col-md-8">
            <input type="text" class="form-control" id="name" name="name" required value="{{ $hostel->name }}">
          </div>
        </div>

        <div class="form-group required">
          <div class="col-md-4">
            <label class="control-label" for="address">Адреса гутожитку</label>
          </div>
          <div class="col-md-8">
            <input type="text" class="form-control" id="address" name="address" required value="{{ $hostel->address }}">
          </div>
        </div>

        <div class="form-group required">
          <div class="col-md-4">
            <label class="control-label" for="phone">Телефон гутожитку</label>
          </div>
          <div class="col-md-8">
            <input type="text" class="form-control" id="phone" name="phone" required value="{{ $hostel->phone }}">
          </div>
        </div>

        <div class="form-group required">
          <div class="col-md-4">
            <label class="control-label" for="merchant_id">Мерчант акаунт</label>
          </div>
          <div class="col-md-8">
            <input type="text" class="form-control" id="merchant_id" name="merchant_id" value="{{ $hostel->merchant_id }}" required>
          </div>
        </div>

        <div class="form-group required">
          <div class="col-md-4">
            <label class="control-label" for="merchant_password">Мерчант пароль</label>
          </div>
          <div class="col-md-8">
            <input type="text" class="form-control" id="merchant_password" name="merchant_password" value="{{ $hostel->merchant_password }}" required>
          </div>
        </div>

        <button type="submit" class="btn btn-default">Оновити</button>
      </form>
    </div>
  </div>
@endsection