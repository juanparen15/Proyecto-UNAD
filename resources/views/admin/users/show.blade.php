@extends('layouts.admin')
@section('title', 'Perfil de usuario')
@section('style')
    <!-- SweetAlert2 -->
    {!! Html::style('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') !!}
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cyborg/bootstrap.min.css"
        integrity="sha384-nEnU7Ae+3lD52AK+RGNzgieBWMnEfgTbRHIwEvp1XXPdqdO6uLTd/NwXbzboqjc2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    {!! Html::style('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}

@endsection
@section('content')
    <div class="content-wrapper bg-black">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Perfil</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                            <li class="breadcrumb-item active">{{ $user->name }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <h3 class="card-title">Perfil de Usuario</h3>
                            </div><!-- /.card-header -->

                            {!! Form::model($user, ['route' => ['update.profile', $user], 'method' => 'PUT', 'files' => true]) !!}

                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="form-row">
                                        <div class="col-md-8">

                                            <div class="form-group">
                                                <label><i class="fas fa-map-marker-alt mr-1"></i> Correo electrónico
                                                    </label>
                                                <p class="text-muted">
                                                    {{ $user->email }}
                                                </p>
                                                <hr>
                                            </div>
                                            <div class="form-group">
                                                <label for="name"><i class="fas fa-book mr-1"></i> Nombre</label>
                                                <p class="text-muted">
                                                    {{-- {{ $user->area->nomarea }} --}}
                                                    {{ $user->name }}
                                                </p>
                                                <hr>
                                                {{-- <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror"> --}}
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname"><i class="far fa-file-alt mr-1"></i>Apellidos</label>
                                                <p class="text-muted">
                                                    {{ $user->lastname }}
                                                </p>
                                                <hr>
                                                {{-- <input type="text" id="apellido" name="apellido" value="{{ old('apellido', $user->apellido) }}" class="form-control @error('name') is-invalid @enderror"> --}}
                                                @error('lastname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="telefono"><i
                                                        class="fas fa-map-marker-alt mr-1"></i>Teléfono</label>
                                                <p class="text-muted">
                                                    {{ $user->telefono }}
                                                </p>
                                                <hr>
                                                {{-- <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $user->telefono) }}" class="form-control @error('name') is-invalid @enderror"> --}}
                                                @error('telefono')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="documento"><i class="fas fa-map-marker-alt mr-1"></i> Número de
                                                    documento</label>
                                                <p class="text-muted">
                                                    {{ $user->documento }}
                                                </p>
                                                <hr>
                                                {{-- <input type="number" id="documento" name="documento" value="{{ old('documento', $user->documento) }}" class="form-control @error('name') is-invalid @enderror"> --}}
                                                @error('documento')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center mb-3">
                                                {{-- <img src="{{ asset('adminlte/dist/img/' . auth()->user()->avatar) }}" --}}
                                                <img src="{{ asset('adminlte/dist/img/' . $user->avatar) }}"
                                                    class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                                    alt="">
                                            </div>

                                            {{-- 
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Cambiar Foto de Perfil</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="avatar" class="custom-file-input" id="avatar" lang="es">
                                                        <label class="custom-file-label" for="avatar">Seleccionar Archivo</label>
                                                    </div>
                                                </div>
                                            </div> --}}

                                        </div>
                                    </div>

                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <div class="card-footer">

                                <a href="{{ URL::previous() }}" class="btn btn-secondary">Regresar</a>

                                {{-- <button type="submit" class="btn btn-primary float-right">Actualizar</button> --}}

                            </div>

                            {!! Form::close() !!}

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->



        </section>
        <!-- /.content -->
        {{-- </div> --}}
    @endsection
    @section('script')
        <!-- SweetAlert2 -->
        {!! Html::script('adminlte/plugins/sweetalert2/sweetalert2.min.js') !!}
        @if (session('flash') == 'actualizado')
            <script>
                $(function() {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Usuario actualizado correctamente.'
                    })
                });
            </script>
        @endif
    @endsection
