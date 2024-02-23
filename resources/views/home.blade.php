@extends('layouts.admin')
@if (auth()->user()->hasRole('Admin'))
    @section('title', 'Panel administrador')
@elseif(auth()->user()->hasRole('User'))
    @section('title', 'Panel Usuario')
@endif
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
                        @if (auth()->user()->hasRole('Admin'))
                            <h1 class="m-0">Panel Administrador</h1>
                        @elseif(auth()->user()->hasRole('User'))
                            <h1 class="m-0">Panel Usuario</h1>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    RADSODI
                                </h3>
                            </div>
                        </div>
                </div>
                </section>
                <div class="card-group">

                    <div class="card-img col-lg-7 col-7 mx-auto d-block">
                        <img style="width: 100%; height: 90%;" class="img-fluid"
                            src="{{ asset('adminlte/dist/img/Logo-UNAD1.png') }}">
                    </div>
                    {{-- <div class="card-img col-lg-9 col-9 mx-auto d-block"> --}}
                    {{-- <img style="width: 100%; height: 100%;" class="img-fluid"
                        src="{{ asset('adminlte/dist/img/Logo-UNAD1.png') }}"> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- </div> --}}
    @endsection
