@extends('layout.admin_layout')

@section('title', 'admin-dashboard')

@section('body')
          @section('header', 'Users')
          @section('badge')
           <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
          @endsection
   
    <!-- /.col -->

          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">User list</h3>

              <div class="card-tools">
                <form action="" method="GET">
                <div class="input-group input-group-sm">
                  <input type="text" name="search" class="form-control" placeholder="Search" value="{{$_GET['search'] ?? ''}}">
                  <div class="input-group-append">
                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                 
                  </div>
                </div>
                </form>

              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <form action="{{ route('admin.user.delete') }}" method="post">
                          @csrf
          
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" data-toggle="tooltip" title="Select All" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="submit" onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
               {{--    <a href="" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></a>
                  <a href="" class="btn btn-default btn-sm"><i class="fas fa-edit"></i></a> --}}
                  <a href="" data-toggle="tooltip" title="Refresh" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></a>
                </div>
                  <a href="{{ route('admin.user.add') }}" data-toggle="tooltip" title="Add new user" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i> New</a>
                <!-- /.btn-group -->
        
                
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table id="example2" class="table table-hover table-striped">

                  <thead>
                  <tr>
                    <th># No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tbody id="search_result">
                    @forelse ($users as $user)
                      <tr onmouseover="showActionBtn('{{ $loop->iteration }}');" onmouseout="hideActionBtn('{{ $loop->iteration }}')">
                
                        <td>
                      <div class="icheck-primary">
                        <input type="checkbox" name="users_id[]" value="{{ $user->id }}" id="check{{ $loop->iteration }}">
                        <label for="check{{ $loop->iteration }}">{{ $loop->iteration }}</label>
                      </div>
                    </td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td width="150px">

                        {{-- <div id="list_button{{$loop->iteration}}" style="display: none"> --}}
                        <a class="btn btn-sm btn-outline-primary" data-toggle="tooltip" title="Click to view" href="{{ route('admin.user.view', $user->id) }}"> <i class="fas fa-eye"></i></a>

                        @if($user->status == 1)
                        <a class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Click to Block" href="{{ route('admin.user.block', $user->id) }}"> <i class="fas fa-ban"></i></a>
                        @else
                        <a class="btn btn-sm btn-outline-success" data-toggle="tooltip" title="Click to Active" href="{{ route('admin.user.active', $user->id) }}"> <i class="fas fa-ban"></i></a>

                        @endif

                        <a class="btn btn-sm btn-outline-warning" data-toggle="tooltip" title="Click to edit" href="{{ route('admin.user.edit', $user->id) }}"> <i class="fas fa-edit"></i></a>
                        <a class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Click to delete" onclick="return confirm('Are you sure want to delete?');" href="{{ route('admin.user.delete', $user->id) }}"> <i class="fas fa-trash-alt"></i></a>
                       {{-- </div> --}}

                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="5" class="text-center">No data found.</td>
                      </tr>
                    @endforelse
                  
                  </tbody>

                
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
               
                <div class="float-right">
                 {{--  1-{{count($users)}}/{{$total_users}} --}}
                  <div class="btn-group">
                    {{ $users->onEachSide(1)->links() }}
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
            </div>
          </form>
          </div>
          <!-- /.card -->
      
        <!-- /.col -->


@endsection
@push('scripts')
<script>

// function showActionBtn(id){
//   $('#list_button'+id).show();
// }

// function hideActionBtn(id){
//   $('#list_button'+id).hide();
// }
</script>

    {{-- <script type="text/javascript">
        function search(model_name,type,keys,value){
       
  var data = {};
  for (var i = 0; i < keys.length; ++i){
    data[keys[i]] = value;
  }

         $.ajax({
        url: "{{url('search')}}" +"/"+ model_name + "/" + type + "/",
        type:'get',
        dataType: "json",
        data:data
        }).done(function(response) {
           console.log(response);
            if(typeof response != "undefined" && response.status){
             var stringified = JSON.stringify(response.data);
             console.log(stringified);
             var like_points = JSON.parse(stringified);
                $("#search_result").html(like_points.id);
            }
        });
       }
  </script> --}}
  @endpush