<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>AdminDHT | Dashboard</title>
@routes
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap/bootstrap.min.css') }}">
<!-- Font Awesome 5. -->
<link rel="stylesheet" href="{{ asset('/plugins/font-awesome/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('backend/css/ionicons/css/ionicons.min.css') }}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('backend/css/jvectormap/jquery-jvectormap.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('backend/css/AdminLTE.css') }}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('backend/css/_all-skins.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/validator/theme-default.min.css') }}">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="{{ asset('backend/css/GoogleFont/css.css')}}">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
<!-- // -->
<link rel="stylesheet" href="{{ asset('backend/css/ltc/loading/ripple.css')}}">
@yield('css')
<link rel="stylesheet" href="{{ asset('backend/css/ltc/ltc.css')}}">
@yield('specCss')