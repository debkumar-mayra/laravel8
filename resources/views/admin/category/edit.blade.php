@extends('layout.admin_layout')

@section('title', 'admin-dashboard')

@section('body')
          @section('header', 'Edit Category')
         @section('badge')
           <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}">Categories</a></li>
           <li class="breadcrumb-item"><a href="{{ route('admin.category.edit',$category->id) }}">Edit Category</a></li>
          @endsection
   
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Category edit</h3>
        </div>
        <div class="card-body">
<form role="form" action="{{ route('admin.category.update') }}" method="POST" enctype="multipart/form-data" id="cmsForm">
        {{csrf_field()}}
        
        <div class="card-body">

            <input type="hidden" name="id" value="{{$category->id}}">

            <div class="form-group row">
                <label class="col-md-2 form-control-label" for="name">Name <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <input class="form-control @error('name') is-invalid @enderror"
                           type="text" name="name" id="name"
                           placeholder="Please enter category name"
                           maxlength="191" value="{{old('name', $category->name)}}">
                    @error('name')
                        <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 form-control-label" for="description">Description<span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <textarea class="form-control @error('description') is-invalid @enderror"
                        type="text" name="description" id="description" placeholder="description"
                        >{{old('description', $category->description)}}</textarea>
                    @error('description')
                        <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 form-control-label" for="description">Status<span class="text-danger">*</span></label>
                <div class="col-md-10">

                <select class="form-control @error('description') is-invalid @enderror" name="status">
                    <option value="1" @if($category->active == 1) {{'selected'}} @endif>Active</option>
                    <option value="0" @if($category->active == 0) {{'selected'}} @endif>Inactive</option>
                </select>

                    @error('description')
                        <span class="error invalid-feedback" id="error_description">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            
        </div>
        <div class="card-footer">
            <div class="col text-right">
                <a href="{{ url()->previous()}}" class="btn btn-outline-danger"><i class="far fa-arrow-alt-circle-left"></i> Cancel</a>
                <button type="submit" class="btn btn-outline-primary"><i class="far fa-save"></i> Update</button>
            </div>
        </div>
    </form>
        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>

@endsection