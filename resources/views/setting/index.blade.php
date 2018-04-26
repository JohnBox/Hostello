@extends('setting.master')

@section('content')
        <div class="panel panel-default">
          <div class="panel-heading">Гуртожитки</div>
          <div class="panel-body">
            <a type="button" class="btn btn-sm btn-default" href="{{ url('settings/create-hostel') }}">Створити новий</a>
            <br/>
            <br/>
            <table class="table table-striped">
              <tr>
                <th>Назва</th>
                <th>Адреса</th>
                <th>Телефон</th>
                <th>Площа, м2</th>
                <th></th>
                <th></th>
              </tr>
              @foreach($hostels as $hostel)
                <tr>
                  <td>{{ $hostel->name }}</td>
                  <td>{{ $hostel->address }}</td>
                  <td>{{ $hostel->phone }}</td>
                  <td>{{ $hostel->area }}</td>
                  <td><a href="{{ url('settings/edit-hostel') }}/{{ $hostel->id }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                  <td><a href="{{ url('settings/delete-hostel') }}/{{ $hostel->id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Коменданти</div>
          <div class="panel-body">
            <a type="button" class="btn btn-sm btn-default" href="{{ url('settings/create-user') }}">Створити новий</a>
            <br/>
            <br/>
            <table class="table table-striped">
              <tr>
                <th>Імя</th>
                <th>Ел. пошта</th>
                <th>Гуртожиток</th>
                <th></th>
                <th></th>
              </tr>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->hostel->name }}</td>
                  <td><a href="{{ url('settings/edit-user') }}/{{ $user->id }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                  <td><a href="{{ url('settings/delete-user') }}/{{ $user->id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Кімнати</div>
          <div class="panel-body">
            @if(count($rooms) == 0)
              <h3>Створення кімнат</h3>
              <form class="form-inline" method="POST" action="{{ url('settings/create-rooms') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label for="room_count">Кількість кімнат</label>
                  <input type="text" class="form-control" id="room_count" name="room_count" value="{{ old('room_count') }}">
                </div>
                <br/>
                <h5>Стандартні налаштування</h5>
                <div class="form-group">
                  <label for="liver_max">Кількість проживаючих</label>
                  <input type="text" class="form-control" id="liver_max" name="liver_max" value="{{ old('liver_max') }}">
                </div>
                <div class="form-group">
                  <label for="area">Площа</label>
                  <input type="text" class="form-control" id="area" name="area" value="{{ old('area') }}">
                </div>
                <br/>
                <button type="submit" class="btn btn-default">Створити</button>
              </form>
            @else
              <a href="{{ url('settings/delete-rooms') }}"><h5>Видалити кімнати</h5></a>
              <table class="table table-striped">
                <tr>
                  <th>Номер</th>
                  <th>Кількість проживаючих</th>
                  <th>Блок</th>
                  <th>Площа</th>
                  <th></th>
                  <th></th>
                </tr>
                @foreach($rooms as $room)
                  <tr>
                    <td>{{ $room->number }}</td>
                    <td>{{ $room->liver_max }}</td>
                    <td>{{ $room->block }}</td>
                    <td>{{ $room->area }}</td>
                    <td><a href="{{ url('settings/edit-room') }}/{{ $room->id }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                    <td><a href="{{ url('settings/delete-room') }}/{{ $room->id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                  </tr>
                @endforeach
              </table>
            @endif
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Факультети</div>
          <div class="panel-body">
            <a type="button" class="btn btn-sm btn-default" href="{{ url('settings/create-facult') }}">Створити новий</a>
            <br/>
            <br/>
            <table class="table table-striped">
              <tr>
                <th>Назва</th>
                <th>Коротка назва</th>
                <th>Тривалість навчання, роки</th>
                <th></th>
                <th></th>
              </tr>
              @foreach($faculties as $facult)
                <tr>
                  <td>{{ $facult->name }}</td>
                  <td>{{ $facult->short_name }}</td>
                  <td>{{ $facult->years }}</td>
                  <td><a href="{{ url('settings/edit-facult') }}/{{ $facult->id }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                  <td><a href="{{ url('settings/delete-facult') }}/{{ $facult->id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Групи</div>
          <div class="panel-body">
            <a type="button" class="btn btn-sm btn-default" href="{{ url('settings/create-group') }}">Створити новий</a>
            <br/>
            <br/>
            <table class="table table-striped">
              <tr>
                <th>Факультет</th>
                <th>Курс</th>
                <th>Номер</th>
                <th>Наставник</th>
                <th>Телефон</th>
                <th></th>
                <th></th>
              </tr>
              @foreach($groups as $group)
                <tr>
                  <td>{{ $group->facult->short_name }}</td>
                  <td>{{ $group->course }}</td>
                  <td>{{ $group->number }}</td>
                  <td>{{ $group->leader }}</td>
                  <td>{{ $group->phone }}</td>
                  <td><a href="{{ url('settings/edit-group') }}/{{ $group->id }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                  <td><a href="{{ url('settings/delete-group') }}/{{ $group->id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
@endsection