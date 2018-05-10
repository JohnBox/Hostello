@extends('liver.master')

@section('content')
  <div class="panel panel-default" style="overflow: hidden;">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ route('livers.index') }}">Проживаючі</a></li>
        <li class="active">Створення</li>
      </ol>
    </div>
    <div class="panel-body">
      <form>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group col-md-6">
          <label for="last_name">Прізвище</label>
          <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="form-group col-md-6">
          <label for="first_name">Ім’я</label>
          <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="form-group col-md-6">
          <label for="second_name">По батькові</label>
          <input type="text" class="form-control" id="second_name" name="second_name" required>
        </div>
        <div class="form-group col-md-6">
          <label for="birth_date">Дата народження</label>
          <input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control" id="birth_date" name="birth_date" value="2018-05-09" required>
        </div>
        <div class="form-group col-md-6">
          <label for="gender">Стать</label>
          <div class="radio">
            <label class="radio-inline">
              <input type="radio" id="gender" name="gender" value="1"> Чоловік
            </label>
            <label class="radio-inline">
              <input type="radio" id="gender" name="gender" value="0"> Жінка
            </label>
          </div>
        </div>
        {{--<div class="form-group col-md-6">--}}
        {{--<label for="photo">Фото</label>--}}
        {{--<input type="file" class="form-control" id="photo" name="photo" required>--}}
        {{--</div>--}}
        <div class="form-group col-md-6">
          <label for="is_student">Студент</label>
          <div class="radio">
            <label class="radio-inline">
              <input type="radio" id="gender" name="gender" value="1" checked> Так
            </label>
            <label class="radio-inline">
              <input type="radio" id="gender" name="gender" value="0"> Ні
            </label>
          </div>
          <label for="bad_habit">Шкідливі звички</label>
          <div class="radio">
            <label class="radio-inline">
              <input type="radio" id="bad_habit" name="bad_habit" value="1"> Так
            </label>
            <label class="radio-inline">
              <input type="radio" id="bad_habit" name="bad_habit" value="0" checked> Ні
            </label>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="doc_number">Номер квитка</label>
          <input type="text" class="form-control" name="doc_number" id="doc_number" required>
        </div>
        <div class="form-group col-md-6">

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
          <label for="phone">Телефон</label>
          <input type="tel" class="form-control" name="phone" id="phone" required>
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
          <label for="group_id">Група</label>
          <select class="form-control" name="group_id" id="group_id">
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




        <div class="form-group col-md-12">
          <button id="submit" class="btn btn-default">Зберегти</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
    let is_student = $('#is_student');
    let bad_habit = $('#bad_habit');
    let hhh = $('#hhh');
    is_student.change(function (e) {
        is_student.val(e.target.checked?1:0);
        hhh.toggleClass('hhh');
    });
    bad_habit.change(function (e) {
        bad_habit.val(e.target.checked?1:0)
    })
  </script>
@endsection