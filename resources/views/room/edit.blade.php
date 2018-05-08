@extends('room.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Редагування</div>
      <div class="panel-body">
        <form id="edit_room" class="form-horizontal" method="POST" action="{{ route('rooms.update', ['room' => $room]) }}">
          @method('PUT')
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group required">
            <label class="control-label col-md-2" for="floor_id">Поверх</label>
            <div class="col-md-10">
              <select name="floor_id" id="floor_id" class="form-control">
                @foreach($floors as $floor)
                  <option value="{{ $floor->id }}" @if($room->block->floor == $floor) selected @endif>{{ $floor->number }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="block_id">Блок</label>
            <div class="col-md-10">
              <select name="block_id" id="block_id" class="form-control">
                <option value="-">-</option>
                @foreach($floors as $floor)
                  @foreach($floor->blocks as $block)
                    <option floor_id="{{ $floor->id }}" value="{{ $block->id }}" @if($room->block->id == $block->id) selected @endif>{{ $block->number}}</option>
                  @endforeach
                @endforeach
              </select>
            </div>
          </div>
            <div class="form-group required">
              <label class="control-label col-md-2" for="number">Номер кімнати</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="number" name="number" value="{{ $room->number }}" required>
              </div>
            </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="liver_max">Кількість місць</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="liver_max" name="liver_max" value="{{ $room->liver_max }}" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label col-md-2" for="area">Площа</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="area" name="area" value="{{ $room->area }}" required>
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