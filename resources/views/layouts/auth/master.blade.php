<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{!! asset('images/favicon.ico') !!}" type="image/x-icon" />
    <title>@yield('title')</title>
    <!-- CoreUI and Bootstrap 4 -->
    <link rel='stylesheet' type="text/css" href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600,300italic&subset=latin,latin-ext'>
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{!! asset('icons/ionicons/css/ionicons.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('coreui/vendors/css/simple-line-icons.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('coreui/css/style.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/auth.css') !!}">
</head>

<body class="{{$body_class}}">
    @yield('content')
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>