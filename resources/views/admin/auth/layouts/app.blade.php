<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ SiteSetting('name') }} Login</title>
<meta charset="UTF-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- favicon
    ============================================ -->
<link rel="shortcut icon" type="image/x-icon" href="{{url('admin_design')}}/logo.png">


<!-- Template Main CSS File -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="{{url('login_design')}}/style.css" rel="stylesheet">

</head>
<body>

@yield('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
