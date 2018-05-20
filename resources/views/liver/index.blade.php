@extends('liver.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Проживаючі</div>
    <div class="panel-body">
      <ul class="nav nav-tabs">
        @if($filter['state'] == 'active')
          <li role="presentation"><a href="{{ route('livers.index') }}">Всі</a></li>
          <li role="presentation" class="active"><a>Заселені</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['state' => 'nonactive']) }}">Незаселені</a></li>
        @elseif($filter['state'] == 'nonactive')
          <li role="presentation"><a href="{{ route('livers.index') }}">Всі</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['state' => 'active']) }}">Заселені</a></li>
          <li role="presentation" class="active"><a>Незаселені</a></li>
        @else
          <li role="presentation" class="active"><a>Всі</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['state' => 'active']) }}">Заселені</a></li>
          <li role="presentation"><a href="{{ route('livers.index', ['state' => 'nonactive']) }}">Незаселені</a></li>
        @endif
      </ul>
      <br/>
      @if(Auth::user()->profile)
        <a type="button" class="btn btn-sm btn-default" href="{{ route('livers.create') }}">Створити новий</a>
        <br/>
        <br/>
      @endif
      <form class="form-inline" id="search_form" action="{{ route('livers.index') }}" method="get">
        <div class="form-group">
          <label for="q">Ім'я</label>
          <input type="text" name="q" id="q">
        </div>
        <button type="submit" class="btn btn-default btn-sm">Пошук</button>
      </form>
      <br>
      <table class="table table-striped">
        <tr>
          <th>Прізвище Ім’я По батькові</th>
          <th>Дата народження</th>
          <th>Стать</th>
          <th>Студент</th>
          <th>Кімната</th>
          @if(Auth::user()->profile)
          <th></th>
          <th></th>
          @endif
        </tr>
            @foreach($livers as $liver)
          <tr>
            <td>
              <a href="{{ route('livers.show', ['liver' => $liver]) }}">
                {{ $liver->full_name() }}
              </a>
            </td>
            <td>{{ $liver->birth_date }}</td>
            <td>@if($liver->gender) Чоловіча @else Жіноча @endif</td>
            <td>
              @if($liver->group)
                {{ $liver->group->name }}
              @else
                -
              @endif
            </td>
            <td>
              @if($liver->room)
                {{ $liver->room->number }}
              @else
                @if(Auth::user()->profile)
                  <a type="button" class="btn btn-xs btn-default" href="{{ route('injections.create', ['liver' => $liver]) }}">Заселити</a>
                @else
                  -
                @endif
              @endif
            </td>
            @if(Auth::user()->profile)
            <td><a href="{{ route('livers.edit', ['liver' => $liver]) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a href="{{ route('livers.destroy', ['liver' => $liver]) }}"><span class="glyphicon glyphicon-minus"></span></a></td>
            @endif
          </tr>
        @endforeach
      </table>
      @if($filter['state'] == 'active')
        {{ $livers->appends(['state' => 'active'])->links() }}
      @elseif($filter['state'] == 'nonactive')
        {{ $livers->appends(['state' => 'nonactive'])->links() }}
      @else
       {{ $livers->links() }}
      @endif
    </div>
  </div>
@endsection

@section('script')
  <script>
      $(function()
      {
          $("#q").autocomplete({
              source: "livers/autocomplete?state={{$filter['state']}}",
              select: function(event, ui) {
                  $('#q').val(ui.item.value);
                  $('#q').attr('qid', ui.item.id)
              }
          });
          $('#search_form').submit(function (e) {
              $('#q').val($('#q').attr('qid'));
          })
      });
  </script>
@endsection