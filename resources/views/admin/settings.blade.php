@extends('layout.admin_layout')

@section('title', 'admin-dashboard')

@section('body')
   @section('header', 'Settings')
    @section('badge')
           <li class="breadcrumb-item"><a href="{{ route('admin.settings') }}">Settings</a></li>
    @endsection

   <div class="card">
        <div class="card-header">
          <h3 class="card-title">Setting</h3>
        </div>
        <div class="card-body">

          <div class="row">
          <div class="col-md-4 offset-4">
        <form method="post" action="{{ route('admin.settings') }}" enctype="multipart/form-data">
          @csrf
          
          <div class="form-group">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ getSetting('email') }}">
          </div>

          <div class="form-group">
            <label>Date format</label>
            <input type="text" name="date_format" class="form-control" value="{{ getSetting('date_format')}}">
          </div>

          <div class="form-group">
            <label>Showing number data per page</label>
            <input type="text" name="per_page" class="form-control" value="{{ getSetting('per_page')}}">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>

        </form>

         </div>
       </div>

        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>

@endsection