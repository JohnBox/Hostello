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
              <label class="control-label col-md-2" for="name">Назва закладу</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $university->name }}" required>
              </div>
            </div>
            <div class="form-group required">
              <label class="control-label col-md-2" for="address">Адреса</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="address" name="address" value="{{ $university->address }}" required>
              </div>
            </div>
            <div class="form-group required">
              <label class="control-label col-md-2" for="phone">Телефон</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $university->phone }}" required>
              </div>
            </div>
            <div class="form-group required">
              <label class="control-label col-md-2" for="merchant">Мерчант акаунт</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="merchant" name="merchant" value="{{ $university->merchant }}" required>
              </div>
            </div>
          <button type="submit" class="btn btn-default">Оновити</button>
        </form>
      </div>
    </div>
@endsection