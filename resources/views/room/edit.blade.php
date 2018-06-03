@extends('room.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Редагування</div>
      <div class="panel-body">
        <form id="edit_room" class="form-horizontal" method="POST" action="{{ route('rooms.update', ['room' => $room]) }}">
          @method('PUT')
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="floor_id">Поверх</label>
            </div>
            <div class="col-md-9">
              <select name="floor_id" id="floor_id" class="form-control">
                @foreach($room->hostel->floors as $floor)
                  <option value="{{ $floor->id }}" @if($room->block->floor == $floor) selected @endif>{{ $floor->number }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="block_id">Блок</label>
            </div>
            <div class="col-md-9">
              <select name="block_id" id="block_id" class="form-control">
                <option value="-">-</option>
                @foreach($room->hostel->floors as $floor)
                  @foreach($floor->blocks as $block)
                    <option floor_id="{{ $floor->id }}" value="{{ $block->id }}" @if($room->block->id == $block->id) selected @endif>{{ $block->number}}</option>
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
              <input type="text" class="form-control" id="number" name="number" required value="{{ $room->number }}">
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="liver_max">Кількість місць</label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control" id="liver_max" name="liver_max" required value="{{ $room->liver_max }}">
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="price">Плата</label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control" id="price" name="price" required value="{{ $room->price }}">
            </div>
          </div>

          <div class="form-group required">
            <div class="col-md-3">
              <label class="control-label" for="price_summer">Плата влітку</label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control" id="price_summer" name="price_summer" required value="{{ $room->price_summer }}">
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
        blockId.find('option[value="-"]').hide();
        blockId.find('option[floor_id!="' + floorId.val() + '"]').hide();
        blockId.find('option[floor_id="' + floorId.val() + '"]').show();
        floorId.change(function(e) {
            blockId.find('option[value="-"]').show();
            let specialty = parseInt(e.target.value);
            blockId.find('option[floor_id!="' + specialty + '"]').hide();
            blockId.find('option[floor_id="' + specialty + '"]').show();
            blockId.val('-');
        });
        $('#edit_room').submit(function (e) {
            if (blockId.val() === '-')
              e.preventDefault();
        })
    });
  </script>
@endsection