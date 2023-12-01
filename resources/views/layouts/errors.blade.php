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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  {!! Html::style('adminlte/plugins/fontawesome-free/css/all.min.css') !!}
  <!-- Theme style -->
  {!! Html::style('adminlte/dist/css/adminlte.min.css') !!}
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css">
</head>

<body class="hold-transition layout-top-nav">
<div class="wrapper">
  
  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Contáctanos
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 
      <script type="text/javascript">
        document.write(new Date().getFullYear());
      </script>
      <a href="#">Texvn Online</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
{!! Html::script('adminlte/plugins/jquery/jquery.min.js') !!}
<!-- Bootstrap 4 -->
{!! Html::script('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
<!-- AdminLTE App -->
{!! Html::script('adminlte/dist/js/adminlte.min.js') !!}
<!-- AdminLTE for demo purposes -->
{!! Html::script('adminlte/dist/js/demo.js') !!}
</body>
</html>
