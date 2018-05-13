@extends('liver.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ route('livers.index') }}">Проживаючі</a></li>
        <li class="active">Створення</li>
      </ol>
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ route('livers.store') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-md-12">
          <div class="form-group col-md-4">
            <label for="last_name">Прізвище</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
          </div>
          <div class="form-group col-md-4">
            <label for="first_name">Ім’я</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
          </div>
          <div class="form-group col-md-4">
            <label for="second_name">По батькові</label>
            <input type="text" class="form-control" id="second_name" name="second_name" required>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group col-md-4">
            <label for="birth_date">Дата народження</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
          </div>
          <div class="form-group col-md-4">
            <label for="gender">Стать</label>
            <div class="radio">
              <label class="radio-inline"><input type="radio" class="gender" name="gender" value="1" required>Чоловік</label>
              <label class="radio-inline"><input type="radio" class="gender" name="gender" value="0" required>Жінка</label>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="bad_habit">Шкідливі звички</label>
            <div class="radio">
              <label class="radio-inline"><input type="radio" class="bad_habit" name="bad_habit" value="1" required>Так</label>
              <label class="radio-inline"><input type="radio" class="bad_habit" name="bad_habit" value="0" required>Ні</label>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group col-md-4">
            <label for="is_student">Студент</label>
            <div class="radio">
              <label class="radio-inline"><input type="radio" class="is_student" name="is_student" value="1" required>Так</label>
              <label class="radio-inline"><input type="radio" class="is_student" name="is_student" value="0" required>Ні</label>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="doc_number" id="doc_number">Номер документа</label>
            <input type="text" class="form-control" name="doc_number" required>
          </div>

          <div class="form-group col-md-4">
            <label for="phone">Телефон</label>
            <input type="tel" class="form-control" name="phone" id="phone" required>
          </div>
        </div>
        <div class="col-md-12" id="select-group">
          <div class="form-group col-md-4">
            <label for="faculty_id">Факультет</label>
            <select class="form-control" name="faculty_id" id="faculty_id">
              <option value="-">-</option>
              @foreach($university->faculties as $faculty)
                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="specialty_id">Спеціальність</label>
            <select class="form-control" name="specialty_id" id="specialty_id" disabled>
              <option value="-">-</option>
              @foreach($university->faculties as $faculty)
                @foreach($faculty->specialties as $specialty)
                  <option class="f{{ $specialty->faculty->id }}" value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="group_id">Група</label>
            <select class="form-control" name="group_id" id="group_id" disabled>
              <option value="-">-</option>
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
        </div>
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
    let select = $('#select-group');
    select.hide();
    let doc = $('#doc_number');
    $('.is_student').change(function (e) {
        if (e.target.value == '1') {
            doc.html('Номер студентського квитка');
            select.show();
        } else {
            doc.html('Номер паспорта');
            select.hide();
        }
    });
    let faculty = $('#faculty_id');
    let specialty = $('#specialty_id');
    let group = $('#group_id');
    faculty.change(function (e) {
        let faculty_id = e.target.value;
        $(e.target).find('option[value="-"]').hide();
        specialty.find('option[class="f' + faculty_id+ '"]').show();
        specialty.find('option[class!="f' + faculty_id+ '"]').hide();
        specialty.attr('disabled', false);
    });
    specialty.change(function (e) {
        let specialty_id = e.target.value;
        $(e.target).find('option[value="-"]').hide();
        group.find('option[class="s' + specialty_id + '"]').show();
        group.find('option[class!="s' + specialty_id + '"]').hide();
        group.attr('disabled', false);
    })
  </script>
@endsection