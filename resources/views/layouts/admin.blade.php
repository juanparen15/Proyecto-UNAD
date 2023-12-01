<!DOCTYPE html>
<html lang="es">
<link rel="shortcut icon" href="adminlte/dist/img/AdminLTELogo.ico" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    {!! Html::style('adminlte/plugins/fontawesome-free/css/all.min.css') !!}
    @yield('style')
    {!! Html::style('adminlte/dist/css/adminlte.min.css') !!}
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css">

    <style>
        .sidebar-dark-blue {
            background: #0c2a66 !important;
        }

        .sidebar a {
            color: #ffffff !important;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
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
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
                <a href="#"><b>Contáctanos</a>
            </div>
            <strong>Copyright &copy;
                <script type="text/javascript">
                    document.write(new Date().getFullYear());
                </script>
                <b>
                    <a href="https://www.puertoboyaca-boyaca.gov.co/Paginas/default.aspx"target="_blank">Alcaldia de
                        Puerto Boyacá</a>.
            </strong> Todos los Derechos Reservados por la Alcaldia Municipal de Puerto Boyacá.
            <b><br>
                <a>Analisis, Diseño y Desarrollo: Oficina de Sistemas Municipal y Contrato 105 de 2023</a></b>
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
