@extends('setting.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Факультет</div>
    <div class="panel-body">
        <form method="POST" action="{{ url('settings/create-facult') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="name">Назва</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label for="short_name">Коротка назва</label>
            <input type="text" class="form-control" id="short_name" name="short_name" value="{{ old('short_name') }}">
          </div>
          <div class="form-group">
            <label for="years">Тривалість навчання</label>
            <input type="text" class="form-control" id="years" name="years" value="{{ old('years') }}">
          </div>
          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
    </div>
  </div>
@endsection