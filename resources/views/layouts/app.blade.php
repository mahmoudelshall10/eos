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
  <link rel="stylesheet" href="{{url('site_design')}}/bootstrap.min.css">
  <link rel="stylesheet" href="{{url('admin_design')}}/css/font-awesome.min.css">

  <!-- Custom styles for this template -->
  <link href="{{ url('site_design') }}/css/modern-business.css" rel="stylesheet">
  @if (!request()->routeIs('welcome'))
    <link rel="stylesheet" href="{{ url('site_design') }}/css/base.css">
  @endif
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('admin_design') }}/jquery-ui.css">
  <link rel="stylesheet" href="{{ url('site_design') }}/jquery.dataTables.min.css">
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
  <script src="{{url('site_design')}}/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="{{url('site_design')}}/jquery.dataTables.min.js"></script>
    <script src="{{url('admin_design')}}/jquery-ui.js"></script>
    <script src="{{url('site_design')}}/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#dynamic-table').DataTable();
        $('.dataTables_paginate paging_simple_numbers').addClass('bs-select');
      });
    </script>
    @stack('sitejs')

</body>

</html>