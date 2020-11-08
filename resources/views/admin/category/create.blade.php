@extends('layout.admin_layout')

@section('title', 'admin-dashboard')

@section('body')
   
          @section('header', 'Add Category')
          @section('badge')
           <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}">Categories</a></li>
           <li class="breadcrumb-item"><a href="{{ route('admin.category.create') }}">Add Category</a></li>
          @endsection


    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Category add</h3>
        </div>
        <div class="card-body">
<form role="form" action="{{ route('admin.category.create') }}" method="POST" enctype="multipart/form-data" id="cmsForm">
        {{csrf_field()}}
        
        <input type="hidden" name="parent_id" value="{{ (request()->segment(4) != '') ? request()->segment(4) : 0 }}">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-md-2 form-control-label" for="name">Name <span class="text-danger">*</span></label>
                <div class="col-md-10">
                       <input class="form-control @error('name') is-invalid @enderror"
                           type="text" name="name" id="name"
                           placeholder="Please enter category name"
                           maxlength="191" value="{{old('name')}}">
@error('name')
    <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
@enderror
                </div><!--col-->
            </div>

            <div class="form-group row">
                <label class="col-md-2 form-control-label" for="description">Description<span class="text-danger">*</span></label>
                <div class="col-md-10">
                   <textarea class="form-control @error('description') is-invalid @enderror"
                        type="text" name="description" id="description" placeholder="description"
                        >{{old('description')}}</textarea>
@error('description')
    <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
@enderror
                </div>
            </div>

            
        </div>
        <div class="card-footer">
            <div class="col text-right">
               <a href="{{ url()->previous()}}" class="btn btn-outline-danger"><i class="far fa-arrow-alt-circle-left"></i> Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Submit</button>
            </div>
        </div>
    </form>
        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>

@endsection