@extends('layouts.admin')
@section('title', 'Lista Estándar')
@section('style')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
{!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
{!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
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
                        {{-- <h1 class="m-0">Usuarios del sistema</h1> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Lista Estándares</li>
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
                        <h3 class="card-title">Lista Estándares</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.estandares.create') }}" class="btn btn-primary">
                                Agregar Estándar
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example2" class="table table-striped text-nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CIUDAD</th>
                                    <th>ESTÁNDAR</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estandares as $estandar)
                                    <tr>
                                        <td>{{ $estandar->id }}</td>
                                        <td>{{ $estandar->ciudad->detciudad }}</td>
                                        <td>{{ $estandar->detestandar }}</td>

                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('admin.estandares.edit', $estandar) }}">Editar</a>

                                            <form id="deleteForm_{{ $estandar->id }}"
                                                action="{{ route('admin.estandares.destroy', $estandar) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        {{-- </div> --}}
    @endsection

    @section('script')
        <!-- SweetAlert2 -->
        {!! Html::script('adminlte/plugins/sweetalert2/sweetalert2.min.js') !!}
        {!! Html::script('adminlte/plugins/datatables/jquery.dataTables.min.js') !!}
        {!! Html::script('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}
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
                        title: 'El Estándar se Actualizó con Éxito.'
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
                        title: 'El Estándar se Creó con Éxito.'
                    })
                });
            </script>
        @endif
        <script>
            @foreach ($estandares as $estandar)
                document.getElementById('deleteForm_{{ $estandar->id }}').addEventListener('submit', function(event) {
                    event.preventDefault();
                    const deleteForm = this;

                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "¡No podrás revertir esto!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        cancelButtonText: "Cancelar",
                        confirmButtonText: "¡Sí, eliminarlo!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Eliminado!",
                                text: "El Estándar se Eliminó con Éxito.",
                                icon: "success"
                            });
                            // Envía el formulario de eliminación
                            deleteForm.submit();
                        }
                    });
                });
            @endforeach
        </script>
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
