@extends('specialty.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Створення</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('specialties.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="faculty_id">Факультет</label>
            </div>
            <div class="col-md-10">
              <select name="faculty_id" id="faculty_id" class="form-control">
                <option value="-">-</option>
                @foreach($faculties as $faculty)
                  <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
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
              <label class="control-label" for="years_of_study">Роки навчання</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="years_of_study" name="years_of_study" required>
            </div>
          </div>

          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
      </div>
    </div>
@endsection

@section('script')
  <script>
      $('#faculty_id').change(function (e) {
          $('#faculty_id').find('option[value="-"]').hide();
      })
  </script>
@endsection