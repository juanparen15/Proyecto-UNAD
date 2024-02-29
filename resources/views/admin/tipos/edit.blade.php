@extends('layouts.admin')
@section('title', 'Crear Nuevo Tipo de Simulación')
@section('style')
    <!-- Select2 -->
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Nuevo Tipo de Simulación</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.tipos.index') }}">Tipo de Simulación</a>
                            </li>
                            <li class="breadcrumb-item active">Editar el Tipo de Simulación</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {{-- {!! Form::model([$tipo, 'route' => ['admin.tipos.update', $tipo], 'method' => 'PUT']) !!} --}}
            <form method="POST" action="{{ route('admin.tipos.update', $tipo) }}">
                @csrf
                @method('PUT')
                {{-- <form action="{{$tipos, route('admin.tipos.update', $tipos) }}" method="PUT"> --}}
                {{-- @csrf --}}
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="ciudad_id">CIUDAD:</label>
                            <select required class="select2 @error('ciudad_id') is-invalid @enderror" name="ciudad_id" id="ciudad_id"
                                style="width: 100%;">
                                <option disabled>Selecciona una Ciudad</option>
                                @foreach ($ciudades as $ciudad)
                                    <option value="{{ $ciudad->id }}"
                                        {{ old('ciudad_id', $tipo->estandar->ciudad_id) == $ciudad->id ? 'selected' : '' }}>
                                        {{ $ciudad->detciudad }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ciudad_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="estandar_id">ESTÁNDAR:</label>
                            <select required class="select2 @error('estandar_id') is-invalid @enderror" name="estandar_id"
                                id="estandar_id" style="width: 100%;">
                                <option value="" disabled selected>Seleccione un Estándar:</option>
                                @foreach ($estandares as $estandar)
                                    <option value="{{ $estandar->id }}"
                                        {{ old('estandar_id', $tipo->estandar_id) == $estandar->id ? 'selected' : '' }}>
                                        {{ $estandar->detestandar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estandar_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="estandar_id">TIPO DE SIMULACIÓN:</label>
                            <input required type="text" name="detfuente" id="detfuente" class="form-control"
                                value="{{ old('detfuente', $tipo->detfuente) }}">
                            @error('detfuente')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="coordenadas_fields" style="display: none;">
                            <div class="form-group">
                                <label for="coordenadaX">COORDENADA X:</label>
                                <input type="text" id="coordenadaX" name="coordenadaX" class="form-control"
                                    style="width: 100%">
                            </div>

                            <div class="form-group">
                                <label for="coordenadaY">COORDENADA Y:</label>
                                <input type="text" id="coordenadaY" name="coordenadaY" class="form-control"
                                    style="width: 100%">
                            </div>

                            <div class="form-group">
                                <label for="kmz">ARCHIVO KMZ:</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary btn-file">
                                            Examinar <input accept=".kmz" class="hidden" name="kmz" type="file"
                                                id="kmz">
                                        </span>
                                    </label>
                                    <input class="form-control" id="kmz_captura" readonly="readonly" name="kmz_captura"
                                        type="text" value="">
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
                        <input type="submit" value="Actualizar" class="btn btn-primary float-right">
                    </div>
                </div>
                {{-- {!! Form::close() !!} --}}
            </form>
        </section>
        <!-- /.content -->
        {{-- </div> --}}
        <!-- /.content-wrapper -->

    @endsection
    @section('script')

        <!-- Select2 -->
        {!! Html::script('adminlte/plugins/select2/js/select2.full.min.js') !!}
        <script>
            $(function() {

                //Initialize Select2 Elements
                $('.select2').select2()

            })
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var detfuenteInput = document.getElementById('detfuente');
                var coordenadasFields = document.getElementById('coordenadas_fields');

                detfuenteInput.addEventListener('input', function() {
                    var detfuenteValue = this.value.toLowerCase();

                    if (detfuenteValue.includes('multicobertura') || detfuenteValue.includes('interferencia')) {
                        coordenadasFields.style.display = 'block';
                    } else {
                        coordenadasFields.style.display = 'none';
                    }
                });

                // Ejecutar el evento 'input' en la carga de la página para verificar el valor inicial de 'detfuente'
                detfuenteInput.dispatchEvent(new Event('input'));
            });
        </script>
        <script>
            $(document).ready(function() {
                var ciudad_id = $('#ciudad_id');
                var estandar_id = $('#estandar_id');
                var tipoemisora_id = $('#tipoemisora_id');
                var emisora_id = $('#emisora_id');

                // Evento cuando cambia la opción en la lista de ciudades
                ciudad_id.change(function() {
                    var ciudad_id = $(this).val();
                    if (ciudad_id) {
                        // Realiza una solicitud AJAX para obtener los estandares
                        $.get('/get-estandares/' + ciudad_id, function(data) {
                            // Limpia la lista de estandares y añade los nuevos
                            $('#estandar_id').empty();


                            $('#tipoemisora_id').empty();

                            $('#tipoemisora_id').append(
                                '<option disabled selected>Seleccione el Tipo de Simulación:</option>'
                            );

                            $('#emisora_id').empty();

                            $('#emisora_id').append(
                                '<option disabled selected>Seleccione la Emisora:</option>'
                            );
                            // Agrega la opción predeterminada
                            $('#estandar_id').append(
                                '<option disabled selected>Seleccione un Estándar:</option>');
                            $.each(data, function(key, value) {
                                $('#estandar_id').append(
                                    '<option value="' + value.id + '" name="' + value
                                    .detestandar + '">' + value.detestandar + '</option>');
                            });
                            // Selecciona automáticamente la primera opción
                            $('#estandar_id').val($('#estandar_id option:first').val());
                        });
                    } else {
                        // Si no se selecciona ninguna ciudad, limpia la lista de estandares
                        $('#estandar_id').empty();
                    }
                });
            });
        </script>

    @endsection
