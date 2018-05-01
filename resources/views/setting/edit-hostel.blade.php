@extends('setting.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Гуртожиток</div>
    <div class="panel-body">
        <form method="POST" action="{{ url('settings/edit-hostel') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $hostel->id }}" />
          <div class="form-group">
            <label for="name">Назва</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $hostel->name  }}">
          </div>
          <div class="form-group">
            <label for="address">Адреса</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $hostel->address }}">
          </div>
          <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $hostel->phone }}">
          </div>
          <div class="form-group">
            <label for="area">Площа</label>
            <input type="text" class="form-control" id="area" name="area" value="{{ $hostel->area }}">
          </div>
          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
    </div>
  </div>
@endsection