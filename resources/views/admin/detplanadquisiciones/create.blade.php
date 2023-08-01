@extends('adminlte::page')

@section('title', 'Plan Aquisiciones')



@section('content_header')
    <h1>Crear Nueva Area</h1>
@stop

@section('content')
  <div class="card">
      <div class="card-body">
         {!! Form::open(['route'=>'admin.areas.store']) !!}

           <div class="form-group">
              {!! Form::label('nomarea','NOMBRE AREA') !!}
              {!! Form::text('nomarea',null,['class' => 'form-control', 'placeholder' =>'Ingrese el Nombre de la Area']) !!}
               @error('nomarea')
                   <small class="text-danger">{{$message}}</small>
               @enderror
           </div>

           <div class="form-group">
              {!! Form::label('slug','SLUG') !!}
              {!! Form::text('slug',null,['class' => 'form-control', 'placeholder' =>'Ingrese el Slug','readonly']) !!}
               @error('slug')
                   <small class="text-danger">{{$message}}</small>
               @enderror
           </div>

           <div class="form-group">
              {!! Form::label('dependencia_id','DEPENDENCIA') !!}
              {!! Form::select('dependencia_id',$dependencia,null,['class' => 'form-control']) !!}
              @error('dependencia_id')
                   <small class="text-danger">{{$message}}</small>
               @enderror
           </div>

            {!! Form::submit('Crear Area',['class'=> 'btn btn-primary']) !!}
         {!! Form::close() !!}
      </div>    
 </div>
@stop
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