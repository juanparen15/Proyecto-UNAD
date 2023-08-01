@extends('layouts.admin')
@section('title','Editar área')
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
            <h1>Editar área</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.areas.index')}}">Lista Areas</a></li>
              <li class="breadcrumb-item active">Editar área</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::model($area, ['route'=>['admin.areas.update',$area],'method'=>'PUT']) !!}
        <div class="card card-primary">
            {{--  <div class="card-header">
              <h3 class="card-title">General</h3>
            </div>  --}}
            <div class="card-body">


              <div class="form-group">
                {!! Form::label('nomarea','NOMBRE AREA') !!}
                {!! Form::text('nomarea',null,['class' => 'form-control', 'placeholder' =>'Ingrese el Nombre de la Area']) !!}
                 @error('nomarea')
                     <span class="text-danger">{{$message}}</span>
                 @enderror
             </div>
  
             <div class="form-group">
              <label for="dependencia_id">DEPENDENCIA</label>
              <select class="select2 @error('dependencia_id') is-invalid @enderror" name="dependencia_id" id="dependencia_id" style="width: 100%;">

                  <option disabled selected>Selecciona una dependencia</option>
                  @foreach ($dependencias as $dependencia)
                      <option value="{{ $dependencia->id }}"
                      {{ old('dependencia_id', $area->dependencia_id) == $dependencia->id ? 'selected' : ''}}
                      >{{ $dependencia->nomdependencia }}</option>
                  @endforeach
              </select>
              @error('dependencia_id')
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
  $(function () {

    //Initialize Select2 Elements
     $('.select2').select2()

  })
</script>

@endsection