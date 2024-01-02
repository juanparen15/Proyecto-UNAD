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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cyborg/bootstrap.min.css" integrity="sha384-nEnU7Ae+3lD52AK+RGNzgieBWMnEfgTbRHIwEvp1XXPdqdO6uLTd/NwXbzboqjc2" crossorigin="anonymous">
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
                                        @if (Route::has('register'))
                                            <li><a class="btn btn-primary" style="padding:5px"
                                                    href="{{ route('register') }}">Registrarte</a></li>
                                        @endif
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
