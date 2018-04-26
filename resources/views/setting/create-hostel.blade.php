@extends('setting.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Гуртожиток</div>
    <div class="panel-body">
        <form method="POST" action="{{ url('settings/create-hostel') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="name">Назва</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label for="address">Адреса</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
          </div>
          <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone')  }}">
          </div>
          <div class="form-group">
            <label for="area">Площа</label>
            <input type="text" class="form-control" id="area" name="area" value="{{ old('area') }}">
          </div>
          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
    </div>
  </div>
@endsection