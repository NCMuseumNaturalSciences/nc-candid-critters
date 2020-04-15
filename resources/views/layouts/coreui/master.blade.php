<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{!! asset('images/favicon.ico') !!}" type="image/x-icon" />
    <title>@yield('title')</title>

    <!-- CoreUI and Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script type="text/javascript" src="{!! asset('js/vendor/modernizr.js') !!}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/vendor/normalize.css') }}">
    <link rel='stylesheet' type="text/css" href='https://fonts.googleapis.com/css?family=Roboto+Slab|Roboto'>

    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{!! asset('icons/ionicons/css/ionicons.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('coreui/vendors/css/simple-line-icons.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('coreui/vendors/css/daterangepicker.min.css') !!}">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
    <link type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/vendor/select2/select2-bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/vendor/jqueryui/base.jquery-ui.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/vendor/bootstrap-toggle.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('coreui/css/style.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/custom-tooltips.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/vendor/awesome-bootstrap-checkbox.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/spinner.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/admin.css') !!}">

    @stack('inc-styles')
    @yield('styles')
    <style>
        #overlay {
            display: none;
        }

        footer.page-footer {
            padding-bottom: 20px;
        }
    </style>
</head>

<body id="main-body" class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    @include('layouts.coreui.navbar')
    <section class="app-body">
        @include('layouts.coreui.sidebar')
        <main id="main-content" class="main">
            <div class="container-fluid">
                <div class="inner-wrapper">
                    @yield('content')
                </div>
            </div>
        </main>
    </section>
    <footer class="page-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-12 mx-auto text-center">
                    <img src="{{ asset('images/ncmns_footer.png') }}" alt="North Carolina Museum of Natural Sciences" class="img-fluid footer-image">
                </div>
            </div>
        </div>
    </footer>


<script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.js'></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="{!! asset('js/vendor/moment.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/vendor/jquery-slimscroll/jquery.slimscroll.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/vendor/jqueryui-bootstrap-adapter.js') !!}"></script>
<script type="text/javascript" src="{!! asset('coreui/vendors/js/pace.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('coreui/vendors/js/Chart.min.js') !!}"></script>
<script type='text/javascript' src='https://unpkg.com/ionicons@4.1.1/dist/ionicons.js'></script>
<script type="text/javascript" src="{!! asset('coreui/js/app.js') !!}"></script>

<!-- Every Datatable JS in the Universe -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<!--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>-->
<!--<script type="text/javascript" src="https://cdn.datatables.net/scroller/1.5.1/js/dataTables.scroller.min.js"></script>-->
<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>


<script type="text/javascript" src="{!! asset('coreui/vendors/js/jquery.maskedinput.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('coreui/vendors/js/daterangepicker.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/vendor/bootstrap-toggle.min.js') !!}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script type="text/javascript" src="{!! asset('js/vendor/parsley.min.js') !!}"></script>

@stack('inc-scripts')
@stack('scripts')

<script type="text/javascript">

    $(document).ready(function() {
        $(function () {
            $(".tt").tooltip();
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $('a[href^="mailto:"]').addClass('email');
        $(".date-input").mask("99/99/9999");
        $(".phone-input").mask("999.999.9999");
        $(".admin-parsley-form").parsley();
        $('#sidebar .sidebar-nav').slimScroll({
            height: 'auto',
            railVisible: true,
            alwaysVisible: true,
            allowPageScroll: false,
            railColor: '#FFFFFF',

        });
    });

    </script>
</body>
</html>