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
      <form method="POST" action="{{ route('violations.update', ['violation' => $violation]) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $violation->id }}">
        <div class="form-group col-md-12">
          <label for="livers">Учасники</label>
          @foreach($violation->livers as $liver)
          <p class="form-control-static" id="livers">{{ $liver->full_name() }}</p>
          @endforeach
        </div>
        <div class="form-group col-md-12">
          <label for="description">Опис</label>
          <textarea class="form-control" id="description" name="description">{{ $violation->description }}</textarea>
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