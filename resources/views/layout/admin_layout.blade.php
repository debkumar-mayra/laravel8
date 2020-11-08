<!DOCTYPE html>
<html>
<head>
  {{-- composer require laravel/ui
  php artisan ui bootstrap
  npm install
  pnp run watch --}}
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

     @include('layout.common_css')

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

<!-- Site wrapper -->
<div class="wrapper">

     @include('admin.common.header_menu')
     @include('admin.common.menu')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
               @yield('header')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              @yield('badge')
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  @include('common.alert')
    <!-- Main content -->
    <section class="content">
     @yield('body')
    </section>
    <!-- /.content -->
  </div>

   

 <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b></b>
    </div>
    <strong>Copyright &copy; {{date('Y')}} <a href="{{ route('admin.dashboard') }}">{{env('APP_NAME')}}</a>.</strong> All rights
    reserved.
  </footer>

</div>

@include('layout.common_js')


</body>
</html>