@extends('liver.master')

@section('content')
  <div class="panel panel-default" style="overflow: hidden;">
    <div class="panel-heading">
      <ol class="breadcrumb">
        <li><a href="{{ url('/livers') }}">Проживаючі</a></li>
        <li class="active">Редагування</li>
      </ol>
    </div>
    <div class="panel-body">
      <ul id="tabs" class="nav nav-tabs">
        <li role="presentation" class="active"><a class="0">Обовязкові дані</a></li>
        <li role="presentation"><a class="1">Адреса проживання</a></li>
        <li role="presentation"><a class="2">Паспортні дані</a></li>
        <li role="presentation"><a class="3">Контакти</a></li>
      </ul>
      <form method="POST" action="{{ url('/livers/edit') }}" onsubmit="return false;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $liver->id }}">
        <br/>
        <div class="t">
          <div class="form-group col-md-6">
            <label for="last_name">Прізвище</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $liver->last_name }}">
          </div>
          <div class="form-group col-md-6">
            <label for="first_name">Ім’я</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $liver->first_name }}">
          </div>
          <div class="form-group col-md-6">
            <label for="parent_name">По батькові</label>
            <input type="text" class="form-control" id="parent_name" name="parent_name" value="{{ $liver->parent_name }}">
          </div>
          <div class="form-group col-md-6">
            <label for="birth">Дата народження</label>
            <input type="date" class="form-control" id="birth" name="birth" placeholder="дд.мм.рр" value="{{ $liver->birth }}">
          </div>
          <div class="form-group col-md-6">
            <div class="col-md-7">
              <div class="avatar"><img src="{{ asset('/image/php7.jpeg') }}" alt=""/></div>
            </div>
            <div class="col-md-5">
              <label for="sex">Стать</label>
              <div class="radio">
                <label>
                  <input type="radio" name="sex" id="sex" value="1" @if($liver->sex) checked @endif>Чоловіча
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="sex" id="sex" value="0" @if(!$liver->sex) checked @endif>Жіноча
                </label>
              </div>
              <br/>
              <label for="student">&nbsp;</label>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="student" id="student" @if ($liver->student) checked @endif>Студент
                </label>
              </div>
            </div>
          </div>

          <div id="st" class="hidden">
            <div class="form-group col-md-6">
              <label for="facult">Факультет</label>
              <select class="form-control" name="facult" id="facult">
                <option value="0">-</option>
                @foreach($faculties as $facult)
                  @if($liver->student)
                    <option value="{{ $facult->id }}" @if($liver->group->facult->id == $facult->id) selected @endif>{{ $facult->name }}</option>
                  @else
                    <option value="{{ $facult->id }}">{{ $facult->name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="group">Група</label>
              <select class="form-control" name="group" id="group">
                <option value="0">-</option>
                @foreach($groups as $group)
                  @if($liver->student)
                    <option value="{{ $group->id }}" @if($liver->group->id == $group->id) selected @endif>{{ $group->facult->short_name }}-{{ $group->course }}{{ $group->number }}</option>
                  @else
                    <option value="{{ $group->id }}">{{ $group->facult->short_name }}-{{ $group->course }}{{ $group->number }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="t hidden">
          <div class="form-group col-md-6">
            <label for="country">Країна</label>
            <input type="text" class="form-control" name="country" value="{{ $liver->country }}">
          </div>
          <div class="form-group col-md-6">
            <label for="canton">Область</label>
            <input type="text" class="form-control" name="canton" value="{{ $liver->canton }}">
          </div>
          <div class="form-group col-md-6">
            <label for="city">Місто/Село</label>
            <input type="text" class="form-control" name="city" value="{{ $liver->city }}">
          </div>
          <div class="form-group col-md-6">
            <label for="street">Вулиця</label>
            <input type="text" class="form-control" name="street" value="{{ $liver->street }}">
          </div>
          <div class="form-group col-md-6">
            <label for="house">Будинок</label>
            <input type="text" class="form-control" name="house" value="{{ $liver->house }}">
          </div>
          <div class="form-group col-md-6">
            <label for="apart">Квартира</label>
            <input type="text" class="form-control" name="apart" value="{{ $liver->apart }}">
          </div>
        </div>
        <div class="t hidden">
          <div class="form-group col-md-6">
            <label for="series">Серія</label>
            <input type="text" class="form-control" name="series" value="{{ $liver->series }}">
          </div>
          <div class="form-group col-md-6">
            <label for="number">Номер</label>
            <input type="text" class="form-control" name="number" value="{{ $liver->number }}">
          </div>
          <div class="form-group col-md-6">
            <label for="which">Ким виданий</label>
            <input type="text" class="form-control" name="which" value="{{ $liver->which }}">
          </div>
          <div class="form-group col-md-6">
            <label for="when">Коли виданий</label>
            <input type="date" class="form-control" name="when" placeholder="дд.мм.рр" value="{{ $liver->when }}">
          </div>
        </div>
        <div class="t hidden">
          <div class="form-group col-md-6">
            <label for="tel1">Телефон №1</label>
            <input type="tel" class="form-control" name="tel1" value="{{ $liver->tel1 }}">
          </div>
          <div class="form-group col-md-6">
            <label for="tel2">Телефон №2</label>
            <input type="tel" class="form-control" name="tel2" value="{{ $liver->tel2 }}">
          </div>
          <div class="form-group col-md-6">
            <label for="tel3">Телефон №3</label>
            <input type="tel" class="form-control" name="tel3" value="{{ $liver->tel3 }}">
          </div>
        </div>
        <div class="form-group col-md-12">
          <button id="submit" class="btn btn-default">Далі</button>
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
        if (curr == tabs.length-1) {
          b.innerHTML = 'Зберегти';
        } else {
          b.innerHTML = 'Далі';
        }
      }
    }
    var form = document.forms[0];
    var b = document.getElementById('submit');
    b.onclick = function (e) {
      if (this.innerHTML === 'Зберегти') {
        form.onsubmit = null;
        form.submit();
      } else {
        form.onsubmit = function () {
          return false;
        }
      }
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
    student.onchange({target:student});
    var f = document.getElementById('facult');
    var gs = document.getElementById('group').getElementsByTagName('option');
    gs = [].slice.call(gs);
    f.onchange = function (e) {
      if (parseInt(e.target.value)) {
        e.target.getElementsByTagName('option')[0].classList.add('hhh');
      }
      for (var i=0;i<gs.length;i++)
      {
        if (parseInt(e.target.value) && parseInt(gs[i].className.substr(1)) !== parseInt(e.target.value))
        {
          gs[i].classList.add('hhh');
        }
        else {
          gs[i].classList.remove('hhh');
        }
      }
      gs[parseInt(e.target.value)].selected = 'selected';
    };
    f.onchange({target: f});
  </script>
@endsection

