@extends('university.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Налаштування університету</div>
      <div class="panel-body">
        @unless($university)
          <div class="alert alert-danger" role="alert">Університет не налаштовано.</div>
        @endunless
        <form class="form-horizontal" method="POST" action="{{ route('universities.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="name">Назва закладу</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="name" name="name" value="{{ $university->name }}" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="address">Адреса</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="address" name="address" value="{{ $university->address }}" required>
            </div>
          </div>
          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="phone">Телефон</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="phone" name="phone" value="{{ $university->phone }}" required>
            </div>
          </div>
          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="merchant">Мерчант акаунт</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="merchant_id" name="merchant_id" value="{{ $university->merchant_id }}" required>
            </div>
          </div>
          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="merchant">Мерчант пароль</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="merchant_password" name="merchant_password" value="{{ $university->merchant_password }}" required>
            </div>
          </div>
          <button type="submit" class="btn btn-default">Оновити</button>
        </form>
      </div>
    </div>
@endsection