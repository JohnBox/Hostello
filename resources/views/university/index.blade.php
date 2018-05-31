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
            <div class="col-md-2">
              <label class="control-label" for="name">Назва закладу</label>
            </div>
            <div class="col-md-10">
              <p class="form-control-static">{{ $university->name }}</p>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-2">
              <label class="control-label" for="address">Адреса</label>
            </div>
            <div class="col-md-10">
              <p class="form-control-static">{{ $university->address }}</p>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-2">
              <label class="control-label" for="phone">Телефон</label>
            </div>
            <div class="col-md-10">
              <p class="form-control-static">{{ $university->phone }}</p>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-2">
              <label class="control-label" for="merchant">Мерчант акаунт</label>
            </div>
            <div class="col-md-10">
              <p class="form-control-static">{{ $university->merchant }}</p>
            </div>
          </div>
          <a class="btn btn-default" href="{{ route('universities.edit', ['university' => $university]) }}" role="button">Редагувати</a>
        </div>

        <hr>
        <h4>Факультети</h4>
        <hr>
        <a class="btn btn-default" href="{{ route('faculties.create') }}" role="button">Створити</a>
        <br>
        <br>
        <table class="table table-striped table-hover">
          <tr>
            <th>Назва</th>
            <th></th>
            <th></th>
          </tr>
            @foreach($faculties as $faculty)
              <tr>
                <td>{{$faculty->name}}</td>
                <td><a href="{{ route('faculties.edit', ['$faculty' => $faculty]) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td><a href="{{ route('faculties.destroy', ['$faculty' => $faculty]) }}"><span class="glyphicon glyphicon-remove"></span></a></td>
              </tr>
            @endforeach
          </table>
        <hr>
        <h4>Спеціальності</h4>
        <hr>
        <a class="btn btn-default" href="{{ route('specialties.create') }}" role="button">Створити</a>
        <br>
        <br>
        <table class="table table-striped table-hover">
          <tr>
            <th>Назва</th>
            <th>Факультет</th>
            <th>Кількість курсів</th>
            <th></th>
            <th></th>
          </tr>
          @foreach($specialties as $specialty)
            <tr>
              <td>{{ $specialty->name }}</td>
              <td>{{ $specialty->faculty->short_name() }}</td>
              <td>{{ $specialty->years_of_study }}</td>
              <td><a href="{{ route('specialties.edit', ['specialty' => $specialty]) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
              <td><a href="{{ route('specialties.destroy', ['specialty' => $specialty]) }}"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
          @endforeach
        </table>
        <hr>
        <h4>Групи</h4>
        <hr>
        <a class="btn btn-default" href="{{ route('groups.create') }}" role="button">Створити</a>
        <br>
        <br>
        <table class="table table-striped table-hover">
          <tr>
            <th>Назва</th>
            <th>Курс</th>
            <th>Спеціальність</th>
            <th></th>
            <th></th>
          </tr>
          @foreach($groups as $group)
            <tr>
              <td>{{ $group->name }}</td>
              <td>{{ $group->course->number }}</td>
              <td>{{ $group->course->specialty->name }}</td>
              <td><a href="{{ route('groups.edit', ['group' => $group]) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
              <td><a href="{{ route('groups.destroy', ['group' => $group]) }}"><span class="glyphicon glyphicon-remove"></span></a>
              </td>
            </tr>
          @endforeach
        </table>
      @endunless
      </div>
    </div>
@endsection