<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--    <link rel="icon" href="{!! asset('images/favicon.ico') !!}" type="image/x-icon" /> -->
    <title>@yield('title')</title>
    <script type="text/javascript" src="{!! asset('js/vendor/modernizr.js') !!}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/vendor/normalize.css') }}">
    <link rel='stylesheet' type="text/css" href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600,300italic&subset=latin,latin-ext'>
    <link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/vendor/select2/select2-bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/vendor/animate.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/vendor/hover.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/vendor/awesome-bootstrap-checkbox.css') !!}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/vendor/loaders/loaders.min.css') }}">
    @stack('inc-styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/themes/sandstone.bootstrap.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/frontend.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/forms.css') !!}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/frontend-map.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/print.css') }}" media="print">

    @stack('styles')
</head>

<body id="{{ $bodyid }}">
<div id="wrapper">
    @role('administrator')
    @include('layouts.frontend.sidebar')
    @endrole
    <div id="inner-wrapper" class="inner-wrapper screen">
        @include('layouts.frontend.header')
        <section class="content-wrapper container">
                @yield('content')
        </section>
        @include('layouts.frontend.footer')
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>

<script type="text/javascript" src="{!! asset('js/vendor/loaders/loaders.css.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/vendor/jquery-slimscroll/jquery.slimscroll.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/vendor/jqueryui-bootstrap-adapter.js') !!}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script type="text/javascript" src="{!! asset('js/vendor/parsley.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/vendor/jquery-maskedinput/jquery.maskedinput.min.js') !!}"></script>

<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.5.0/velocity.min.js'></script>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.5.0/velocity.ui.min.js'></script>
<script type='text/javascript' src='https://unpkg.com/ionicons@4.1.1/dist/ionicons.js'></script>


<script type='text/javascript' src='{{ asset('js/frontend/classie.js') }}'></script>
<script type='text/javascript' src='{{ asset('js/frontend/nav-velocity.js') }}'></script>
<script type="text/javascript" src="{{ asset('js/frontend/frontend.js') }}"></script>
@stack('inc-scripts')
@stack('scripts')

@if($bodyid !== 'map-page')
    <script>
        $(document).ready(function() {
        	@stack('doc-ready-script')
           

        });
    </script>
@endif
</body>
</html>