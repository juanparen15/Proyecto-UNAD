<!DOCTYPE html>
<html lang="es">
  <link rel="shortcut icon" href="adminlte/dist/img/AdminLTELogo.ico" />
<head>
    <title>
        @yield('title')
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500">


    {!! Html::style('homeland/fonts/icomoon/style.css') !!}

    {!! Html::style('homeland/css/bootstrap.min.css') !!}
    {!! Html::style('homeland/css/magnific-popup.css') !!}
    {!! Html::style('homeland/css/jquery-ui.css') !!}
    {!! Html::style('homeland/css/owl.carousel.min.css') !!}
    {!! Html::style('homeland/css/owl.theme.default.min.css') !!}
    {!! Html::style('homeland/css/bootstrap-datepicker.css') !!}
    {!! Html::style('homeland/css/mediaelementplayer.css') !!}
    {!! Html::style('homeland/css/animate.css') !!}

    {!! Html::style('homeland/fonts/flaticon/font/flaticon.css') !!}

    {!! Html::style('homeland/css/fl-bigmug-line.css') !!}





    {!! Html::style('homeland/css/aos.css') !!}

    {!! Html::style('homeland/css/style.css') !!}

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css">
</head>

<body>

    <div class="site-loader"></div>

    <div class="site-wrap">

        <div class="site-mobile-menu">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div> <!-- .site-mobile-menu -->

        <div class="site-navbar mt-4">
            <div class="container py-1">
                <div class="row align-items-center">
                    <div class="col-8 col-md-8 col-lg-4">
                        <h1 class="mb-0"><a href="{{ route('welcome') }}" class="text-white h2 mb-0"><strong><span
                                        class=""></span></strong></a></h1>
                    </div>
                    <div class="col-4 col-md-4 col-lg-8">
                        <nav class="site-navigation text-right text-md-right" role="navigation">

                            <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                                    class="site-menu-toggle js-menu-toggle text-white"><span
                                        class="icon-menu h3"></span></a></div>

                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <li><a class="btn btn-outline-primary" style="padding:5px"
                                        href="{{ route('welcome') }}">Inicio</a></li>

                                @if (Route::has('login'))
                                    @auth
                                        <li><a href="{{ url('/home') }}">Mi Cuenta</a></li>
                                    @else
                                        <li><a class="btn btn-primary" style="padding:5px"
                                                href="{{ route('login') }}">Iniciar Sesión</a></li>
                                        {{-- @if (Route::has('register'))
                    <li><a class="btn btn-primary" style="padding:5px" href="{{ route('register') }}">Registrarte</a></li>            
                    @endif --}}
                                    @endauth
                                @endif

                            </ul>
                        </nav>
                    </div>


                </div>
            </div>
        </div>
    </div>

    @yield('content')


    <footer class="site-footer">
        {{--  <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="mb-5">
              <h3 class="footer-heading mb-4">About Homeland</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe pariatur reprehenderit vero atque, consequatur id ratione, et non dignissimos culpa? Ut veritatis, quos illum totam quis blanditiis, minima minus odio!</p>
            </div>
          </div>
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="row mb-5">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Buy</a></li>
                  <li><a href="#">Rent</a></li>
                  <li><a href="#">Properties</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Privacy Policy</a></li>
                  <li><a href="#">Contact Us</a></li>
                  <li><a href="#">Terms</a></li>
                </ul>
              </div>
            </div>


          </div>

          <div class="col-lg-4 mb-5 mb-lg-0">
            <h3 class="footer-heading mb-4">Follow Us</h3>

                <div>
                  <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                  <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                  <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                  <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                </div>

            

          </div>
          
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
           
            Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
           
            </p>
          </div>
          
        </div>
      </div>  --}}
    </footer>

    </div>

    {!! Html::script('homeland/js/jquery-3.3.1.min.js') !!}
    {!! Html::script('homeland/js/jquery-migrate-3.0.1.min.js') !!}
    {!! Html::script('homeland/js/jquery-ui.js') !!}
    {!! Html::script('homeland/js/popper.min.js') !!}
    {!! Html::script('homeland/js/bootstrap.min.js') !!}
    {!! Html::script('homeland/js/owl.carousel.min.js') !!}
    {!! Html::script('homeland/js/mediaelement-and-player.min.js') !!}
    {!! Html::script('homeland/js/jquery.stellar.min.js') !!}
    {!! Html::script('homeland/js/jquery.countdown.min.js') !!}
    {!! Html::script('homeland/js/jquery.magnific-popup.min.js') !!}
    {!! Html::script('homeland/js/bootstrap-datepicker.min.js') !!}
    {!! Html::script('homeland/js/aos.js') !!}

    {!! Html::script('homeland/js/circleaudioplayer.js') !!}

    {!! Html::script('homeland/js/main.js') !!}

</body>

</html>
