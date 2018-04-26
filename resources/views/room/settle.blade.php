@extends('room.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Кімнати</div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/livers/settle') }}" class="hidden">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $liver->id }}"/>
        <input type="hidden" name="room" id="room" value=""/>
      </form>
      <div id="room_container">
        <ul>
        @foreach($rooms as $room)
            <li>
              <a class='normal'>
                <span class="number">{{ $room->number }}<br/>
                  <span class="count">{{ $room->livers()->count() }}/{{ $room->liver_max }}</span>
                </span>
              </a>
              <div class='info'>
                <h3>
                  @foreach($room->livers as $l)
                    {{ $l->last_name }} {{ $l->first_name }}
                    {{ $l->group->facult->short_name }}-{{ $l->group->course }}{{ $l->group->number }}
                    <br/>
                  @endforeach
                </h3>
              </div>
            </li>
        @endforeach
        </ul>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    var room_container = document.getElementById('room_container');
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
      xShift,
      yShift;
      if (x / w > .5) {
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
      return (xShift < yShift) ? xDir : yDir;;
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
    var form = document.forms[0];
    _nodes.forEach(function (el) {
      el.addEventListener('mouseover', function (ev) {
        addClass( ev, this, 'in' );
      }, false);
      el.addEventListener('mouseout', function (ev) {
        addClass( ev, this, 'out' );
      }, false);
      el.addEventListener('click', function (ev) {
        var room =$('#room');
        var livers = ev.target.getElementsByTagName('span')[0].getElementsByTagName('span')[0].innerHTML.split('/');
        if (livers[0] != livers[1]) {
          room.val(parseInt(ev.target.getElementsByTagName('span')[0].innerHTML));
          form.submit();
        }
      })
    });
  </script>
@endsection