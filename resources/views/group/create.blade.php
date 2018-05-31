@extends('group.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Створення</div>
      <div class="panel-body">
        <form id="create_group" class="form-horizontal" method="POST" action="{{ route('groups.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="specialty_id">Спеціальність</label>
            </div>
            <div class="col-md-10">
              <select name="specialty_id" id="specialty_id" class="form-control">
                <option value="-">-</option>
                @foreach($specialties as $specialty)
                  <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="course_id">Курс</label>
            </div>
            <div class="col-md-10">
              <select name="course_id" id="course_id" class="form-control" disabled>
                <option value="-">-</option>
                @foreach($specialties as $specialty)
                  @foreach($specialty->courses as $course)
                    <option specialty_id="{{ $specialty->id }}" value="{{ $course->id }}">{{ $course->number}}</option>
                  @endforeach
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="name">Назва</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="leader">Наставник</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="leader" name="leader" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="phone">Телефон</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
          </div>

          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
      </div>
    </div>
@endsection

@section('script')
  <script>
    $(function () {
        let specialtyEl = $('#specialty_id');
        specialtyEl.change(function(e) {
            specialtyEl.find('option[value="-"]').hide();
            let specialtyId = parseInt(e.target.value);
            let courseId = $('#course_id');
            courseId.prop('disabled', !specialtyId);
            courseId.find('option[specialty_id!="' + specialtyId + '"]').hide();
            courseId.find('option[specialty_id="' + specialtyId + '"]').show();
            courseId.val('-');
        });
        $('#create_group').submit(function (e) {
            if ($('#course_id').val() === '-')
              e.preventDefault();
        })
    });
  </script>
@endsection