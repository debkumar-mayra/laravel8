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
<body>
    <section class="content overlay-wrapper">
       <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Loading...</div></div>
     @yield('body')
    </section>
 
  @include('layout.common_js')

</body>
</html>