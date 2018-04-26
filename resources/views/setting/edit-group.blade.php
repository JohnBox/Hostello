@extends('setting.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Група</div>
    <div class="panel-body">
        <form method="POST" action="{{ url('settings/edit-group') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $group->id }}"/>
          <div class="form-group">
            <label for="facult">Факультет</label>
            <select class="form-control" id="facult" name="facult">
              @foreach($faculties as $facult)
                <option value="{{ $facult->id }}" @if($group->facult_id == $facult->id) selected @endif>{{ $facult->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="course">Курс</label>
            <input type="text" class="form-control" id="course" name="course" value="{{ $group->course }}">
          </div>
          <div class="form-group">
            <label for="number">Номер</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ $group->number }}">
          </div>
          <div class="form-group">
            <label for="leader">Наставник</label>
            <input type="text" class="form-control" id="leader" name="leader" value="{{ $group->leader }}">
          </div>
          <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $group->phone }}">
          </div>
          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
    </div>
  </div>
@endsection