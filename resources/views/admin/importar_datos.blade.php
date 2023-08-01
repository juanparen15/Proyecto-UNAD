@extends('layouts.admin')
@section('title','Importar datos')
@section('style')

@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Panel administrador</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li> --}}
                        <li class="breadcrumb-item active">Inicio</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            {{--  @if (Session::has('message'))
            <p>{{Session::get('message')}}</p>
            @endif --}}



            <div class="form-group">
                <form action="{{route('planadquisicione.import.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="file" name="file" required>
                    <button class="btn btn-primary float-right">Importar Inventario</button>
                </form>
            </div>
{{-- 
            <div class="form-group">
                <form action="{{route('areas.import.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required>
                    <button class="btn btn-primary float-right">Importar áreas</button>
                </form>
            </div> --}}
            {{--  <div class="form-group">
                <form action="{{route('estado_vigencia.import.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required>
                    <button class="btn btn-primary float-right">Importar Estado de vigencias</button>
                </form>
            </div>  --}}
            {{-- <div class="form-group">
                <form action="{{route('familias.import.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="file" name="file" required>
                    <button class="btn btn-primary float-right">Importar familias</button>
                </form>
            </div>
            <div class="form-group">
                <form action="{{route('segmento.import.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required>
                    <button class="btn btn-primary float-right">Importar segmento</button>
                </form>
            </div>
            <div class="form-group">
                <form action="{{route('clases.import.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required>
                    <button class="btn btn-primary float-right">Importar clases</button>
                </form>
            </div>

            <div class="form-group">
                <form action="{{route('fuentes.import.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required>
                    <button class="btn btn-primary float-right">Importar fuentes</button>
                </form>
            </div>
            <div class="form-group">
                <form action="{{route('modalidades.import.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required>
                    <button class="btn btn-primary float-right">Importar modalidades</button>
                </form>
            </div>
            <div class="form-group">
                <form action="{{route('productos.import.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required>
                    <button class="btn btn-primary float-right">Importar productos</button>
                </form> --}}
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
@endsection
@section('script')

@endsection
