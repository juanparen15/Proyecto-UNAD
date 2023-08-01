@extends('adminlte::page')

@section('title', 'Plan Aquisiciones')

@section('content_header')
    <h1>Lista Detalle Codigos</h1>
@stop

@section('content')
@if (session('info'))
   <div class="alert alert-success">
     <strong>{{session ('info')}}</strong>
   </div>
  @endif
   <div class="card"> 
      <div class="card-header">
         <a class="btn btn-primary btn-sm float-right" href="{{route('admin.detcodunspscs.create')}}">Agregar Codigo</a>
      </div>

      <div class="card-body">
         <table class="table table-striped">
            <thead>
               <tr>
                 <th>ID</th>
                 <th>NOMBRE PLAN AQUISICION</th>
                 <th>NOMBRE PRODUCTO</th>
                 <th>ACCIONES</th>
                 <th colspan="2"></th>
               </tr>
            </thead>

           <tbody>
               @foreach ($detallecodigounspscs as $detallecodigounspsc)
                 <tr>
                   <td>{{$detallecodigounspsc->id}}</td>
                   <td>{{$detallecodigounspsc->planaquis_id}}</td>
                   <td>{{$detallecodigounspsc->producto_id}}</td>
                   <td width="10px">
                      <a class="btn btn-primary btn-sm" href="{{route('admin.detcodunspscs.edit', $detallecodigounspsc)}}">Editar</a>
                   </td>
                   <td width="10px">
                       <form action="{{route('admin.detcodunspscs.destroy',$detallecodigounspsc)}}" method="POST">
                          @csrf
                           @method('delete')
                           <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                       </form>
                   </td>
                 </tr>
               @endforeach
           </tbody> 
         </table>       
      </div>      
   </div>
@stop