@extends('payment.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Нарахування</div>
    <div class="panel-body">
      <form class="form-inline" id="search_form" action="{{ route('payments.index') }}" method="get">
        <div class="form-group">
          @if($hostels)
            <label for="hostel">Гуртожиток</label>
            <select name="hostel" id="hostel" class="form-control">
              @foreach($hostels as $hostel)
                <option value="{{ $hostel->id}}" @if($currentHostel == $hostel) selected @endif>{{ $hostel->name }}</option>
              @endforeach
            </select>
          @endif
        </div>
        <div class="form-group">
          <label for="q" class="control-label">Дата</label>
        </div>
        <div class="form-group">
          <input class="form-control" type="date" name="q" id="q" @if($q) value="{{ $q }}"@endif>
        </div>
      </form>
      <br>
      <table class="table table-striped">
        <tr>
          <th>Дата</th>
        </tr>
        @foreach($payments as $payment)
          <tr>
            <td>
              <a href="{{ route('payments.show', ['payment' => $payment]) }}">
                {{ $payment->date }}
              </a>
            </td>
          </tr>
        @endforeach
      </table>
      {{ $payments->links() }}
    </div>
  </div>
@endsection

@section('script')
  <script>
      $(function() {
          let q = $('#q'), form = $('#search_form'), hostel = $('#hostel');
          q.change(function (e) {
              form.submit();
          });
          hostel.change(function (e) {
              form.submit();
          });
      });
  </script>
@endsection