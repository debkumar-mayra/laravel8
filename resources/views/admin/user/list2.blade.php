@extends('layout.admin_layout')

@section('title', 'admin-dashboard')

@section('body')
          @section('header', 'Users')
          @section('badge')
           <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
          @endsection
   
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">User list</h3>
        </div>
        <div class="card-body">
         <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th># No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.user.view', $user->id) }}"> <i class="fas fa-eye"></i> View</a>
                        <a class="btn btn-sm btn-outline-warning" href="{{ route('admin.user.edit', $user->id) }}"> <i class="fas fa-edit"></i> Edit</a>
                        <a class="btn btn-sm btn-outline-danger" href="{{ route('admin.user.delete', $user->id) }}"> <i class="fas fa-trash-alt"></i> Delete</a>

                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="5" class="text-center">No data found.</td>
                      </tr>
                    @endforelse
                  
                  </tbody>
                 
                </table>
        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>

@endsection