@extends('room.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Створення</div>
      <div class="panel-body">
        <form id="create_room" class="form-horizontal" method="POST" action="{{ route('rooms.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="hostel_id" value="{{ $hostel->id }}">

          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="floor_id">Поверх</label>
            </div>
            <div class="col-md-9">
              <select name="floor_id" id="floor_id" class="form-control">
                <option value="-">-</option>
                @foreach($hostel->floors as $floor)
                  <option value="{{ $floor->id }}">{{ $floor->number }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="block_id">Блок</label>
            </div>
            <div class="col-md-9">
              <select name="block_id" id="block_id" class="form-control" disabled>
                <option value="-">-</option>
                @foreach($hostel->floors as $floor)
                  @foreach($floor->blocks as $block)
                    <option floor_id="{{ $floor->id }}" value="{{ $block->id }}">{{ $block->number}}</option>
                  @endforeach
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="number">Номер кімнати</label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control" id="number" name="number" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="liver_max">Кількість місць</label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control" id="liver_max" name="liver_max" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="price">Плата</label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control" id="price" name="price" required>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="price_summer">Плата влітку</label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control" id="price_summer" name="price_summer" required>
            </div>
          </div>
          <button type="submit" class="btn btn-default">Зберегти</button>
        </form>
      </div>
    </div>
@endsection

@section('script')
  <script>
    $(function () {
        let floorId = $('#floor_id');
        let blockId = $('#block_id');
        floorId.change(function(e) {
            floorId.find('option[value="-"]').hide();
            let specialty = parseInt(e.target.value);
            blockId.prop('disabled', !specialty);
            blockId.find('option[floor_id!="' + specialty + '"]').hide();
            blockId.find('option[floor_id="' + specialty + '"]').show();
            blockId.val('-');
        });
        $('#create_room').submit(function (e) {
            if (blockId.val() === '-')
              e.preventDefault();
        })
    });
  </script>
@endsection