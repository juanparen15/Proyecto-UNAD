@extends('layouts.admin')
@section('title', 'Editar Ciudad')
@section('style')
    <!-- Select2 -->
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-black">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Ciudad</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.ciudades.index') }}">Lista Ciudades</a></li>
                            <li class="breadcrumb-item active">Editar Ciudad</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {{-- {!! Form::model($ciudad, ['route' => ['admin.ciudades.update', $ciudad], 'method' => 'PUT']) !!} --}}
            {{-- {!! Form::model($ciudad, ['route' => ['admin.ciudades.update', $ciudad], 'method' => 'PUT']) !!} --}}
            {!! Form::model($ciudade, ['route' => ['admin.ciudades.update', $ciudade], 'method' => 'PUT']) !!}
            <div class="card card-primary">
                <div class="card-body">


                    <div class="form-group">
                        {!! Form::label('detciudad', 'NOMBRE CIUDAD') !!}
                        {!! Form::text('detciudad', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese el Nombre de la Ciudad',
                        ]) !!}
                        @error('detciudad')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>





                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-12 mb-2">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Actualizar" class="btn btn-primary float-right">
                </div>
            </div>
            {!! Form::close() !!}
        </section>
        <!-- /.content -->
        {{-- </div> --}}
        <!-- /.content-wrapper -->

    @endsection
    @section('script')

        <!-- Select2 -->
        {!! Html::script('adminlte/plugins/select2/js/select2.full.min.js') !!}
        <script>
            $(function() {

                //Initialize Select2 Elements
                $('.select2').select2()

            })
        </script>

    @endsection
