@extends('violation.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ url('/violations') }}">Порушення</a></li>
        <li class="active">Редагування</li>
      </ol>
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/violations/edit') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $violation->id }}">
        <div class="form-group col-md-12">
          <label for="livers">Прізвище Ім’я По батькові</label>
          <p class="form-control-static" id="livers">
            {{ $violation->liver->last_name }} {{ $violation->liver->first_name }} {{ $violation->liver->parent_name }}
          </p>
        </div>
        <div class="form-group col-md-12">
          <label for="description">Опис</label>
          <textarea class="form-control" id="description" name="description">{{ $violation->description }}</textarea>
        </div>
        <div class="form-group col-md-12">
          <label for="date">Дата</label>
          <input type="date" class="form-control" id="date" name="date" value="{{ $violation->date }}">
        </div>
        <div class="form-group col-md-12">
          <label for="penalty">Штраф</label>
          <input type="number" class="form-control" id="penalty" name="penalty" value="{{ $violation->penalty }}">
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