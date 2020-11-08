
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ (!empty(getSetting('logo'))) ? asset('common_img/'.getSetting('logo')) : asset('common_img/logo.png') }}" alt="{{env('APP_NAME')}}" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::guard('siteAdmin')->user()->profile->profile_photo }}" class="img-circle elevation-2" alt="User Image">

        </div>
        <div class="info">
          <a href="{{ route('admin.profile') }}" class="d-block">{{ Auth::guard('siteAdmin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.users') }}" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">
              <i class="nav-icon fa fa-users" aria-hidden="true"></i> 
              <p>
                Users
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ route('admin.categories') }}" class="nav-link {{ Request::is('admin/categor*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.settings') }}" class="nav-link {{ Request::is('admin/settings*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
              </p>
            </a>
          </li>



          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>