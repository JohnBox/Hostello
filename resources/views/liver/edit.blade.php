@extends('liver.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ route('livers.index') }}">Проживаючі</a></li>
        <li class="active">Редагування</li>
      </ol>
    </div>
    <div class="panel-body">
      <form action="{{ route('livers.update', ['liver' => $liver]) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-md-12">
          <div class="form-group col-md-4">
            <label for="last_name">Прізвище</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $liver->last_name }}" required>
          </div>
          <div class="form-group col-md-4">
            <label for="first_name">Ім’я</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $liver->first_name }}" required>
          </div>
          <div class="form-group col-md-4">
            <label for="second_name">По батькові</label>
            <input type="text" class="form-control" id="second_name" name="second_name" value="{{ $liver->second_name }}" required>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group col-md-4">
            <label for="birth_date">Дата народження</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $liver->birth_date }}" required>
          </div>
          <div class="form-group col-md-4">
            <label for="gender">Стать</label>
            <div class="radio">
              <label class="radio-inline"><input type="radio" class="gender" name="gender" value="1" @if($liver->gender) checked @endif required>Чоловік</label>
              <label class="radio-inline"><input type="radio" class="gender" name="gender" value="0" @unless($liver->gender) checked @endunless required>Жінка</label>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="bad_habit">Шкідливі звички</label>
            <div class="radio">
              <label class="radio-inline"><input type="radio" class="bad_habit" name="bad_habit" value="1" @if($liver->bad_habit) checked @endif required>Так</label>
              <label class="radio-inline"><input type="radio" class="bad_habit" name="bad_habit" value="0" @unless($liver->bad_habit) checked @endunless required>Ні</label>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group col-md-4">
            <label for="is_student">Студент</label>
            <div class="radio">
              <label class="radio-inline"><input type="radio" class="is_student" name="is_student" value="1" @if($liver->is_student) checked @endif required>Так</label>
              <label class="radio-inline"><input type="radio" class="is_student" name="is_student" value="0" @unless($liver->is_student) checked @endunless required>Ні</label>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="doc_number" id="doc_number">Номер @if($liver->is_student) студентського квитка @else паспорта @endif</label>
            <input type="text" class="form-control" name="doc_number" id="doc_number" value="{{ $liver->doc_number }}" required>
          </div>
          <div class="form-group col-md-4">
            <label for="phone">Телефон</label>
            <input type="tel" class="form-control" name="phone" id="phone" value="{{ $liver->phone }}" required>
          </div>
        </div>
        @if($liver->group)
          <div class="col-md-12" id="select-group">
            <div class="form-group col-md-4">
              <label for="faculty_id">Факультет</label>
              <select class="form-control" name="faculty_id" id="faculty_id">
                @foreach($university->faculties as $faculty)
                  <option value="{{ $faculty->id }}" @if($liver->group->course->specialty->faculty == $faculty) selected @endif>{{ $faculty->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="specialty_id">Спеціальність</label>
              <select class="form-control" name="specialty_id" id="specialty_id">
                <option value="-">-</option>
                @foreach($university->faculties as $faculty)
                  @foreach($faculty->specialties as $specialty)
                    <option class="f{{ $specialty->faculty->id }}" value="{{ $specialty->id }}" @if($liver->group->course->specialty == $specialty) selected @endif>{{ $specialty->name }}</option>
                  @endforeach
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="group_id">Група</label>
              <select class="form-control" name="group_id" id="group_id">
                <option value="-">-</option>
                @foreach($university->faculties as $faculty)
                  @foreach($faculty->specialties as $specialty)
                    @foreach($specialty->courses as $course)
                      @foreach($course->groups as $group)
                        <option class="s{{ $group->course->specialty->id }}" value="{{ $group->id }}" @if($liver->group->id == $group->id) selected @endif>{{ $group->name }}</option>
                      @endforeach
                    @endforeach
                  @endforeach
                @endforeach
              </select>
            </div>
          </div>
        @endif
        <div class="form-group col-md-12">
          <div class="col-md-12">
            <button id="submit" class="btn btn-default">Зберегти</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
      let student = $('.is_student');
      let select = $('#select-group');
      let doc = $('#doc_number');
      let faculty = $('#faculty_id');
      let faculty_id = faculty.val();
      let specialty = $('#specialty_id');
      let specialty_id = specialty.val();
      let group = $('#group_id');

      specialty.find('option[class="f' + faculty_id+ '"]').show();
      specialty.find('option[class!="f' + faculty_id+ '"]').hide();

      group.find('option[class="s' + specialty_id + '"]').show();
      group.find('option[class!="s' + specialty_id + '"]').hide();

      faculty.change(function (e) {
          let faculty_id = e.target.value;
          specialty.find('option[class="f' + faculty_id+ '"]').show();
          specialty.find('option[class!="f' + faculty_id+ '"]').hide();
          specialty.val('-');
          group.val('-');
          group.attr('disabled', true);
      });
      specialty.change(function (e) {
          let specialty_id = e.target.value;
          group.find('option[class="s' + specialty_id + '"]').show();
          group.find('option[class!="s' + specialty_id + '"]').hide();
          group.val('-');
          group.attr('disabled', false);
      });
      student.change(function (e) {
          let is_student = e.target.value;
          if (is_student) {
              select.show();
          } else {
              select.hide();
          }
      })
  </script>
@endsection