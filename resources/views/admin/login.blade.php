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
      <p class="login-box-msg">Sign in to start your session</p>

      @include('common.alert')

      <form action="{{ route('admin.login')}}" method="POST">
            {{csrf_field()}}

        <div class="input-group mb-3">
          <input type="email" name="email" class="@error('email') is-invalid @enderror form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          
        </div>
          <span class="text-danger">{{$errors->first('email')}}</span>


        <div class="input-group mb-3">
          <input type="password" name="password"  class="@error('password') is-invalid @enderror form-control" placeholder="Password" id="password">
          <div class="input-group-append">
            <div class="input-group-text" onclick="showPassword()">
              <span class="fas fa-eye" id="eye"></span>
            </div>
          </div>
        </div>
          <span class="text-danger">{{$errors->first('password')}}</span>


        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              {{-- <input type="checkbox" id="remember"> --}}
              <label for="remember">
                <p class="mb-1">
        <a href="{{ route('forgot-password') }}">I forgot my password</a>
      </p>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

</div>
@endsection

@push('scripts')
    <script type="text/javascript">
function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
    $("#eye").removeClass('fa fa-eye');
    $("#eye").addClass('fa fa-eye-slash');
  } else {
    x.type = "password";
    $("#eye").removeClass('fa fa-eye-slash');
    $("#eye").addClass('fa fa-eye');
  }
}
    </script>
@endpush