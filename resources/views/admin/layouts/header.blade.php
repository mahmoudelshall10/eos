<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>OSPF Dashboard</title>
<meta name="description" content="{{SiteSetting('meta_description')}}">
<meta name="keywords" content="{{SiteSetting('meta_keywords')}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- favicon
    ============================================ -->

<link rel="apple-touch-icon" href="{{url('/').'/'.SiteSetting('logo')}}">
<link rel="shortcut icon" type="image/x-icon" href="{{url('/').'/'.SiteSetting('icon')}}">

<!-- Google Fonts
    ============================================ -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
<!-- Bootstrap CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/css/bootstrap.min.css">
<!-- Bootstrap CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/css/font-awesome.min.css">
<!-- adminpro icon CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/css/adminpro-custon-icon.css">
<!-- meanmenu icon CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/css/meanmenu.min.css">
<!-- mCustomScrollbar CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/css/jquery.mCustomScrollbar.min.css">
<!-- animate CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/css/animate.css">
<!-- normalize CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/css/data-table/bootstrap-table.css">
<link rel="stylesheet" href="{{url('admin_design')}}/css/data-table/bootstrap-editable.css">
<!-- normalize CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/css/normalize.css">
<!-- charts CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/css/c3.min.css">
<!-- style CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/style.css">
<!-- responsive CSS
    ============================================ -->
<link rel="stylesheet" href="{{url('admin_design')}}/css/responsive.css">
<!-- modernizr JS
    ============================================ -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@stack('admincss')

<script src="{{url('admin_design')}}/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="materialdesign">
<!-- Header top area start-->
<div class="wrapper-pro">