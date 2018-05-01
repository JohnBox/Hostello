@extends('liver.master')

@section('content')
  <div class="panel panel-default" style="overflow: hidden;">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ url('/livers') }}">Проживаючі</a></li>
        <li class="active">Поповнення</li>
      </ol>
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/livers/money') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $liver->id }}">
        <div class="form-group col-md-6">
          <label>Прізвище Ім’я По батькові</label>
          <p class="form-control-static">
            {{ $liver->last_name }} {{ $liver->first_name }} {{ $liver->parent_name }}
          </p>
        </div>
          <div class="form-group col-md-6">
            <label for="suma">Сума</label>
            <input type="number" class="form-control" id="suma" name="suma">
          </div>
        <div class="form-group col-md-12">
          <button type="submit" class="btn btn-default">Поповнити</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
@endsection

