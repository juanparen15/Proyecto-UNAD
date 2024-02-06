@extends('layouts.admin')
@section('title', 'Importar datos')
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
                <div class="form-group">
                    <form action="{{ route('planadquisicione.import.excel') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" required>
                        <button id="importButton" class="btn btn-primary float-right">Importar Graficas</button>
                    </form>
                </div>
                <div class="form-group">
                    <form action="{{ route('planadquisicione.delete.excel') }}" method="POST" enctype="multipart/form-data"
                        id="deleteForm">
                        @csrf
                        <button id="deleteButton" class="btn btn-danger float-right">Eliminar Graficas</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('deleteButton').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, eliminarlo!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Eliminado!",
                        text: "Tus gráficas han sido eliminadas.",
                        icon: "success"
                    });

                    document.getElementById('deleteForm').submit();
                }
            });
        });
    </script>

    <script>
        document.getElementById('importButton').addEventListener('click', function(event) {

            const fileInput = document.querySelector('input[name="file"]');
            if (fileInput.files.length === 0) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se ha adjuntado el archivo de Excel.'
                });
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                
                Toast.fire({
                    icon: "success",
                    title: "Importación Satisfactoria",
                });
                document.getElementById('importForm').submit();


            }
        });
    </script>

@endsection
