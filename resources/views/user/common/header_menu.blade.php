
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
 
    </ul>

  
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge">{{Auth::user()->unreadNotifications()->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right overflow-auto os-theme-dark" id="overlayScrollbars" style="height: 200px">
       
          <span class="dropdown-item dropdown-header">{{Auth::user()->unreadNotifications()->count()}} New Notifications</span>

 @foreach(Auth::user()->notifications()->select('id','data','read_at','created_at')->get() as $value)

 @php
 $url = '#';
 // if($value->data['type'] == 'registration'){
 //   $url = route('admin.user.view',$value->data['user_id']);
 // }
 @endphp
          <a href="{{$url}}" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              {{-- <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> --}}
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{$value->data['title']}}
                  <span class="float-right text-sm {{($value->read_at == null) ? 'text-danger':'text-muted'}} "><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">{{$value->data['body']}}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{dateDifferent(now() ,$value->created_at)}} ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          @endforeach


          <div class="dropdown-divider"></div>
          {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
        </div>

      </li>

      

      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">
          <b><i class="fa fa-sign-out"></i> Logout</b>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->