@extends('layout.frontend_layout')
@section('title', 'home')
@section('body')

<div class="hold-transition  login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}">{{env('APP_NAME')}}</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

     @include('common.alert')

      <form action="{{ route('forgot-password')}}" method="POST">

            @csrf

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
            <span class="text-danger">{{$errors->first('email')}}</span>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">Login</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('registration') }}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

</div>

@endsection



