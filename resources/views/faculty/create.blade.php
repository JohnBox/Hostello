@extends('faculty.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Створення</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('faculties.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group required">
              <label class="control-label col-md-2" for="name">Назва</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
            </div>
          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
      </div>
    </div>
@endsection