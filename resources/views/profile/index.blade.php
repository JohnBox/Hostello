@extends('profile.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Профіль</div>
    <div class="panel-body">
      <div class="col-md-12">
        <div class="form-group col-md-4">
          <label for="last_name">Прізвище</label>
          <p class="form-control-static">{{ $profile->last_name }}</p>
        </div>
        <div class="form-group col-md-4">
          <label for="first_name">Ім’я</label>
          <p class="form-control-static">{{ $profile->first_name }}</p>
        </div>
        <div class="form-group col-md-4">
          <label for="second_name">По батькові</label>
          <p class="form-control-static">{{ $profile->second_name }}</p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group col-md-4">
          <label for="birth_date">Дата народження</label>
          <p class="form-control-static">{{ $profile->birth_date }}</p>
        </div>
        <div class="form-group col-md-4">
          <label for="gender">Стать</label>
          <p class="form-control-static">@if($profile->gender)Чоловіча @elseЖіноча @endif</p>
        </div>
        <div class="form-group col-md-4">
          <label for="bad_habit">Шкідливі звички</label>
          <p class="form-control-static">@if($profile->bad_habit)Так @elseНі @endif</p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group col-md-4">
          <label for="is_student">Студент</label>
          <p class="form-control-static">@if($profile->group)Так @elseНі @endif</p>
        </div>
        <div class="form-group col-md-4" style="background: #aaa;">
          <label for="doc_number">Номер @if($profile->group) студентського квитка @else паспорта @endif </label>
          <p class="form-control-static">{{ $profile->doc_number }}</p>
        </div>
        <div class="form-group col-md-4">
          <label for="phone">Телефон</label>
          <p class="form-control-static">{{ $profile->phone }}</p>
        </div>
      </div>
      @if($profile->group)
        <div class="col-md-12">
          <div class="form-group col-md-4">
            <label for="faculty">Факультет</label>
            <p class="form-control-static">{{ $profile->group->course->specialty->faculty->name }}</p>
          </div>
          <div class="form-group col-md-4">
            <label for="specialty">Спеціальність</label>
            <p class="form-control-static">{{ $profile->group->course->specialty->name }}</p>
          </div>
          <div class="form-group col-md-2">
            <label for="course">Курс</label>
            <p class="form-control-static">{{ $profile->group->course->number }}</p>
          </div>
          <div class="form-group col-md-2">
            <label for="group">Група</label>
            <p class="form-control-static">{{ $profile->group->name }}</p>
          </div>
        </div>
      @endif
      <div class="col-md-12">
        <div class="form-group col-md-4">
          <label for="room">Кімната</label>
          <p class="form-control-static">@if($profile->room){{ $profile->room->number }}@else -@endif</p>
        </div>
        <div class="form-group col-md-4">
          <label for="payments">Несплати за проживання</label>
          <p class="form-control-static">{{ count($profile->payments) }}</p>
        </div>
        <div class="form-group col-md-4">
          <label for="violations">Несплати на порушення</label>
          <p class="form-control-static">{{ count($profile->violations)}}</p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group col-md-4">
          <label for="faculty">Баланс</label>
          <p class="form-control-static">{{ $profile->balance }}</p>
        </div>
      </div>
    </div>
  </div>
@endsection