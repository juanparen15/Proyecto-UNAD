@extends('layouts.admin')
@section('title', 'Editar Estándar')
@section('style')
    <!-- Select2 -->
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Estándar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.estandares.index') }}">Estándares</a></li>
                            <li class="breadcrumb-item active">Editar Estándar</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::model($estandar, ['route' => ['admin.estandares.update', $estandar], 'method' => 'PUT']) !!}
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="ciudad_id">CIUDAD:</label>
                        <select class="select2 @error('ciudad_id') is-invalid @enderror" name="ciudad_id" id="ciudad_id" style="width: 100%;">
                            <option disabled>Selecciona una Ciudad</option>
                            @foreach ($ciudades as $ciudad)
                                <option value="{{ $ciudad->id }}" {{ old('ciudad_id', $estandar->ciudad_id) == $ciudad->id ? 'selected' : '' }}>
                                    {{ $ciudad->detciudad }}
                                </option>
                            @endforeach
                        </select>
                        @error('ciudad_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('detestandar', 'NOMBRE ESTÁNDAR') !!}
                        {!! Form::text('detestandar', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese el Nombre del Estándar',
                        ]) !!}
                        @error('detestandar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-12 mb-2">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Actualizar" class="btn btn-primary float-right">
                </div>
            </div>
            {!! Form::close() !!}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <!-- Select2 -->
    {!! Html::script('adminlte/plugins/select2/js/select2.full.min.js') !!}
    <script>
        $(function() {
            // Initialize Select2 Elements
            $('.select2').select2();
        })
    </script>
@endsection
