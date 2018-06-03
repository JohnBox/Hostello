@extends('liver.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Проживаючі</div>
    <div class="panel-body">
      <ul class="nav nav-tabs">
        @if($state == 'active')
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel]) }}">Всі</a></li>
          <li role="presentation" class="active"><a>Заселені</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel, 'state' => 'nonactive']) }}">Незаселені</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel, 'state' => 'ower']) }}">Боржники</a></li>
        @elseif($state == 'nonactive')
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel]) }}">Всі</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel, 'state' => 'active']) }}">Заселені</a></li>
          <li role="presentation" class="active"><a>Незаселені</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel, 'state' => 'ower']) }}">Боржники</a></li>
        @elseif($state == 'ower')
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel]) }}">Всі</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel, 'state' => 'active']) }}">Заселені</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel, 'state' => 'nonactive']) }}">Незаселені</a></li>
          <li role="presentation" class="active"><a>Боржники</a></li>
        @else
          <li role="presentation" class="active"><a>Всі</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel, 'state' => 'active']) }}">Заселені</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel, 'state' => 'nonactive']) }}">Незаселені</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['hostel' => $currentHostel, 'state' => 'ower']) }}">Боржники</a></li>
        @endif
      </ul>
      <br/>
      <form class="form-inline" id="search_form" action="{{ route('livers.index') }}" method="get">
        <div class="form-group">
          @if($hostels)
            <label for="hostel" class="control-label">Гуртожиток</label>
            <select name="hostel" id="hostel" class="form-control">
              @foreach($hostels as $hostel)
                <option value="{{ $hostel->id}}" @if($currentHostel == $hostel) selected @endif>{{ $hostel->name }}</option>
              @endforeach
            </select>
          @elseif(Auth::user()->profile)
            <a type="button" class="btn btn-default" href="{{ route('livers.create') }}">Створити</a>
          @endif
        </div>
        <div class="form-group">
          <label for="q" class="control-label">Ім'я</label>
          <input type="text" name="q" id="q" class="form-control">
        </div>
      </form>
      <br>
      <table class="table table-striped">
        <tr>
          <th>Прізвище Ім’я По батькові</th>
          <th>Кімната</th>
          <th>Дата народження</th>
          <th>Стать</th>
          <th>Студент</th>
          <th>Баланс</th>
          @if(Auth::user()->profile)
          <th></th>
          <th></th>
          @endif
        </tr>
        @foreach($livers as $liver)
          <tr>
            <td><a href="{{ route('livers.show', ['liver' => $liver]) }}">{{ $liver->full_name() }}</a></td>
            <td>@if($liver->room)<a href="{{ route('rooms.show', ['room' => $liver->room]) }}">{{ $liver->room->number }}</a>@else -@endif</td>
            <td>{{ $liver->birth_date }}</td>
            <td>@if($liver->gender) Чоловіча @else Жіноча @endif</td>
            <td>@if($liver->group){{ $liver->group->name }}@else -@endif</td>
            <td>{{ $liver->balance }}</td>
            @if(Auth::user()->profile)
            <td><a href="{{ route('livers.edit', ['liver' => $liver]) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td>
              {!! Form::open(['method' => 'Delete', 'route' => ['livers.destroy', $liver->id]]) !!}
              <button style="border: none; background-color: transparent;color: #428bca;" type="submit"><span class="glyphicon glyphicon-remove"></span></button>
              {!! Form::close() !!}
            </td>
            @endif
          </tr>
        @endforeach
      </table>
      @if($state == 'active')
        {{ $livers->appends(['state' => 'active'])->links() }}
      @elseif($state == 'nonactive')
        {{ $livers->appends(['state' => 'nonactive'])->links() }}
      @else
       {{ $livers->links() }}
      @endif
    </div>
  </div>
@endsection

@section('script')
  <script>
      $(function() {
          let q = $('#q'), form = $('#search_form'), hostel = $('#hostel');
          q.autocomplete({
              source: '{{route('livers.autocomplete')}}?hostel={{$currentHostel->id}}&state={{$state}}',
              select: function(event, ui) {
                  q.val(ui.item.id);
                  form.submit();
              }
          });
          hostel.change(function (e) {
              form.submit();
          });
      });
  </script>
@endsection