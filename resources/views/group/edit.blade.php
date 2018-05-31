@extends('group.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Редагування</div>
      <div class="panel-body">
        <form id="edit_group" class="form-horizontal" method="POST" action="{{ route('groups.update', ['group' => $group]) }}">
          @method('PUT')
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="specialty_id">Спеціальність</label>
            </div>
            <div class="col-md-10">
              <select name="specialty_id" id="specialty_id" class="form-control">
                @foreach($specialties as $specialty)
                  <option value="{{ $specialty->id }}" @if($group->course->specialty == $specialty) selected @endif>{{ $specialty->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="course_id">Курс</label>
            </div>
            <div class="col-md-10">
              <select name="course_id" id="course_id" class="form-control">
                <option value="-">-</option>
                @foreach($specialties as $specialty)
                  @foreach($specialty->courses as $course)
                    <option specialty_id="{{ $specialty->id }}" value="{{ $course->id }}" @if($group->course->id == $course->id) selected @endif>{{ $course->number}}</option>
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
              <input type="text" class="form-control" id="name" name="name" value="{{ $group->name }}" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="leader">Наставник</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="leader" name="leader" value="{{ $group->leader }}"required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="phone">Телефон</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="phone" name="phone" value="{{ $group->phone }}"required>
            </div>
          </div>
          <button type="submit" class="btn btn-default">Оновити</button>
        </form>
      </div>
    </div>
@endsection

@section('script')
  <script>
      $(function () {
          let specialtyId = $('#specialty_id');
          let courseId = $('#course_id');
          courseId.find('option[specialty_id!="' + specialtyId.val() + '"]').hide();
          courseId.find('option[specialty_id="' + specialtyId.val() + '"]').show();
          specialtyId.change(function(e) {
              let specialtyId = parseInt(e.target.value);
              let courseId = $('#course_id');
              courseId.find('option[specialty_id!="' + specialtyId + '"]').hide();
              courseId.find('option[specialty_id="' + specialtyId + '"]').show();
              courseId.val('-');
          });
          $('#edit_group').submit(function (e) {
              if (courseId.val() === '-')
                  e.preventDefault();
          })
      });
  </script>
@endsection