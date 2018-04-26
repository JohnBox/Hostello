@extends('liver.master')

@section('content')
  <div class="panel panel-default" style="overflow: hidden;">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ url('/livers') }}">Проживаючі</a></li>
        <li class="active">Перегляд</li>
      </ol>
    </div>
    <div class="panel-body">
      <ul id="tabs" class="nav nav-tabs">
        <li role="presentation" class="active"><a class="0">Обовязкові дані</a></li>
        <li role="presentation"><a class="1">Адреса проживання</a></li>
        <li role="presentation"><a class="2">Паспортні дані</a></li>
        <li role="presentation"><a class="3">Контакти</a></li>
      </ul>
      <form class="show" onsubmit="return false;">
        <br/>
        <div class="t">
          <div class="form-group col-md-6">
            <label for="last_name">Прізвище</label>
            <p class="form-control-static">{{ $liver->last_name }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="first_name">Ім’я</label>
            <p class="form-control-static">{{ $liver->first_name }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="parent_name">По батькові</label>
            <p class="form-control-static">{{ $liver->parent_name }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="birth">Дата народження</label>
            <p class="form-control-static">{{ $liver->birth }}</p>
          </div>
          <div class="form-group col-md-6">
            <div class="col-md-7">
              <div class="avatar">
                <img src="{{ asset('/image/php7.jpeg') }}" alt=""/>
              </div>
            </div>
            <div class="col-md-5">
              <label for="sex">Стать</label>
              <p class="form-control-static">@if($liver->sex) Чоловіча @else Жіноча @endif</p>
              <label for="sex">&nbsp;</label>
              <p class="form-control-static">@if ($liver->student) Студент @endif</p>
            </div>
          </div>
          @if($liver->student)
          <div id="st">
            <div class="form-group col-md-6">
              <label for="facult">Факультет</label>
              <p class="form-control-static">{{ $liver->group->facult->name }}</p>
            </div>
            <div class="form-group col-md-6">
              <label for="group">Група</label>
              <p class="form-control-static">{{ $liver->group->facult->short_name }}-{{ $liver->group->course }}{{ $liver->group->number }}</p>
            </div>
          </div>
          @endif
        </div>
        <div class="t hidden">
          <div class="form-group col-md-6">
            <label for="country">Країна</label>
            <p class="form-control-static">{{ $liver->country }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="canton">Область</label>
            <p class="form-control-static">{{ $liver->canton }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="city">Місто/Село</label>
            <p class="form-control-static">{{ $liver->city }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="street">Вулиця</label>
            <p class="form-control-static">{{ $liver->street }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="house">Будинок</label>
            <p class="form-control-static">{{ $liver->house }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="apart">Квартира</label>
            <p class="form-control-static">{{ $liver->apart }}</p>
          </div>
        </div>
        <div class="t hidden">
          <div class="form-group col-md-6">
            <label for="series">Серія</label>
            <p class="form-control-static">{{ $liver->series }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="number">Номер</label>
            <p class="form-control-static">{{ $liver->number }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="which">Ким виданий</label>
            <p class="form-control-static">{{ $liver->which }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="when">Коли виданий</label>
            <p class="form-control-static">{{ $liver->when }}</p>
          </div>
        </div>
        <div class="t hidden">
          <div class="form-group col-md-6">
            <label for="tel1">Телефон №1</label>
            <p class="form-control-static">{{ $liver->tel1 }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="tel2">Телефон №2</label>
            <p class="form-control-static">{{ $liver->tel2 }}</p>
          </div>
          <div class="form-group col-md-6">
            <label for="tel3">Телефон №3</label>
            <p class="form-control-static">{{ $liver->tel3 }}</p>
          </div>
        </div>
        <div class="form-group col-md-12">
          <a href="{{ url('/livers/settle') }}/{{ $liver->id }}" id="settle" class="btn btn-default">Переселити</a>
          <a href="{{ url('/livers/remove') }}/{{ $liver->id }}" id="remove" class="btn btn-default" style="color: #f66">Виселити</a>
          <a href="{{ url('/livers/money') }}/{{ $liver->id }}" id="remove" class="btn btn-default">Поповнити рахунок</a>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
    var tabs = document.getElementById('tabs').getElementsByTagName('li');
    var divs = document.getElementsByClassName('t');
    for (var i=0;i<tabs.length;i++) {
      tabs[i].onclick = function (e) {
        for (var i=0;i<tabs.length;i++) {
          tabs[i].classList.remove('active');
          divs[i].classList.add('hidden');
        }
        var curr = parseInt(e.target.className);
        tabs[curr].classList.add('active');
        divs[curr].classList.remove('hidden');
      }
    }
    var form = document.forms[0];
    var b = document.getElementById('submit');
    b.onclick = function (e) {
      var currtab = document.getElementById('tabs').getElementsByClassName('active')[0];
      var next = parseInt(currtab.getElementsByTagName('a')[0].className)+1;
      tabs[next].onclick({target: tabs[next].getElementsByTagName('a')[0]});
    };

    var student = document.getElementById('student');
    var div = document.getElementById('st');
    student.onchange = function (e) {
      if (e.target.checked) {
        div.classList.remove('hidden');
      } else {
        div.classList.add('hidden');
      }
    };
    if (student.checked) {
      div.classList.remove('hidden');
    } else {
      div.classList.add('hidden');
    }

  </script>
@endsection

