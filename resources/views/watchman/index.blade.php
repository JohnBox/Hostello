@extends('watchman.master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">
            <img src="data:image/jpeg;base64,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" alt="">

          </div>

          <div class="col-md-9 form-inline">
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <br>
            <br>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <br>
            <br>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Check me out
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection