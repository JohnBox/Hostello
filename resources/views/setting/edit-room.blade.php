@extends('setting.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Кімната</div>
    <div class="panel-body">
        <form method="POST" action="{{ url('settings/edit-room') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $room->id }}"/>
          <div class="form-group">
            <label for="number">Номер</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ $room->number }}">
          </div>
          <div class="form-group">
            <label for="liver_max">Кількість проживаючих</label>
            <input type="text" class="form-control" id="liver_max" name="liver_max" value="{{ $room->liver_max }}">
          </div>
          <div class="form-group">
            <label for="block">Блок</label>
            <input type="text" class="form-control" id="block" name="block" value="{{ $room->block }}">
          </div>
          <div class="form-group">
            <label for="area">Площа</label>
            <input type="text" class="form-control" id="area" name="area" value="{{ $room->area }}">
          </div>
          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
    </div>
  </div>
@endsection