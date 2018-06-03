@extends('room.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Кімнати</div>
    <div class="panel-body">
      <ul class="nav nav-tabs">
        @foreach($floors as $floor)
          <li role="presentation" @if ($current == $floor) class="active" @endif>
            <a href="{{ route('injections.create', ['liver' => $liver->id, 'floor' => $floor->id]) }}/">Поверх {{$floor->number}}</a>
          </li>
        @endforeach
      </ul>
      @foreach($current->blocks as $block)
        <div class="block">
          <h3 class="text-left">Блок {{ $block->number }}</h3>
          <div class="room_container">
            <ul>
              @foreach($block->rooms as $room)
                <li>
                  <div id="{{$room->id}}" class='normal'>
                  <span class="number">{{ $room->number }}<br/>
                    <span class="count">{{ $room->livers()->count() }}/{{ $room->liver_max }}</span>
                  </span>
                  </div>
                  <div class='info'>
                    <h4>
                      @foreach($room->livers as $room_liver)
                        {{ $room_liver->short_name() }}
                        @if($room_liver->group)
                          {{ $room_liver->group->name }}
                        @endif
                        <br/>
                      @endforeach
                    </h4>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <hr>
      @endforeach
      <form id="settle" method="POST" action="{{ route('injections.store', ['update' => $update]) }}" class="hidden">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="liver_id" id="liver_id" value="{{$liver->id}}"/>
        <input type="hidden" name="room_id" id="room_id" value=""/>
      </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
      $('.room_container').each(function (i, roomContainer) {
          let rooms = [].slice.call(roomContainer.querySelectorAll('li'), 0);
          function getDirection(e, obj) {
              let xDir, yDir;
              let jEl = $(obj),
                  w = jEl.outerWidth(),
                  h = jEl.outerHeight(),
                  off = jEl.offset(),
                  x = e.pageX - off.left,
                  y = e.pageY - off.top,
                  xShift, // сдвиг от правой или левой границы
                  yShift; // сдвиг от верхней или нижней границы
              if (x / w > 0.5) {
                  xShift = w - x;
                  xDir = 1;
              } else {
                  xShift = x;
                  xDir = 3;
              }
              if (y / h > .5) {
                  yShift = h - y;
                  yDir = 2;
              } else {
                  yShift = y;
                  yDir = 0;
              }
              return (xShift < yShift) ? xDir : yDir;
          }
          function addClass(ev, obj, state) {
              let direction = getDirection(ev, obj), class_suffix = "";
              switch (direction) {
                  case 0 : class_suffix = '-top';    break;
                  case 1 : class_suffix = '-right';  break;
                  case 2 : class_suffix = '-bottom'; break;
                  case 3 : class_suffix = '-left';   break;
              }
              obj.className = "";
              obj.classList.add( state + class_suffix );
          }
          rooms.forEach(function (el) {
              el.addEventListener('mouseover', function (e) {
                  addClass( e, this, 'in' );
              }, false);
              el.addEventListener('mouseout', function (e) {
                  addClass( e, this, 'out' );
              }, false);
              el.addEventListener('click', function (e) {
                  let [curr_count, max_count] = e.target.getElementsByTagName('span')[0].getElementsByTagName('span')[0].innerHTML.split('/');
                  if (curr_count < max_count) {
                      $('#room_id').val($(e.target).attr('id'));
                      $('#liver_id').val('{{$liver->id}}');
                      $('#settle').submit();
                  }
              })
          });
      });
  </script>
@endsection