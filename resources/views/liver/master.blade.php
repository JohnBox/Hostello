@extends('layouts.app')

@section('nav')
    <li class="active"><a href="{{ route('livers.index') }}">Проживаючі</a></li>
    <li><a href="{{ route('rooms.index') }}">Кімнати</a></li>
    <li><a href="{{ route('violations.index') }}">Порушення</a></li>
    <li><a href="{{ route('payments.index') }}">Нарахування</a></li>
    <li><a href="{{ route('injections.index') }}">Заселення</a></li>
    <li><a href="{{ route('ejections.index') }}">Виселення</a></li>
    <li><a href="{{ route('universities.index') }}">Університет</a></li>
    <li><a href="{{ route('hostels.index') }}">Гуртожитки</a></li>
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