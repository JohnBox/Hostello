@extends('admin.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Створення</div>
    <div class="panel-body">
      <form class="form-horizontal" method="POST" action="{{ route('watchmen.store') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group required">
          <label class="control-label col-md-2" for="hostel_id">Гуртожиток</label>
          <div class="col-md-10">
            <select name="hostel_id" id="hostel_id" class="form-control">
              <option value="0">-</option>
              @foreach($hostels as $hostel)
                <option value="{{ $hostel->id }}">{{ $hostel->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group required">
          <label class="control-label col-md-2" for="last_name">Прізвище</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="last_name" name="last_name" required>
          </div>
        </div>
        <div class="form-group required">
          <label class="control-label col-md-2" for="first_name">Імя</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="first_name" name="first_name" required>
          </div>
        </div>
        <div class="form-group required">
          <label class="control-label col-md-2" for="second_name">По батькові</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="second_name" name="second_name" required>
          </div>
        </div>
        <div class="form-group required">
            <label class="control-label col-md-2" for="phone">Телефон</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="phone" name="phone" required>
          </div>
        </div>
        <button type="submit" class="btn btn-default">Зберегти</button>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $('#hostel_id').change(function (e) {
        $('#hostel_id').find('option[value="0"]').hide();
    })
  </script>
@endsection
