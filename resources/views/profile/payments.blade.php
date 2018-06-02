@extends('profile.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Нарахування</div>
    <div class="panel-body">
      <a href="" class="btn btn-default">Сплатити всі</a>
      <br>
      <br>
      <table class="table table-striped">
        <tr>
          <th>Дата</th>
          <th>Сума</th>
          <th>Сплоченно</th>
        </tr>
        @foreach($profile->payments as $payment)
          <tr>
            <td>{{ $payment->date }}</td>
            <td>{{ $payment->pivot->price }}</td>
            <td>
              @if($payment->pivot->paid)
                {{ $payment->pivot->paid }}
              @else
                <a href="" class="btn btn-xs btn-default">Сплатити</a>
              @endif
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection