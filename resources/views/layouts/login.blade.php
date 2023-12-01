<!DOCTYPE html>
<html lang="es">
    <link rel="shortcut icon" href="adminlte/dist/img/AdminLTELogo.ico" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
    </title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {!! Html::style('adminlte/plugins/fontawesome-free/css/all.min.css') !!}
    <!-- icheck bootstrap -->
    {!! Html::style('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}
    <!-- Theme style -->
    {!! Html::style('adminlte/dist/css/adminlte.min.css') !!}

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        @yield('content')
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    {!! Html::script('adminlte/plugins/jquery/jquery.min.js') !!}
    <!-- Bootstrap 4 -->
    {!! Html::script('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
    <!-- AdminLTE App -->
    {!! Html::script('adminlte/dist/js/adminlte.min.js') !!}
</body>

</html>
