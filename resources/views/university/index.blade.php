@extends('university.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Налаштування університету</div>
    <div class="panel-body">
      @unless($university)
        <div class="alert alert-danger" role="alert">Університет не налаштовано.</div>
        <a class="btn btn-default" href="{{ route('universities.create') }}" role="button">Налаштувати</a>
      @else
        <hr>
        <h4>Університет</h4>
        <hr>
        <div class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-2" for="name">Назва закладу</label>
            <div class="col-md-10">
              <p class="form-control-static">{{ $university->name }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="address">Адреса</label>
            <div class="col-md-10">
              <p class="form-control-static">{{ $university->address }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="phone">Телефон</label>
            <div class="col-md-10">
              <p class="form-control-static">{{ $university->phone }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="merchant">Мерчант акаунт</label>
            <div class="col-md-10">
              <p class="form-control-static">{{ $university->merchant }}</p>
            </div>
          </div>
          <a class="btn btn-default" href="{{ route('universities.edit', ['university' => $university]) }}" role="button">Редагувати</a>
        </div>

        <hr>
        <h4>Факультети</h4>
        <hr>
        <a class="btn btn-default" href="{{ route('faculties.create') }}" role="button">Створити новий</a>
        <br>
        <br>
        <table class="table table-striped table-hover">
          <th>
            <td>Назва</td>
            <td>X</td>
            <td>X</td>
          </th>
            @foreach($faculties as $faculty)
              <tr>
                <td></td>
                <td>{{$faculty->name}}</td>
                <td><a href="{{ route('faculties.edit', ['$faculty' => $faculty]) }}">E</a></td>
                <td>
                  {{ Form::open([ 'method'  => 'delete', 'route' => [ 'faculties.destroy', $faculty ] ]) }}
                  {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
                  {{ Form::close() }}
                </td>
              </tr>
            @endforeach
          </table>
        <hr>
        <h4>Спеціальності</h4>
        <hr>
        <a class="btn btn-default" href="{{ route('specialties.create') }}" role="button">Створити новий</a>
        <br>
        <br>
        <table class="table table-striped table-hover">
          <th>
          <td>Назва</td>
          <td>Факультет</td>
          <td>Кількість курсів</td>
          <td>X</td>
          <td>X</td>
          </th>
          @foreach($specialties as $specialty)
            <tr>
              <td></td>
              <td>{{ $specialty->name }}</td>
              <td>{{ $specialty->faculty->short_name() }}</td>
              <td>{{ $specialty->years_of_study }}</td>
              <td><a href="{{ route('specialties.edit', ['specialty' => $specialty]) }}">E</a></td>
              <td>
                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'specialties.destroy', $specialty ] ]) }}
                {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        </table>
        <hr>
        <h4>Групи</h4>
        <hr>
        <a class="btn btn-default" href="{{ route('groups.create') }}" role="button">Створити новий</a>
        <br>
        <br>
        <table class="table table-striped table-hover">
          <th>
          <td>Назва</td>
          <td>Курс</td>
          <td>Спеціальність</td>
          <td>X</td>
          <td>X</td>
          </th>
          @foreach($groups as $group)
            <tr>
              <td></td>
              <td>{{ $group->name }}</td>
              <td>{{ $group->course->number }}</td>
              <td>{{ $group->course->specialty->name }}</td>
              <td><a href="{{ route('groups.edit', ['group' => $group]) }}">E</a></td>
              <td>
                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'groups.destroy', $group ] ]) }}
                {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        </table>
      @endunless
      </div>
    </div>
@endsection