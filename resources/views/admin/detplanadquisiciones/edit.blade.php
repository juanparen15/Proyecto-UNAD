@extends('adminlte::page')

@section('title', 'Plan Aquisiciones')



@section('content_header')
    <h1>Editar Area</h1>
@stop

@section('content')
  @if (session('info'))
   <div class="alert alert-success">
     <strong>{{session ('info')}}</strong>
   </div>
  @endif
   <div class="card">
      <div class="card-body">
         {!! Form::model($area, ['route' => ['admin.areas.update', $area], 'method' => 'put']) !!}

           <div class="form-group">
              {!! Form::label('nomarea','NOMBRE DEPENDENCIA') !!}
              {!! Form::text('nomarea',null,['class' => 'form-control', 'placeholder' =>'Ingrese el Nombre de la Area']) !!}
               @error('nomarea')
                   <span class="text-danger">{{$message}}</span>
               @enderror
           </div>

           <div class="form-group">
              {!! Form::label('slug','SLUG') !!}
              {!! Form::text('slug',null,['class' => 'form-control', 'placeholder' =>'Ingrese el Slug','readonly']) !!}
               @error('slug')
                   <span class="text-danger">{{$message}}</span>
               @enderror
           </div> 

           <div class="form-group">
              {!! Form::label('dependencias_id','DEPENDENCIA') !!}
              {!! Form::select('dependencias_id',$dependencia,null,['class' => 'form-control']) !!}
              @error('dependencias_id')
                   <small class="text-danger">{{$message}}</small>
               @enderror
           </div>
          

            {!! Form::submit('Actualizar Area',['class'=> 'btn btn-primary']) !!}
         {!! Form::close() !!}
      </div>    
 </div>
@stop
@section('css')
  <link rel="stylesheet" href="">
@section('js')
  <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
  <script>
       $(document).ready( function() {
           $("#nomarea").stringToSlug({
              setEvents: 'keyup keydown blur',
              getPut: '#slug',
              space: '-'
            });
        });
   </script>
@endsection