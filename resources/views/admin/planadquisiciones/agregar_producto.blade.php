@extends('layouts.admin')
@section('title','Agregar producto')
@section('style')
<!-- Select2 -->
{!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
{!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agregar producto</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{route('planadquisiciones.index')}}">Plan de Adquisiciones </a></li>
              <li class="breadcrumb-item active">Agregar Producto</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route'=>['agregar_producto_store', $planadquisicion], 'method'=>'POST']) !!}
        <div class="card">

            <div class="card-body">

                <div class="form-group">
                    <label for="segmento_id">Segmentos</label>
                    <select id="segmento_id" class="form-control select2" required>
                        <option value="" disabled selected> -- Seleccione un Segmento --</option>
                        @foreach ($segmentos as $segmento)
                        <option 
                        value="{{$segmento->id}}"
                        >{{$segmento->id}}
                        -{{$segmento->detsegmento}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="familia_id">Familias</label>
                    <select id="familia_id" class="form-control select2" required>
                        <option value="" disabled selected> -- Seleccione una Familia --</option>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="clase_id">Clases</label>
                    <select id="clase_id" class="form-control select2" required>
                        <option value="" disabled selected> -- Seleccione una Clase --</option>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="producto_id">Productos</label>
                    <select id="producto_id" name="producto_id" class="form-control select2" required>
                        <option value="" disabled selected> -- Seleccione un Producto --</option>
                        
                    </select>
                </div>

            </div>
     
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

<script>
    var segmento_id = $('#segmento_id');
    var familia_id = $('#familia_id');
    segmento_id.change(function(){
        $.ajax({
            url: "{{route('obtener_familias')}}",
            method: 'GET',
            data:{
                segmento_id: segmento_id.val(),
            },
            success: function(data){
                familia_id.empty();
                familia_id.append('<option disabled selected>-- Seleccione una Familia --</option>');
                $.each(data, function(index, element){
                    familia_id.append('<option value="'+ element.id +'">'+ element.id +"-"+ element.detfamilia +'</option>' )
                });
                
            }
        });
    });
</script> 

<script>
    var familia_id = $('#familia_id');
    var clase_id = $('#clase_id');
    familia_id.change(function(){
        $.ajax({
            url: "{{route('obtener_clases')}}",
            method: 'GET',
            data:{
                familia_id: familia_id.val(),
            },
            success: function(data){
                clase_id.empty();
                clase_id.append('<option disabled selected>-- Seleccione una Clase --</option>');
                $.each(data, function(index, element){
                    clase_id.append('<option value="'+ element.id +'">'+ element.id +"-" + element.detclase +'</option>' )
                });
                
            }
        });
    });
</script> 

<script>
    var clase_id = $('#clase_id');
    var producto_id = $('#producto_id');
    clase_id.change(function(){
        $.ajax({
            url: "{{route('obtener_productos')}}",
            method: 'GET',
            data:{
                clase_id: clase_id.val(),
            },
            success: function(data){
                producto_id.empty();
                producto_id.append('<option disabled selected>-- Seleccione un Producto --</option>');
                $.each(data, function(index, element){
                    producto_id.append('<option value="'+ element.id +'">'+ element.id +"-" + element.detproducto +'</option>' )
                });
                
            }
        });
    });
</script>
@endsection
