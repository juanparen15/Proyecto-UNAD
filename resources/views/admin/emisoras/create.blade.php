@extends('layouts.admin')
@section('title', 'Crear Nuevo Tipo de Simulación')
@section('style')
    <!-- Select2 -->
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
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
                        <h1>Crear Nuevo Tipo de Simulación</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.tipos.index') }}">Tipo de Simulación</a>
                            </li>
                            <li class="breadcrumb-item active">Crear Nuevo Tipo de Simulación</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::open(['route' => 'admin.emisoras.store', 'method' => 'POST']) !!}
            <div class="card">
                {{--  <div class="card-header">
              <h3 class="card-title">General</h3>
            </div>  --}}
                <div class="card-body">

                    <div class="form-group">
                        <label for="ciudad_id">Ciudad:</label>
                        <select class="form-control select2 @error('ciudad_id') is-invalid @enderror" name="ciudad_id"
                            id="ciudad_id" style="width: 100%">
                            <option value="" disabled selected>Seleccione una Ciudad:
                            </option>
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
                    <div class="form-group">
                        <label for="estandar_id">Estándar</label>
                        <select id="estandar_id" name="estandar_id"
                            class="form-control select2 @error('estandar_id') is-invalid @enderror" style="width: 100%"
                            required>
                            <option value="" disabled selected>Seleccione un Estándar:</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipoemisora_id">Tipo de Simulación</label>
                        <select id="tipoemisora_id" name="tipoemisora_id"
                            class="form-control select2 @error('tipoemisora_id') is-invalid @enderror" style="width: 100%"
                            required>
                            <option value="" disabled selected>Seleccione el Tipo de Simulación:</option>
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label('emisora', 'NOMBRE DE LA EMISORA') !!}
                        {!! Form::text('emisora', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese el Nombre de la Emisora',
                        ]) !!}
                        @error('emisora')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-12 mb-2">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Registrar" class="btn btn-primary float-right">
                </div>
            </div>
            {!! Form::close() !!}
        </section>
        <!-- /.content -->
    </div>
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
                            $('#estandar_id').append('<option value="' + value.id +
                                '" name="' + value.detestandar + '">' + value
                                .detestandar + '</option>');
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

@endsection