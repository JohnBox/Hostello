@extends('room.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Кімнати</div>
    <div class="panel-body">
      <ul class="nav nav-tabs">
        @foreach($floors as $floor)
          @if ($current == $floor)
            <li role="presentation" class="active"><a href="{{ route('rooms.floor', ['id' => $floor->id]) }}/">Поверх {{$floor->number}}</a></li>
          @else
            <li role="presentation"><a href="{{ route('rooms.floor', ['id' => $floor->id]) }}/">Поверх {{$floor->number}}</a></li>
          @endif
        @endforeach
      </ul>
      @foreach($blocks as $block)
        <div class="block">
          <h3 class="text-left">Блок {{ $block->number }}</h3>
          <div class="room_container">
            <ul>
              @foreach($rooms[$block->id] as $room)
              <li>
                <a class='normal' href="{{ url('/rooms/show') }}/{{ $room->id }}">
                  <span class="number">{{ $room->number }}<br/>
                    <span class="count">{{ $room->livers()->count() }}/{{ $room->liver_max }}</span>
                  </span>
                </a>
                <div class='info'>
                  <h3>
                    @foreach($room->livers as $l)
                      {{ $l->last_name }} {{ $l->first_name }} {{ $l->parent_name }}
                      @if($l->student)
                        {{ $l->group->number }}
                      @endif
                      <br/>
                    @endforeach
                  </h3>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
        <hr>
        @endforeach
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    var room_containers = document.getElementsByClassName('room_container');
    [].forEach.call(room_containers, function (room_container) {

    var nodes  = room_container.querySelectorAll('li'),
        _nodes = [].slice.call(nodes, 0);
    var getDirection = function (e, obj) {
      var xDir, yDir;
      var jEl = $(obj),
      w = jEl.outerWidth(),
      h = jEl.outerHeight(),
      off = jEl.offset(),
      x = e.pageX - off.left,
      y = e.pageY - off.top,
      xShift, // сдвиг от правой или левой границы
      yShift, // сдвиг от верхней или нижней границы
      xText,
      yText,
      itogText;
      if (x / w > .5) {
        xShift = w - x;
        xText = 'справа';
        xDir = 1;

      } else {
        xShift = x;
        xText = 'слева';
        xDir = 3;
      }
      if (y / h > .5) {
        yShift = h - y;
        yText = 'снизу';
        yDir = 2;
      } else {
        yShift = y;
        yText = 'сверху';
        yDir = 0;
      }
      itogText = (xShift < yShift) ? xText : yText;
      var dir = (xShift < yShift) ? xDir : yDir;
      return dir;
    };
    var addClass = function ( ev, obj, state ) {
      var direction = getDirection( ev, obj ),
          class_suffix = "";
      obj.className = "";
      switch ( direction ) {
        case 0 : class_suffix = '-top';    break;
        case 1 : class_suffix = '-right';  break;
        case 2 : class_suffix = '-bottom'; break;
        case 3 : class_suffix = '-left';   break;
      }
      obj.classList.add( state + class_suffix );
    };
    _nodes.forEach(function (el) {
      el.addEventListener('mouseover', function (ev) {
        addClass( ev, this, 'in' );
      }, false);
      el.addEventListener('mouseout', function (ev) {
        addClass( ev, this, 'out' );
      }, false);
    });

    });
  </script>
@endsection