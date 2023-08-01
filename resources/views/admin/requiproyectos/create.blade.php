@extends('layouts.admin')
@section('title','Registrar proyecto')
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
            <h1>Registrar proyecto</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.proyectos.index')}}">Proyectos</a></li>
              <li class="breadcrumb-item active">Registrar proyecto</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route'=>'admin.proyectos.store', 'method'=>'POST']) !!} 
        <div class="card">
            {{--  <div class="card-header">
              <h3 class="card-title">General</h3>
            </div>  --}}
            <div class="card-body">

            <div class="form-group">
                {!! Form::label('detproyeto','NOMBRE OBJETO') !!}
                {!! Form::text('detproyeto',null,['class' => 'form-control', 'placeholder' =>'Ingrese el Nombre']) !!}
                 @error('detproyeto')
                     <small class="text-danger">{{$message}}</small>
                 @enderror
            </div>


            <div class="form-group">
              <label for="areas_id">UNIDAD ADMINISTRATIVA</label>
              <select class="select2 @error('areas_id') is-invalid @enderror" name="areas_id" id="areas_id" style="width: 100%;">
                  <option disabled selected>Selecciona Unidad Administrativa</option>
                  @foreach ($areas as $area)
                      <option value="{{ $area->id }}"
                      {{ old('areas_id') == $area->id ? 'selected' : ''}}
                      >{{ $area->nomarea }}</option>
                  @endforeach
              </select>
              @error('areas_id')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="row">
            <div class="col-12 mb-2">
            <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Registrar" class="btn btn-primary float-right">
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
    $(function () {
  
      //Initialize Select2 Elements
       $('.select2').select2()
  
    })
  </script>
@endsection
