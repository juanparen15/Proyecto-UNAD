@extends('layouts.admin')
@section('title', 'Usuarios')
@section('style')
    <!-- SweetAlert2 -->
    {!! Html::style('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') !!}
    <!-- DataTables -->
    {!! Html::style('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{--  <h1 class="m-0">Usuarios del sistema</h1>  --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Usuarios</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios del Sistema</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-wrench"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <a href="{{ route('users.create') }}" class="dropdown-item">Registrar</a>
                                    {{--  <a href="#" class="dropdown-item">Another action</a>
                        <a href="#" class="dropdown-item">Something else here</a>
                        <a class="dropdown-divider"></a>
                        <a href="#" class="dropdown-item">Separated link</a>  --}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example2" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del Area o Dependencia</th>
                                    <th>Nombres y Apellidos del Responsable</th>
                                    <th>Correo electrónico Institucional</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            @if (isset( $user->area->nomarea) )
                                            {{$user->area->nomarea}}
                                            @else
                                            No especificado 
                                            @endif
                                        </td>
                                        {{-- <td>{{ $user->areas_id }}</td> --}}
                                        <td>
                                            <a href="{{ route('users.show', $user) }}">
                                                {{ $user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->getRoleNames() as $role)
                                                {{ $role }}
                                            @endforeach
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="{{ route('users.show', $user) }}">
                                                <i class="fas fa-folder">
                                                </i>
                                                Ver
                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{ route('users.edit', $user) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Editar
                                            </a>
                                            <a class="btn btn-danger btn-sm" onclick="enviar_formulario()">
                                                <i class="fas fa-trash">
                                                </i>
                                                Eliminar
                                            </a>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <form method="POST" action="{{ route('users.destroy', $user) }}" name="delete_form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
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
    @if (session('flash') == 'registrado')
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
                    title: 'Usuario registrado correctamente.'
                })
            });
        </script>
    @endif
    @if (session('flash') == 'eliminado')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'El registro ha sido eliminado.',
                'success'
            )
        </script>
    @endif
    <script>
        function enviar_formulario() {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, estoy seguro!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.delete_form.submit();
                }
            })
        }
    </script>
    <!-- DataTables  & Plugins -->
    {!! Html::script('adminlte/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}
    {!! Html::script('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}
    {!! Html::script('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}
    {!! Html::script('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') !!}
    {!! Html::script('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') !!}
    {!! Html::script('adminlte/plugins/jszip/jszip.min.js') !!}
    {!! Html::script('adminlte/plugins/pdfmake/pdfmake.min.js') !!}
    {!! Html::script('adminlte/plugins/pdfmake/vfs_fonts.js') !!}
    {!! Html::script('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') !!}
    {!! Html::script('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') !!}
    {!! Html::script('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') !!}
    @include('includes._datatable_language')
@endsection
