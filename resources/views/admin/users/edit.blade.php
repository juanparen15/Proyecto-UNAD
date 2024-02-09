@extends('layouts.admin')
@section('title', 'Registrar usuario')
@section('style')
    <!-- SweetAlert2 -->
    {!! Html::style('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') !!}
    <!-- Select2 -->
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    {!! Html::style('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar usuario</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                            <li class="breadcrumb-item active">Editar usuario</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'PUT', 'files' => true]) !!}
            <div class="container-fluid">
                <div class="card card-black">
                    <div class="card-header">
                        <h3 class="card-title">General</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre de Usuario</label>
                                    <input type="text" id="username" name="username"
                                        value="{{ old('username', $user->username) }}"
                                        class="form-control @error('username') is-invalid @enderror">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $user->name) }}"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Apellidos</label>
                                    <input type="text" id="lastname" name="lastname"
                                        value="{{ old('lastname', $user->lastname) }}"
                                        class="form-control @error('lastname') is-invalid @enderror">
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" id="telefono" name="telefono"
                                        value="{{ old('telefono', $user->telefono) }}"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="documento">Número de documento</label>
                                    <input type="number" id="documento" name="documento"
                                        value="{{ old('documento', $user->documento) }}"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('documento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="areas_id">Area</label>
                                    <select id="areas_id" name="areas_id"
                                        class="form-control custom-select @error('areas_id') is-invalid @enderror">
                                        <option selected disabled>Selecciona area</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}"
                                                {{ old('areas_id', $user->areas_id) == $area->id ? 'selected' : '' }}>
                                                {{ $area->nomarea }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('areas_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            @if (auth()->user()->hasRole('Admin'))
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Rol</label>
                                        <select id="role" name="role"
                                            class="select2 @error('role') is-invalid @enderror" multiple="multiple"
                                            data-placeholder="Selecciona un rol" style="width: 100%;">
                                            {{-- <option selected disabled>Selecciona area</option> --}}
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ collect(old('role', $user->getRoleNames()))->contains($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cambiar_pass">Cambiar contraseña</label>
                                        <select id="cambiar_pass" name="cambiar_pass"
                                            class="form-control custom-select select2">
                                            <option selected disabled>Selecciona opción</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                        @error('cambiar_pass')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group password">
                                        <label for="password">Contraseña</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group password-confirm">
                                        <label for="password-confirm">Confirmar Contraseña</label>
                                        <input type="password" id="password-confirm" name="password_confirmation"
                                            class="form-control" autocomplete="new-password">
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Foto de Perfil</label>
                                    <div class="custom-file">

                                        <input type="file" name="avatar" class="custom-file-input" id="avatar"
                                            lang="es">
                                        <label class="custom-file-label" for="avatar">Seleccionar Archivo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="row">
                    <div class="col-12 mb-2">
                        <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" value="Actualizar" class="btn btn-primary float-right">Actualizar</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </section>
        <!-- /.content -->
        {{-- </div> --}}
        <!-- /.content-wrapper -->

        <!-- /.modal -->
    @endsection
    @section('script')
        @error('password')
            <script>
                $(document).ready(function() {
                    $("#modal-sm").modal("show");
                });
            </script>
        @enderror
        <!-- Select2 -->
        {!! Html::script('adminlte/plugins/select2/js/select2.full.min.js') !!}
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()
                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
            })
        </script>
        <!-- SweetAlert2 -->
        {!! Html::script('adminlte/plugins/sweetalert2/sweetalert2.min.js') !!}
        @if (session('flash') == 'contrasenia')
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
                        title: 'Contraseña actualizada correctamente.'
                    })
                });
            </script>
        @endif
        <script>
            var password = $('#password');
            var passwordConfirm = $('#password-confirm');
            var cambiar_pass = $('#cambiar_pass');

            $(function() {
                $(".password").prop("hidden", true);
                $(".password-confirm").prop("hidden", true);

                $("#cambiar_pass").change(function() {
                    if ($(this).val() == "NO") {
                        $(".password").prop("hidden", true);
                        $(".password-confirm").prop("hidden", true);
                    } else {
                        $(".password").prop("hidden", false);
                        $(".password-confirm").prop("hidden", false);
                    }
                });
            });
        </script>
    @endsection
