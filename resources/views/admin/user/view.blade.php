@extends('layout.admin_layout')

@section('title', 'admin-dashboard')

@section('body')

         @section('header', 'User View')
          @section('badge')
           <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
           <li class="breadcrumb-item"><a href="{{ route('admin.user.view', $user->id) }}">User view</a></li>
          @endsection
   
    <div class="row">
          <div class="col-md-12">

<!-- Widget: user widget style 1 -->
<div class="card card-widget widget-user">
  <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class="widget-user-header text-white"
    style="background: url('{{ asset('dist/img/photo1.png')}}') center center;">
    {{-- <h3 class="widget-user-username text-right">Elizabeth Pierce</h3> --}}
    <h3 class="widget-user-desc text-right">{{ $user->name}}</h3>
  </div>
  <div class="widget-user-image">
    <img class="img-circle" src="{{ $user->profile->profile_photo }}" alt="User Avatar">
  </div>

  <div class="card-footer">
    <div class="row">

      <div class="col-sm-4 border-right">
        <div class="description-block">
        {{--   <h5 class="description-header"> </h5>
          <span class="description-text">PINGS</span> --}}
        </div>
      </div>


      <div class="col-sm-4 border-right">
        <div class="description-block">
         <span class="description-text"> {{ $user->name}}</span>
        </div>
      </div>

     
      <div class="col-sm-4">
        <div class="description-block">
         <span class="btn btn-group">
            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-info mt-2">
              <i class="fas fa-edit"></i>  Edit
            </a>
            <a onclick="return confirm('Are you sure want to delete?');" href="{{ route('admin.user.delete', $user->id) }}" class="btn btn-sm btn-danger mt-2">
              <i class="fas fa-trash"></i>  Delete
            </a>
          </span>
        </div>
      </div>


    </div>
    <!-- /.row -->


    <div class="card-footer p-0">
      <ul class="nav flex-column">
       
        <li class="nav-item">
          <a href="mailto:{{$user->email}}" class="nav-link">
            <strong><i class="fas fa-envelope mr-1"></i> Email : {{ $user->email}}</strong>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="tel:{{ $user->profile->mobile}}" class="nav-link">
            <strong><i class="fas fa-mobile mr-1"></i> Phone : {{ $user->profile->mobile}}</strong>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <strong><i class="fas fa-mobile mr-1"></i> DOB : {{ $user->profile->dob}}</strong>
          </a>
        </li>

        <li class="nav-item">
          <a href="https://www.google.com/maps/place/{{ $user->profile->address}}" class="nav-link" target="_blank">
            <strong><i class="fas fa-book mr-1"></i> Address : {{ $user->profile->address}}  </strong>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <strong><i class="far fa-file-alt mr-1"></i> About</strong>
            <p class="text-muted">{{ $user->profile->about}}</p>
          </a>
        </li>
         
      </ul>
     
    </div>
  </div>
</div>
<!-- /.widget-user -->

        </div>
      </div>

@endsection