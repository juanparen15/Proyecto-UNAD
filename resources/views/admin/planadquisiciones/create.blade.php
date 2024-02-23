@extends('layouts.admin')
@section('title', 'Crear Mapa')
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
                        <h1>Crear Mapa</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.planadquisiciones.index') }}">Mapa</a></li>
                            <li class="breadcrumb-item active">Crear Mapa</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {{-- {!! Form::model($inventario, ['route' => ['planadquisiciones.create', $inventario->id], 'method' => 'PUT']) !!} --}}
            {!! Form::open(['route' => 'admin.planadquisiciones.store', 'method' => 'POST']) !!}

            <div class="card card-primary">
                {{-- <div class="card-header">
              <h3 class="card-title">General</h3>
            </div> --}}
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ciudad_id">CIUDAD:</label>
                                <select class="form-control select2 @error('ciudad_id') is-invalid @enderror"
                                    name="ciudad_id" id="ciudad_id" style="width: 100%">
                                    <option value="" disabled selected>Seleccione una Ciudad:</option>
                                    @foreach ($ciudades as $ciudad)
                                        <option value="{{ $ciudad->id }}" name="{{ $ciudad->detciudad }}"
                                            {{ old('ciudad_id') == $ciudad->id ? 'selected' : '' }}>
                                            {{ $ciudad->detciudad }}</option>
                                    @endforeach
                                </select>
                                @error('ciudad_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estandar_id">ESTANDAR:</label>
                                <select id="estandar_id" name="estandar_id"
                                    class="form-control select2 @error('estandar_id') is-invalid @enderror"
                                    style="width: 100%" required>
                                    <option value="" disabled selected>Seleccione un Estándar:</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipoemisora_id">TIPO DE SIMULACIÓN:</label>
                                <select id="tipoemisora_id" name="tipoemisora_id"
                                    class="form-control select2 @error('tipoemisora_id') is-invalid @enderror"
                                    style="width: 100%" required>
                                    <option value="" disabled selected>Seleccione el Tipo de Simulación:</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group emisora_id">
                                <label for="emisora_id">EMISORA:</label>
                                <select id="emisora_id" name="emisora_id"
                                    class="form-control select2 @error('emisora_id') is-invalid @enderror"
                                    style="width: 100%">
                                    <option value="" disabled selected>Seleccione la Emisora:</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="coordenadaX">COORDENADA X:</label>
                                <input type="text" id="coordenadaX" name="coordenadaX" class="form-control"
                                    style="width: 100%">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="coordenadaY">COORDENADA Y:</label>
                                <input type="text" id="coordenadaY" name="coordenadaY" class="form-control"
                                    style="width: 100%">
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-8">
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

                        {{-- <div class="col-md-4">
                            {{-- <div class="form-group"> --}}
                        {{-- <input type="file" name="file" class="form-control custom-file-input"
                                id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Seleccionar Archivo</label>
                        </div> --}}
                        {{-- </div> --}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-12 mb-2">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Registrar" class="btn btn-primary float-right">
                </div>
            </div>
            {!! Form::close() !!}
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

                // Evento cuando cambia la opción en la lista de estandares
                estandar_id.change(function() {
                    var estandar_id = $(this).val();
                    if (estandar_id) {
                        // Realiza una solicitud AJAX para obtener los tipos de emisora
                        $.get('/get-tipos-emisora/' + estandar_id, function(data) {

                            // Limpia la lista de tipos de emisora y añade los nuevos
                            $('#tipoemisora_id').empty();
                            // Agrega la opción predeterminada
                            $('#tipoemisora_id').append(
                                '<option disabled selected>Seleccione el Tipo de Simulación:</option>'
                            );

                            $('#emisora_id').empty();

                            $('#emisora_id').append(
                                '<option disabled selected>Seleccione la Emisora:</option>'
                            );
                            $.each(data, function(key, value) {
                                $('#tipoemisora_id').append('<option value="' + value.id +
                                    '" name="' + value.detfuente + '">' + value.detfuente +
                                    '</option>');
                            });
                            // Selecciona automáticamente la primera opción
                            $('#tipoemisora_id').val($('#tipoemisora_id option:first').val());
                        });
                    } else {
                        // Si no se selecciona ningún estandar, limpia la lista de tipos de emisora
                        $('#tipoemisora_id').empty();
                    }
                });

                tipoemisora_id.change(function() {
                    var tipoemisora_id = $(this).val();
                    if (tipoemisora_id) {
                        // console.log('Tipo de Emisora:', tipoemisora_id);
                        if ($('#tipoemisora_id option:selected').attr('name') === 'Multicobertura' || $(
                                '#tipoemisora_id option:selected').attr('name') === 'Interferencia') {
                            $('.emisora_id').hide();
                            $('#emisora_id').empty();
                        } else {
                            $('.emisora_id').show();
                            // Realiza una solicitud AJAX para obtener los tipos de emisora
                            $.get('/get-emisoras/' + tipoemisora_id, function(data) {

                                // Limpia la lista de tipos de emisora y añade los nuevos
                                $('#emisora_id').empty();
                                // Agrega la opción predeterminada
                                $('#emisora_id').append(
                                    '<option disabled selected>Seleccione la Emisora:</option>'
                                );
                                $.each(data, function(key, value) {
                                    $('#emisora_id').append('<option value="' + value.id +
                                        '" name="' + value.emisora + '">' + value.emisora +
                                        '</option>');
                                });
                                // Selecciona automáticamente la primera opción
                                $('#emisora_id').val($('#emisora_id option:first').val());
                            });
                        }
                    } else {
                        $('#emisora_id').empty();
                    }
                });
            });
        </script>
        <script>
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this);
                var numFiles = input.get(0).files ? input.get(0).files.length : 1;
                var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });
            $(document).ready(function() {
                $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
                    var input = $(this).parents('.input-group').find(':text');
                    var log = numFiles > 1 ? numFiles + ' files selected' : label;
                    if (input.length) {
                        input.val(log);
                    } else {
                        if (log) alert(log);
                    }
                });
            });
        </script>
    @endsection
