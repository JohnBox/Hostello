@extends('specialty.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Редагування</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('specialties.update', ['specialty' => $specialty]) }}">
          @method('PUT')
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="faculty_id">Факультет</label>
            </div>
            <div class="col-md-10">
              <select name="faculty_id" id="faculty_id" class="form-control">
                @foreach($faculties as $faculty)
                  <option value="{{ $faculty->id }}" @if($faculty == $specialty->faculty) selected @endif >{{ $faculty->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="name">Назва</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="name" name="name" value="{{ $specialty->name }}" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-2">
              <label class="control-label" for="years_of_study">Роки навчання</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="years_of_study" name="years_of_study" value="{{ $specialty->years_of_study}}" required>
            </div>
          </div>

          <button type="submit" class="btn btn-default">Оновити</button>
        </form>
      </div>
    </div>
@endsection