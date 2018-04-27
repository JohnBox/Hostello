@extends('setting.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Група</div>
    <div class="panel-body">
        <form method="POST" action="{{ url('settings/create-group') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="faculty">Факультет</label>
            <select class="form-control" id="faculty" name="faculty">
              @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="course">Курс</label>
            <input type="text" class="form-control" id="course" name="course" value="{{ old('course') }}">
          </div>
          <div class="form-group">
            <label for="number">Номер</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ old('number') }}">
          </div>
          <div class="form-group">
            <label for="leader">Наставник</label>
            <input type="text" class="form-control" id="leader" name="leader" value="{{ old('leader') }}">
          </div>
          <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
          </div>
          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
    </div>
  </div>
@endsection