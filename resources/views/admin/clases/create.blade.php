@extends('layouts.admin')
@section('title','Crear Nueva Clase')
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
            <h1>Crear Nueva Clase</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.clases.index')}}">Lista Areas</a></li>
              <li class="breadcrumb-item active">Crear Nueva Clase</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route'=>'admin.clases.store', 'method'=>'POST']) !!} 
        <div class="card">
            {{--  <div class="card-header">
              <h3 class="card-title">General</h3>
            </div>  --}}
            <div class="card-body">


                <div class="form-group">
                    {!! Form::label('detclase','NOMBRE CLASE') !!}
                    {!! Form::text('detclase',null,['class' => 'form-control', 'placeholder' =>'Ingrese el Nombre de la Clase']) !!}
                     @error('detclase')
                         <small class="text-danger">{{$message}}</small>
                     @enderror
                 </div>

                <div class="form-group">
                    <label for="familia_id">Familia</label>
                    <select class="select2 @error('familia_id') is-invalid @enderror" name="familia_id" id="familia_id" style="width: 100%;">

                        <option disabled selected>Selecciona una familia</option>
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}"
                            {{ old('familia_id') == $familia->id ? 'selected' : ''}}
                            >{{ $familia->detfamilia }}</option>
                        @endforeach
                    </select>
                    @error('familia_id')
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