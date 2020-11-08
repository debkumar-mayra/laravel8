@extends('layout.admin_layout')

@section('title', 'admin-dashboard')

@section('body')

         @section('header', 'User Add')
          @section('badge')
           <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
           <li class="breadcrumb-item"><a href="{{ route('admin.user.add') }}">User add</a></li>
          @endsection
   
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Add user</h3>
        </div>
        <div class="card-body">

          <div class="row">
          <div class="col-md-6 offset-3">
         <form action="{{ route('admin.user.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
           
           <div class="form-group">
             <label>Name:</label>
             <input type="text" name="name" class="form-control @error('name') @enderror">
             @error('name')
             <span class="error invalid-feedback">{{$message}}</span>
             @enderror
           </div>

           <div class="form-group">
             <label>Email:</label>
             <input type="email" name="email" class="form-control @error('email') @enderror" >
              @error('email')
             <span class="error invalid-feedback">{{$message}}</span>
             @enderror
           </div>

           <div class="form-group">
             <label>Password :</label>
             <input type="password" name="password" class="form-control @error('password') @enderror">
              @error('password')
               <span class="error invalid-feedback">{{$message}}</span>
              @enderror
           </div>

           <div class="form-group">
             <label>Password :</label>
             <input type="password" name="confirm_password" class="form-control @error('confirm_password') @enderror">
              @error('confirm_password')
               <span class="error invalid-feedback">{{$message}}</span>
              @enderror
           </div>

           <button class="btn btn-primary">Submit</button>

         </form>

         </div>
       </div>

        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>

@endsection