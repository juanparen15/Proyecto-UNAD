@extends('layouts.principal')
@section('title', 'CRC-UNAD')
@section('style')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    {!! Html::style('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') !!}
    <!-- DataTables -->
    {!! Html::style('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}


@endsection
@section('content')
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1 class="m-0">Panel Administrador</h1> --}}
                    </div>

                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    {{-- <section class="col-lg-12 connectedSortable"> --}}

                    {{-- <div class="card"> --}}
                    {{-- <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    CRC-UNAD
                                </h3>
                            </div> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </section> --}}
                </div>
            </div>
            <div class="container">
                <div class="container-fluid">
                    <div class="row">
                        {{-- <div class="col-7 col-md-7 ml-auto  "> --}}
                        <div class="col-lg-12 ml-auto d-block">
                            <center>
                                <img class="img-fluid" src="{{ asset('adminlte/dist/img/logo_CRC.png') }}">
                            </center>
                        </div>
                        {{-- <div class="box card-img col-lg-5 col-5 ml-auto d-block"> --}}
                        {{-- <div class="col-5 col-md-5 ml-auto"> --}}
                        <div class="col-lg-12 ml-auto d-block">
                            <center><img class="img-fluid" src="{{ asset('adminlte/dist/img/logo_min_ciencias_0.png') }}">
                            </center>
                        </div>
                        <div class="col-lg-12 ml-auto d-block">
                            <center><img class="img-fluid" src="{{ asset('adminlte/dist/img/Logo-UNAD2.png') }}">
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
