@extends('liver.master')

@section('content')
  <div class="panel panel-default" style="overflow: hidden;">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ route('livers.index') }}">Проживаючі</a></li>
        <li class="active">Редагування</li>
      </ol>
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ route('livers.update', ['liver' => $liver]) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group col-md-6">
          <label for="last_name">Прізвище</label>
          <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $liver->last_name }}" required>
        </div>
        <div class="form-group col-md-6">
          <label for="first_name">Ім’я</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $liver->first_name }}" required>
        </div>
        <div class="form-group col-md-6">
          <label for="second_name">По батькові</label>
          <input type="text" class="form-control" id="second_name" name="second_name" value="{{ $liver->second_name }}" required>
        </div>
        <div class="form-group col-md-6">
          <label for="birth_date">Дата народження</label>
          <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $liver->birth_date }}" required>
        </div>
        <div class="form-group col-md-6">
          <label for="gender">Стать</label>
          <div class="radio">
            <label>
              <input type="radio" name="gender" id="gender" value="{{ $liver->gender }}" required>
              Чоловіча
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="gender" id="gender" value="{{ $liver->gender }}" required>
              Жіноча
            </label>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="">Студент</label>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="is_student" id="is_student" value="{{ $liver->is_student }}" @if($liver->is_student) checked @endif>
            </label>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="bad_habit">Шкідливі звички</label>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="bad_habit" id="bad_habit" value="{{ $liver->bad_habit }}">
            </label>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="faculty_id">Факультет</label>
          <select class="form-control" name="faculty_id" id="faculty_id">
            <option value="0">-</option>
            @foreach($university->faculties as $faculty)
              <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="specialty_id">Спеціальність</label>
          <select class="form-control" name="specialty_id" id="specialty_id">
            <option value="0">-</option>
            @foreach($university->faculties as $faculty)
              @foreach($faculty->specialties as $specialty)
                <option class="f{{ $specialty->faculty->id }}" value="{{ $specialty->id }}">{{ $specialty->name }}</option>
              @endforeach
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="group">Група</label>
          <select class="form-control" name="group" id="group">
            <option class="f0" value="0">-</option>
            @foreach($university->faculties as $faculty)
              @foreach($faculty->specialties as $specialty)
                @foreach($specialty->courses as $course)
                  @foreach($course->groups as $group)
                    <option class="s{{ $group->course->specialty->id }}" value="{{ $group->id }}">{{ $group->name }}</option>
                  @endforeach
                @endforeach
              @endforeach
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="doc_number">Номер квитка</label>
          <input type="text" class="form-control" name="doc_number" value="{{ $liver->doc_number }}" required>
        </div>
        <div class="form-group col-md-6">
          <label for="phone">Телефон</label>
          <input type="tel" class="form-control" name="phone" value="{{ $liver->phone }}" required>
        </div>
        <div class="form-group col-md-12">
          <button id="submit" class="btn btn-default">Зберегти</button>
        </div>
      </form>
    </div>
  </div>
@endsection