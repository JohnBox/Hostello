@extends('faculty.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Редагування</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('faculties.update', ['faculty' => $faculty]) }}">
          @method('PUT')
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group required">
              <div class="col-md-2">
                <label class="control-label" for="name">Назва</label>
              </div>
              <div class="col-md-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $faculty->name }}" required>
              </div>
            </div>
          <button type="submit" class="btn btn-default">Оновити</button>
        </form>
      </div>
    </div>
@endsection