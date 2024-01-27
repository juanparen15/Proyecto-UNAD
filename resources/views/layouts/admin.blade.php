<!DOCTYPE html>
<html lang="es">
<link rel="shortcut icon" href="adminlte/dist/img/logo-crc_0.svg" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    {!! Html::style('adminlte/plugins/fontawesome-free/css/all.min.css') !!}
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
    @yield('style')
    {!! Html::style('adminlte/dist/css/adminlte.min.css') !!}
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cyborg/bootstrap.min.css"
        integrity="sha384-nEnU7Ae+3lD52AK+RGNzgieBWMnEfgTbRHIwEvp1XXPdqdO6uLTd/NwXbzboqjc2" crossorigin="anonymous">

    <style>
        .sidebar-dark-blue {
            background: #0c2a66 !important;
        }

        .sidebar a {
            color: #ffffff !important;
        }
    </style>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/timeline.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
    <script src="https://code.highcharts.com/themes/dark-unica.js"></script>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @include('layouts._user_menu')
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        @include('layouts._nav')
        @yield('content')
        {{-- <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside> --}}
        <footer class="card-footer footer-light">

            <div class="float-right d-none d-sm-inline">
                <a href="#"><b>Contáctanos</a>
            </div>
            <strong style="color: #ffff">Copyright &copy;
                <script type="text/javascript">
                    document.write(new Date().getFullYear());
                </script>
                <b>
                    <a href="#"target="_blank">CRC-UNAD</a>.
            </strong>
            <strong style="color: #ffff">
                Todos los Derechos Reservados por CRC-UNAD.
            </strong>
            <b><br>
                <a style="color: #ffff">Analisis, Diseño y Desarrollo de Software</a></b>
        </footer>
    </div>
    {!! Html::script('adminlte/plugins/jquery/jquery.min.js') !!}
    <!-- Bootstrap 4 -->
    {!! Html::script('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
    @yield('script')
    {!! Html::script('adminlte/dist/js/adminlte.min.js') !!}


    {{--  https://igorescobar.github.io/jQuery-Mask-Plugin/  --}}
    <script src="{{ asset('maskedinput/dist/jquery.mask.js') }}" type="text/javascript"></script>

</body>

</html>
