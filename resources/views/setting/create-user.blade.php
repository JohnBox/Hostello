@extends('setting.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Комендант</div>
    <div class="panel-body">
        <form method="POST" action="{{ url('settings/create-user') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="name">Імя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label for="email">Ел. пошта</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <label for="hostel">Гуртожик</label>
            <select class="form-control" id="hostel" name="hostel">
              @foreach($hostels as $hostel)
                <option value="{{ $hostel->id }}">{{ $hostel->name }}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
    </div>
  </div>
@endsection