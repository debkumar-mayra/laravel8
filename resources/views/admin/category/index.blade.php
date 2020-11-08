@extends('layout.admin_layout')

@section('title', 'admin-dashboard')

@section('body')
   
          @section('header', 'Category')

          @section('badge')
           <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}">Category</a></li>
          @endsection

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Category list</h3>
          &nbsp
          <a href="{{ route('admin.category.create', request()->segment(3)) }}" class="btn btn-sm btn-outline-primary"> <i class="fas fa-plus-square"></i> Add New</a>
        </div>
        <div class="card-body">
         <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th># No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($categories as $category)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories', $category->id) }}"> <i class="fas fa-eye"></i> View</a>
                        <a class="btn btn-sm btn-outline-warning" href="{{ route('admin.category.edit', $category->id) }}"> <i class="fas fa-edit"></i> Edit</a>
                        <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure want to delete?');" href="{{ route('admin.category.delete', $category->id) }}"> <i class="fas fa-trash-alt"></i> Delete</a>

                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="text-center">No data found.</td>
                      </tr>
                    @endforelse
                  
                  </tbody>
                 
                </table>
        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>

@endsection