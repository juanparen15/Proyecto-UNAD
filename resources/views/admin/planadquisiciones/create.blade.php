@extends('layouts.admin')
@section('title', 'Crear Mapa')
@section('style')

    <!-- Select2 -->
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
    <style>
        /* Agrega estilos CSS para el iframe responsivo */
        #simulacionIframe {
            width: 100%;
            height: 100%;
            max-width: 100%;
            border: 0;
        }

        /* Ajusta la altura del card en dispositivos móviles */
        @media (max-width: 767px) {
            .card-body {
                height: auto;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CRC-UNAD</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{ route('planadquisiciones.index') }}">Listado Mapa
                                </a></li> --}}
                            <li class="breadcrumb-item active">Mapa</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::open(['route' => 'planadquisiciones.store', 'method' => 'POST']) !!}
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <div class="form-row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="ciudad_id">CIUDAD:</label>
                                <select class="form-control select2 @error('ciudad_id') is-invalid @enderror"
                                    name="ciudad_id" id="ciudad_id" style="width: 100%">
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
                                <select id="estandar_id" name="estandar_id" class="form-control select2" style="width: 100%"
                                    required>
                                    <option value="" disabled selected>Seleccione un Estándar:</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipoemisora_id">Tipo de Simulación</label>
                                <select id="tipoemisora_id" name="tipoemisora_id" class="form-control select2"
                                    style="width: 100%" required>
                                    <option value="" disabled selected>Seleccione el Tipo de Simulación:</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="emisora_id">Emisora</label>
                                <select id="emisora_id" name="emisora_id" class="form-control select2" style="width: 100%"
                                    required>
                                    <option value="" disabled selected>Seleccione la Emisora:</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Mostrar" class="btn btn-primary style="width: 100%"">

                                <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                        <div class="form-row float-right col-md-10 px-md-2" style="height: 700px; width: 100%;">
                            <iframe style="width: 100%;" id="simulacionIframe" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            {!! Form::close() !!}
        </section>
        <!-- /.content -->
        {{-- </div> --}}
        <!-- /.content-wrapper -->
    @endsection
    @section('script')
        <!-- Chart.js -->
        <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- Select2 -->
        {!! Html::script('adminlte/plugins/select2/js/select2.full.min.js') !!}

        <script>
            $(function() {

                //Initialize Select2 Elements
                $('.select2').select2()

            });
        </script>

        <script>
            var ciudad_id = $('#ciudad_id');
            var estandar_id = $('#estandar_id');
            var tipoemisora_id = $('#tipoemisora_id');
            var emisora_id = $('#emisora_id');

            $(document).ready(function() {
                // Evento cuando cambia la opción en la lista de ciudades
                ciudad_id.change(function() {
                    var ciudad_id = $(this).val();
                    if (ciudad_id) {
                        // Realiza una solicitud AJAX para obtener los estandares
                        $.get('/get-estandares/' + ciudad_id, function(data) {
                            // Limpia la lista de estandares y añade los nuevos
                            $('#estandar_id').empty();
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
                                '<option disabled selected>Seleccione el Tipo de Simulación:</option>');
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


                // Evento cuando cambia la opción en la lista de tipos de emisora
                tipoemisora_id.change(function() {
                    var tipoemisora_id = $(this).val();
                    if (tipoemisora_id) {
                        // Realiza una solicitud AJAX para obtener las emisoras
                        $.get('/get-emisoras/' + tipoemisora_id, function(data) {
                            // Limpia la lista de emisoras y añade las nuevas
                            $('#emisora_id').empty();
                            // Agrega la opción predeterminada
                            $('#emisora_id').append(
                                '<option disabled selected>Seleccione la Emisora:</option>');
                            $.each(data, function(key, value) {
                                $('#emisora_id').append('<option value="' + value.id +
                                    '" name="' + value.emisora + '">' + value.emisora +
                                    '</option>');
                            });
                            // Selecciona automáticamente la primera opción
                            $('#emisora_id').val($('#emisora_id option:first').val());
                        });
                    } else {
                        // Si no se selecciona ningún tipo de emisora, limpia la lista de emisoras
                        $('#emisora_id').empty();
                    }
                });

            });

            // console.log("Selected City:", ciudad_id);
            // console.log("Selected Standard:", estandar_id);
            // console.log("Selected Type:", tipoemisora_id);
        </script>


        <script>
            $(document).ready(function() {

                $('form').submit(function(event) {

                    // Evitar que se recargue la página
                    event.preventDefault();

                    // Obtener los valores seleccionados
                    const selectedCity = $('#ciudad_id option:selected').attr('name');
                    const selectedStandard = $('#estandar_id option:selected').attr('name');
                    const selectedType = $('#tipoemisora_id option:selected').attr('name');
                    const selectedEmisora = $('#emisora_id option:selected').attr('name');


                    // Verifica si las variables son undefined
                    // console.log("City:", selectedCity);
                    // console.log("Standard:", selectedStandard);
                    // console.log("Type:", selectedType);
                    // console.log("Emisora:", selectedEmisora);

                    // Construir la nueva URL del iframe
                    let nuevaURL = "";

                    if (selectedEmisora) {
                        // Si se ha seleccionado una emisora, mostrar emisora
                        nuevaURL =
                            `{{ secure_asset('adminlte/simulaciones') }}/${encodeURIComponent(selectedCity)}/${encodeURIComponent(selectedStandard)}/${encodeURIComponent(selectedType)}/${encodeURIComponent(selectedEmisora)}/index.html`;
                    } else if (selectedType) {
                        // Si no se ha seleccionado una emisora pero se ha seleccionado un tipo, mostrar el tipo de emisora
                        nuevaURL =
                            `{{ secure_asset('adminlte/simulaciones') }}/${encodeURIComponent(selectedCity)}/${encodeURIComponent(selectedStandard)}/${encodeURIComponent(selectedType)}/index.html`;
                    }
                    // Actualizar la fuente del iframe con la nueva URL
                    $('#simulacionIframe').attr('src', nuevaURL);
                });
            });
        </script>
    @endsection
