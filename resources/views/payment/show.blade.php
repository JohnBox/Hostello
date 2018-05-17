@extends('payment.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Нарахування</div>
    <div class="panel-body">
      <table class="table table-striped">
        <tr>
          <th>Імя</th>
          <th>Проживання</th>
          <th>Сплачено</th>
        </tr>
        @foreach($livers as $liver)
          <tr>
            <td><a href="{{ route('livers.show', ['liver' => $liver]) }}">{{ $liver->full_name() }}</a></td>
            <td>{{ $liver->pivot->live_price }}</td>
            <td>@if($liver->pivot->paid){{ $liver->pivot->paid }}@else -@endif</td>
          </tr>
        @endforeach
      </table>
      {{ $livers->links() }}
    </div>
  </div>
@endsection