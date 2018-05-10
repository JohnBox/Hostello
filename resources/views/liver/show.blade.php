@extends('liver.master')

@section('content')
  <div class="panel panel-default" style="overflow: hidden;">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ route('livers.index') }}">Проживаючі</a></li>
        <li class="active">Перегляд</li>
      </ol>
    </div>
    <div class="panel-body">
      <div class="show">
        <div class="form-group col-md-6">
          <div class="col-md-6">
            <div class="avatar">
              <img src="{{ asset('/images/avatar.jpg') }}" alt=""/>
            </div>
          </div>
        </div>
          <div class="form-group col-md-6">
            <label for="last_name">Прізвище</label>
            <p class="form-control-static">{{ $liver->last_name }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="first_name">Ім’я</label>
            <p class="form-control-static">{{ $liver->first_name }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="second_name">По батькові</label>
            <p class="form-control-static">{{ $liver->second_name }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="birth_date">Дата народження</label>
            <p class="form-control-static">{{ $liver->birth_date }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="gender">Стать</label>
            <p class="form-control-static">@if($liver->gender)Чоловіча @elseЖіноча @endif</p>
            <label for="is_student">Студент</label>
            <p class="form-control-static">@if($liver->is_student)Так @elseНі @endif</p>
            <label for="bad_habit">Шкідливі звички</label>
            <p class="form-control-static">@if($liver->bad_habit)Так @elseНі @endif</p>
          </div>
          @if($liver->is_student)
            <div class="form-group col-md-6">
              <label for="faculty">Факультет</label>
              <p class="form-control-static">{{ $liver->group->course->specialty->faculty->name }}</p>
            </div>
            <div class="form-group col-md-6">
              <label for="specialty">Спеціальність</label>
              <p class="form-control-static">{{ $liver->group->course->specialty->name }}</p>
            </div>
              <div class="form-group col-md-6">
                <label for="course">Курс</label>
                <p class="form-control-static">{{ $liver->group->course->number }}</p>
              </div>
            <div class="form-group col-md-6">
              <label for="group">Група</label>
              <p class="form-control-static">{{ $liver->group->name }}</p>
            </div>
          @endif
        <div class="form-group col-md-6">
          <label for="doc_number">Документ</label>
          <p class="form-control-static">{{ $liver->doc_number }}</p>
        </div>
        <div class="form-group col-md-6">
          <label for="phone">Телефон</label>
          <p class="form-control-static">{{ $liver->phone }}</p>
        </div>
            <div class="form-group col-md-6">
              <label for="room">Кімната</label>
                <p class="form-control-static">
                  @if($liver->is_active)<a href="{{ route('rooms.show', ['room' => $liver->room]) }}">{{ $liver->room->number }}</a> @else - @endif
                </p>
            </div>
        </div>
        <div class="form-group col-md-12">
          @if($liver->is_active)
            <a href="{{ route('injections.create', ['liver' => $liver]) }}" id="settle" class="btn btn-default">Переселити</a>
            <a href="{{ route('ejections.create', ['liver' => $liver]) }}" id="remove" class="btn btn-default" style="color: #f66">Виселити</a>
          @else
            <a href="{{ route('injections.create', ['liver' => $liver]) }}" id="settle" class="btn btn-default">Заселити</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection