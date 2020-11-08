@extends('layout.frontend_layout')

@section('title', 'home')

@section('body')

<div class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}">{{env('APP_NAME')}}</a>
    
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

       <form action="{{ route('change-password')}}" method="POST">
           @csrf
           <input type="hidden" name="user_id" value="{{ Request::segment(2) }}">

           <div class="input-group mb-3">
          <input type="text" name="otp" class="form-control @error('otp') is-invalid @enderror" placeholder="OTP" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          </div>
        <span class="text-danger">{{$errors->first('otp')}}</span>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <span class="text-danger">{{$errors->first('password')}}</span>

        <div class="input-group mb-3">
          <input type="password" name="con_password" class="@error('con_password') is-invalid @enderror form-control" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <span class="text-danger">{{$errors->first('con_password')}}</span>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



      <p class="mt-3 mb-1">
        @if($user->role == 2)
         <a href="{{ route('login') }}">Login</a>
        @elseif($user->role == 1)
         <a href="{{ route('admin.login') }}">Login</a>
        @endif
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</div>


@endsection



