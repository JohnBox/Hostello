@extends('violation.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ route('violations.index') }}">Порушення</a></li>
        <li class="active">Створення</li>
      </ol>
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ route('violations.store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group col-md-12">
          <label for="livers">Прізвище</label>
          <select class="form-control" name="livers[]" id="livers" multiple>
            @foreach($livers as $liver)
              <option value="{{ $liver->id }}">{{ $liver->full_name() }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-12">
          <label for="description">Опис</label>
          <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group col-md-12">
          <label for="price">Штраф з кожного участика</label>
          <input type="number" class="form-control" id="price" name="price">
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
    $(document).ready(function(){
        $('#livers').select2();
    });
    $('#price').on('keydown', function (e) {
      if (e.key === 'Backspace')
        return true;
      return (!(e.key < '0' || e.key > '9'));
    });
  </script>
@endsection