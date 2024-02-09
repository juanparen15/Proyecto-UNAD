@extends('layouts.admin')
@section('title', 'Listado Mapa')
@section('style')
    <!-- SweetAlert2 -->
    {!! Html::style('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') !!}
    <!-- DataTables -->
    {!! Html::style('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}
@endsection
@section('content')
    <script>
        const Toast =
            Swal.fire({
                title: "¡Área en Desarrollo!",
                text: "Por favor, no hagas ninguna función. Mostrar mapas funciona para regresar.",
                icon: "warning",
                position: "center",
                showConfirmButton: true,
                // timer: 10000,
                // timerProgressBar: true,
                // didOpen: (toast) => {
                //     toast.onmouseenter = Swal.stopTimer;
                //     toast.onmouseleave = Swal.resumeTimer;
                // }
            });
    </script>
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
                            <li class="breadcrumb-item active">Listado Mapa</li>
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
                        <h3 class="card-title">Listado Mapa</h3>

                        <div class="card-tools">

                            {{-- @if (auth()->user()->hasRole('Admin'))
                                @if (session('showOnlyAdmin'))
                                    <a href="{{ route('planadquisiciones.index') }}" class="btn btn-primary">Ver todos los
                                        registros</a>
                                @else
                                    <a href="{{ route('planadquisiciones.showOnlyAdmin') }}" class="btn btn-primary">Ver mis
                                        registros</a>
                                @endif --}}
                            {{-- @else
                                <a href="{{ route('planadquisiciones.indexByArea', auth()->user()->area->id) }}"
                                    class="btn btn-primary">Ver registros de mi área</a> --}}
                            {{-- @endif --}}



                            {{-- @if (auth()->user()->hasRole('Admin'))
                                @if (session('showOnlyAdmin'))
                                    <a href="{{ route('planadquisiciones.index') }}" class="btn btn-primary"><i
                                            class="fas fa-ghost">
                                        </i> Ver todos los registros</a>
                                @else
                                    <a href="{{ route('planadquisiciones.showOnlyAdmin') }}" class="btn btn-primary"><i
                                            class="fas fa-parking"></i> Ver mis registros</a>
                                @endif
                            @endif --}}


                            @if (auth()->user()->hasRole('Admin'))
                                <a href="{{ route('planadquisiciones.create') }}" class="btn btn-primary">
                                    <i class="nav-icon fas fa-map"></i> Crear Mapas
                                </a>
                                <a href="{{ route('planadquisiciones.show') }}" class="btn btn-success">
                                    <i class="nav-icon fas fa-map"></i> Mostrar Mapas
                                </a>
                            @elseif (auth()->user()->hasRole('User'))
                                <a href="{{ route('planadquisiciones.show') }}" class="btn btn-success">
                                    <i class="nav-icon fas fa-map"></i> Mostrar Mapas
                                </a>
                            @endif

                            {{-- @can('planadquisiciones.export') --}}
                            {{-- <a href="{{ route('planadquisiciones.export') }}" class="btn btn-success">
                                <i class="far fa-file-excel"></i> <i class="fas fa-file-export"></i> Exportar Todo
                            </a> --}}
                            {{-- @endcan --}}
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">

                        <table id="example2" class="table table-hover text-nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CIUDAD</th>
                                    <th>ESTANDAR</th>
                                    <th>TIPO EMISORA</th>
                                    <th>EMISORA</th>
                                    <th>KMZ</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($planadquisiciones as $planadquisicion)
                                    <tr>
                                        <td>{{ $planadquisicion->id }}</td>
                                        <td>{{ $planadquisicion->fuente->estandar->ciudad->detciudad }}</td>
                                        <td>{{ $planadquisicion->fuente->estandar->detestandar }}</td>
                                        <td>{{ $planadquisicion->fuente->detfuente }}</td>
                                        <td>{{ $planadquisicion->emisora->emisora ?? 'No Aplica' }}</td>
                                        <td>{{ $planadquisicion->kmz }}</td>
                                        <td>
                                            <form action="{{ route('planadquisiciones.destroy', $planadquisicion) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')

                                                {{-- @can('exportar_planadquisiciones_excel') --}}
                                                {{-- <a class="btn btn-success btn-sm"
                                                    href="{{ route('exportar_planadquisiciones_excel', $planadquisicion) }}">
                                                    <i class="far fa-file-excel"></i> Exportar
                                                </a> --}}
                                                {{-- @endcan --}}

                                                {{-- @can('planadquisiciones.show') --}}
                                                {{-- <a class="btn btn-info btn-sm"
                                                    href="{{ route('planadquisiciones.show', $planadquisicion) }}">Detalles</a> --}}
                                                {{-- @endcan --}}


                                                {{-- @can('planadquisiciones.edit') --}}
                                                @if (auth()->user()->hasRole('Admin'))
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('planadquisiciones.edit', $planadquisicion) }}">Editar</a>

                                                    {{-- @endcan --}}

                                                    {{-- @can('planadquisiciones.destroy') --}}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="enviar_formulario()">Eliminar</button>
                                                    {{-- @endcan  --}}
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{-- {{ $planadquisiciones->links() }} --}}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        {{-- </div> --}}
    @endsection
    @section('script')
        <!-- SweetAlert2 -->
        {!! Html::script('adminlte/plugins/sweetalert2/sweetalert2.min.js') !!}

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
                        title: 'El Mapa se creó con éxito.'
                    })
                });
            </script>
        @endif
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
                        title: 'El Mapa se actualizó con éxito.'
                    })
                });
            </script>
        @endif
        <script>
            function enviar_formulario() {
                event.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, estoy seguro!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            '¡Eliminado!',
                            'El Mapa se eliminó con éxito.',
                            'success'
                        );
                        document.delete_form.submit();
                    }
                });
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
