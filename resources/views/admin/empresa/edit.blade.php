@extends('layouts.admin')
@section('title','Información de la empresa')
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
            <h1>Información de la empresa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              {{--  <li class="breadcrumb-item"><a href="{{route('planadquisiciones.index')}}">Adquisiciones </a></li>  --}}
              <li class="breadcrumb-item active">Información de la empresa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        
        {!! Form::model($empresa, ['route'=>['empresa.update',$empresa],'method'=>'PUT']) !!}
        <div class="card">

            <div class="card-body">

                

                    <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" id="nombre"
                      value="{{$empresa->nombre}}"
                      required>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="url" class="form-control" name="url" id="url"
                        value="{{$empresa->url}}"
                        required>
                    </div>
                    
                    <div class="form-group">
                      <label for="mision">Misión</label>
                      <textarea class="form-control" name="mision" id="mision" rows="3" required>
                        {{$empresa->mision}}
                      </textarea>
                    </div>

                    <div class="form-group">
                        <label for="vision">Visión</label>
                        <textarea class="form-control" name="vision" id="vision" rows="3" required>
                          {{$empresa->vision}}
                        </textarea>
                      </div>
   
                

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="row">
            <div class="col-12 mb-2">
            <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>

            
            <button class="btn btn-primary float-right" type="submit">
                Actualizar 
             </button>
            

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
