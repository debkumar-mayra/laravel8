@extends('layout.admin_layout')

@section('title', 'admin-dashboard')

@section('body')

         @section('header', 'User Edit')
          @section('badge')
           <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
           <li class="breadcrumb-item"><a href="{{ route('admin.user.edit', $user->id) }}">User edit</a></li>
          @endsection
   
    <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{ $user->profile->profile_photo }}">
                </div>

                <h3 class="profile-username text-center">{{$user->name}}</h3>

                {{-- <p class="text-muted text-center">Software Engineer</p> --}}

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right" data-toggle="tooltip" title="{{$user->email}}" href="mailto:{{$user->email}}">{{ substr($user->email, 0,20) }}</a>
                  </li>

                  <li class="list-group-item">
                    <b>Mobile</b> <a href="tel:{{$user->profile->mobile}}" class="float-right">{{$user->profile->mobile}}</a>
                  </li>

                  <li class="list-group-item">
                    <b>DOB</b> <a class="float-right">{{$user->profile->dob}}</a>
                  </li>

                </ul>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                  <p>
                   <a href="https://www.google.com/maps/place/{{ $user->profile->address}}" target="_blank" class="text-muted">{{$user->profile->address}}</a>
                  </p>
                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> About me</strong>
                  <p class="text-muted">{{$user->profile->about}}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                  <li class="nav-item"><a class="nav-link" href="#profile-image" data-toggle="tab">Profile Image</a></li>
                  <li class="nav-item"><a class="nav-link" href="#change-email" data-toggle="tab">Change Email</a></li>
                  {{-- <li class="nav-item"><a class="nav-link" href="#change-password" data-toggle="tab">Change Password</a></li> --}}
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  {{-- general tab start  --}}
                  <div class="active tab-pane" id="general">

                    <form class="form-horizontal" action="{{ route('admin.user.update') }}" method="POST">

                      <input type="hidden" name="user_id" value="{{$user->id}}">
                       @csrf

                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First name" value="{{$user->first_name}}">
                          @error('first_name')
                          <span class="error invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last name" value="{{$user->last_name}}">
                          @error('last_name')
                          <span class="error invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">DOB</label>
                        <div class="col-sm-10">
                          <div class="input-group date datepicker @error('dob') is-invalid @enderror" id="dob" data-target-input="nearest">
                        <input type="text" name="dob" class="form-control datetimepicker-input" data-target="#dob" value="{{ $user->profile->dob }}"/>
                        <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                       @error('dob')
                         <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                       @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                       <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="radio" name="gender" value="male" id="male" {{ ($user->profile->gender == 'male') ? 'checked': ''}}>
                        <label for="male">Male</label>
                      </div>

                      <div class="icheck-success d-inline">
                        <input type="radio" name="gender" value="female" id="female" {{ ($user->profile->gender == 'female') ? 'checked': ''}}>
                        <label for="female">Female</label>
                      </div>

                      <div class="icheck-success d-inline">
                        <input type="radio" name="gender" value="other" id="other" {{ ($user->profile->gender == 'other') ? 'checked': ''}}>
                        <label for="other">Other</label>
                      </div>
                    </div>

                        </div>
                      </div>

                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-sm-10">
                          <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="mobile" value="{{$user->profile->mobile}}">
                       @error('mobile')
                        <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                       @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="address">{{$user->profile->address}}</textarea>
                       @error('address')
                        <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                       @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">About me</label>
                        <div class="col-sm-10">
                          <textarea name="about" class="form-control @error('about') is-invalid @enderror" placeholder="about me">{{$user->profile->about}}</textarea>
                          @error('about')
                           <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                      </div>
                    </form>

                  </div>
                  {{-- general tab end  --}}

                  {{-- profile image tab end  --}}
                 <div class="tab-pane" id="profile-image">

                   <form class="form-horizontal" action="{{ route('admin.user.update') }}" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="user_id" value="{{$user->id}}">
                      @csrf
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Profile Image</label>
                        <div class="col-sm-9">
                          <input type="file" name="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror">
                          @error('profile_photo')
                           <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-sm-10 col-sm-2">
                          <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                      </div>

                    </form>
                    
                  </div>
                  {{-- profile image tab end  --}}


                  <!-- /.change email start -->
                  <div class="tab-pane" id="change-email">
                    <form class="form-horizontal" action="{{ route('admin.user.update') }}" method="POST">
                      <input type="hidden" name="user_id" value="{{$user->id}}">
                      @csrf
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $user->email }}">
                          @error('email')
                           <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                     
                      
                      <div class="form-group row">
                        <div class="offset-sm-10 col-sm-2">
                          <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                  <!-- /.change email end -->

                 <!-- /.change-password start -->
                  {{-- <div class="tab-pane" id="change-password">
                    <form class="form-horizontal" action="{{ route('admin.user.update') }}" method="POST">
                      <input type="hidden" name="user_id" value="{{$user->id}}">
                      @csrf
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Old Password</label>
                        <div class="col-sm-9">
                          <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="old password">
                          @error('old_password')
                           <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                          <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="new password">
                          @error('new_password')
                           <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                       <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                          <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="confirm password">
                          @error('confirm_password')
                           <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-10 col-sm-2">
                          <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div> --}}
                 <!-- /.change-password end -->



                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>

@endsection