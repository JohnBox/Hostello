@extends('violation.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ url('/violations') }}">Порушення</a></li>
        <li class="active">Створення</li>
      </ol>
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/violations/create') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group col-md-12">
          <label for="livers">Прізвище</label>
          <select class="form-control" name="livers[]" id="livers" multiple>
            @foreach($livers as $l)
              <option value="{{ $l->id }}">{{ $l->last_name }} {{ $l->first_name }} {{ $l->parent_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-12">
          <label for="description">Опис</label>
          <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group col-md-12">
          <label for="date">Дата</label>
          <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group col-md-12">
          <label for="penalty">Штраф</label>
          <input type="number" class="form-control" id="penalty" name="penalty">
        </div>
        <div class="form-group col-md-12">
          <button class="btn btn-default">Зберегти</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $('#penalty').on('keydown', function (e) {
      if (e.key == 'Backspace')
        return true;
      if ((e.key < '0' || e.key > '9'))
        return false;
      return true;
    });
  </script>
@endsection