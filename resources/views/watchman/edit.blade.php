@extends('watchman.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Створення</div>
    <div class="panel-body">
      <form class="form-horizontal" method="POST" action="{{ route('watchmen.update', ['watchman' => $watchman]) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group required">
          <div class="col-md-2">
            <label class="control-label" for="hostel_id">Гуртожиток</label>
          </div>
          <div class="col-md-10">
            <select name="hostel_id" id="hostel_id" class="form-control">
              @foreach($hostels as $hostel)
                @if($hostel == $watchman->hostel)
                  <option value="{{ $hostel->id }}" selected>{{ $hostel->name }}</option>
                @else
                  <option value="{{ $hostel->id }}">{{ $hostel->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group required">
          <div class="col-md-2">
            <label class="control-label" for="last_name">Прізвище</label>
          </div>
          <div class="col-md-10">
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $watchman->last_name }}" required>
          </div>
        </div>

        <div class="form-group required">
          <div class="col-md-2">
            <label class="control-label" for="first_name">Імя</label>
          </div>
          <div class="col-md-10">
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $watchman->first_name }}" required>
          </div>
        </div>

        <div class="form-group required">
          <div class="col-md-2">
            <label class="control-label" for="second_name">По батькові</label>
          </div>
          <div class="col-md-10">
            <input type="text" class="form-control" id="second_name" name="second_name" value="{{ $watchman->second_name }}" required>
          </div>
        </div>

        <div class="form-group required">
          <div class="col-md-2">
            <label class="control-label" for="phone">Телефон</label>
          </div>
          <div class="col-md-10">
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $watchman->phone }}" required>
          </div>
        </div>

        <button type="submit" class="btn btn-default">Оновити</button>
      </form>
    </div>
  </div>
@endsection