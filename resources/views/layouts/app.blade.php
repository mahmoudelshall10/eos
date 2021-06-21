<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('page-title')</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

  <!-- Custom styles for this template -->
  <link href="{{ url('site_design') }}/css/modern-business.css" rel="stylesheet">
  @if (!request()->routeIs('welcome'))
    <link rel="stylesheet" href="{{ url('site_design') }}/css/base.css">
  @endif
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  @stack('sitecss')
</head>

<body>

    @include('layouts.nav')

  <div class="container container1">
    @yield('content')
  </div>
  <!-- Footer -->
  <footer class="py-2 bg-dark footer1">
    <div class="container">
      <p class="m-0 text-center text-white">Copyrights &copy; OSE team {{ date('Y') }}</p>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
<!-- jquery
============================================ -->
  <script src="{{url('admin_design')}}/js/vendor/jquery-1.11.3.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
    crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @stack('sitejs')

</body>

</html>
