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
    <div class="content-wrapper bg-black">
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
                            <li class="breadcrumb-item"><a href="{{ route('planadquisiciones.index') }}">Listado Mapa
                                </a></li>
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

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="segmento_id">CIUDAD:</label>
                                <select class="form-control select2 @error('segmento_id') is-invalid @enderror"
                                    name="segmento_id" id="segmento_id" style="width: 100%">
                                    <option value="" disabled selected>Seleccione una Ciudad:
                                    </option>
                                    @foreach ($segmentos as $segmento)
                                        <option value="{{ $segmento->id }}" name="{{ $segmento->detsegmento }}"
                                            {{ old('segmento_id') == $segmento->id ? 'selected' : '' }}>
                                            {{ $segmento->detsegmento }}</option>
                                    @endforeach
                                </select>
                                @error('segmento_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="familias_id">Estandar</label>
                                <select id="familias_id" name="familias_id" class="form-control select2" style="width: 100%"
                                    required>
                                    <option value="" disabled selected>Seleccione un Estandar:</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estandar_id">Tipo de Emisora</label>
                                <select id="estandar_id" name="estandar_id" class="form-control select2" style="width: 100%"
                                    required>
                                    <option value="" disabled selected>Seleccione el Tipo de Emisora:</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipoemisora_id">Emisora</label>
                                <select id="tipoemisora_id" name="tipoemisora_id" class="form-control select2"
                                    style="width: 100%" required>
                                    <option value="" disabled selected>Seleccione la Emisora:</option>
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="tipoprioridade_id">EMISORA:</label>
                                <select class="select2 @error('tipoprioridade_id') is-invalid @enderror"
                                    name="tipoprioridade_id" id="tipoprioridade_id" style="width: 100%;">
                                    <option disabled selected>Seleccione la Emisora</option>
                                    @foreach ($tipoprioridades as $tipoprioridad)
                                        <option value="{{ $tipoprioridad->id }}"
                                            {{ old('tipoprioridade_id') == $tipoprioridad->id ? 'selected' : '' }}>
                                            {{ $tipoprioridad->detprioridad }}</option>
                                    @endforeach
                                </select>
                                @error('tipoprioridade_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                            <div class="row">
                                <div class="col-2 mb-2">
                                    <input type="submit" value="Mostrar" class="btn btn-primary float-left">

                                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-row float-right col-md-8 px-md-2" style="height: 700px; width: 100%;">
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
        {{-- <div class="modal fade" id="notaModal" tabindex="-1" role="dialog" aria-labelledby="notaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notaModalLabel">Mensaje de Validación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Por favor, ingrese solo letras, números o guión (-) en el campo de notas.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary float-right" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> --}}
    @endsection
    @section('script')
        <!-- Chart.js -->
        <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
        <!-- Otros scripts Chart.js -->
        <!-- Select2 -->
        {!! Html::script('adminlte/plugins/select2/js/select2.full.min.js') !!}
        <!-- Tu otro script personalizado aquí -->
        <script>
            $(function() {

                //Initialize Select2 Elements
                $('.select2').select2()

            });
        </script>
        <script>
            var segmento_id = $('#segmento_id');
            var familias_id = $('#familias_id');
            segmento_id.change(function() {
                $.ajax({
                    url: "{{ route('obtener_familias') }}",
                    method: 'GET',
                    data: {
                        segmento_id: segmento_id.val(),
                    },
                    success: function(data) {
                        familias_id.empty();
                        familias_id.append(
                            '<option disabled selected>Seleccione un Estandar:</option>');
                        $.each(data, function(index, element) {
                            familias_id.append('<option  name="' + element.detfamilia +
                                '" value="' +
                                element.id + '">' + element.detfamilia +
                                '</option>')
                        });

                    }
                });
            });
        </script>

        <script>
            var estandar_id = $('#estandar_id');
            familias_id.change(function() {
                $.ajax({
                    url: "{{ route('obtener_tipoEmisoras') }}",
                    method: 'GET',
                    data: {
                        estandar_id: familias_id.val(),
                    },
                    success: function(data) {
                        estandar_id.empty();
                        estandar_id.append(
                            '<option disabled selected>Seleccione el Tipo de Emisora:</option>');
                        $.each(data, function(index, element) {
                            estandar_id.append('<option name="' + element.detfuente + '" value="' +
                                element.id + '">' + element
                                .detfuente + '</option>');
                        });
                    }
                });
            });
        </script>

        <script>
            var tipoemisora_id = $('#tipoemisora_id');
            estandar_id.change(function() {
                $.ajax({
                    url: "{{ route('obtener_emisora') }}",
                    method: 'GET',
                    data: {
                        tipoemisora_id: estandar_id.val(),
                    },
                    success: function(data) {
                        tipoemisora_id.empty();
                        tipoemisora_id.append(
                            '<option disabled selected>Seleccione la Emisora:</option>');
                        $.each(data, function(index, element) {
                            tipoemisora_id.append('<option name="' + element.emisora + '" value="' +
                                element.id + '">' + element
                                .emisora + '</option>');
                        });
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Evento al enviar el formulario
                $('form').submit(function(event) {
                    // Evitar que se recargue la página
                    event.preventDefault();

                    // Obtener los valores seleccionados
                    const selectedCity = $('#segmento_id option:selected').attr('name');
                    // var selectedCity = $('#segmento_id');
                    const selectedStandard = $('#familias_id option:selected').attr('name');
                    // var selectedStandard = $('#familias_id');
                    const selectedType = $('#estandar_id option:selected').attr('name');
                    // var selectedType = $('#estandar_id');
                    const selectedEmisora = $('#tipoemisora_id option:selected').attr('name');
                    // var selectedEmisora = $('#tipoemisora_id');

                    // Verifica si las variables son undefined
                    // console.log("City:", selectedCity);
                    // console.log("Standard:", selectedStandard);
                    // console.log("Type:", selectedType);
                    // console.log("Emisora:", selectedEmisora);

                    // Construir la nueva URL del iframe
                    let nuevaURL = "";

                    if (selectedEmisora) {
                        // Si se ha seleccionado una emisora, mostrar esa emisora
                        nuevaURL =
                            `{{ asset('adminlte/simulaciones') }}/${encodeURIComponent(selectedCity)}/${encodeURIComponent(selectedStandard)}/${encodeURIComponent(selectedType)}/${encodeURIComponent(selectedEmisora)}/index.html`;
                    } else if (selectedType) {
                        // Si no se ha seleccionado una emisora pero se ha seleccionado un tipo, mostrar ese tipo
                        nuevaURL =
                            `{{ asset('adminlte/simulaciones') }}/${encodeURIComponent(selectedCity)}/${encodeURIComponent(selectedStandard)}/${encodeURIComponent(selectedType)}/index.html`;
                    }
                    // Actualizar la fuente del iframe con la nueva URL
                    $('#simulacionIframe').attr('src', nuevaURL);
                });
            });

            // $('#selectedEmisora').change(function() {
            //     // Obtener el name de ciudad, estandar, tipoEmisora y emisora seleccionados
            //     const selectedCity = $('#segmento_id option:selected').attr('name');
            //     // var selectedCity = $('#segmento_id');
            //     const selectedStandard = $('#familias_id option:selected').attr('name');
            //     // var selectedStandard = $('#familias_id');
            //     const selectedType = $('#estandar_id option:selected').attr('name');
            //     // var selectedType = $('#estandar_id');
            //     const selectedEmisora = $('#tipoemisora_id option:selected').attr('name');

            //     // Construir la nueva URL del iframe
            //     nuevaURL =
            //         `{{ asset('adminlte/simulaciones') }}/${encodeURIComponent(selectedCity)}/${encodeURIComponent(selectedStandard)}/${encodeURIComponent(selectedType)}/${encodeURIComponent(selectedEmisora)}/index.html`;

            //     // Actualizar la fuente del iframe con la nueva URL
            //     $('#simulacionIframe').attr('src', nuevaURL);
            // });
        </script>
        {{-- <script>
            $(document).ready(function() {
                // Evento al enviar el formulario
                $('form').submit(function(event) {
                    // Evitar que se recargue la página
                    event.preventDefault();

                    // Obtener los valores seleccionados
                    const selectedCity = $('#segmento_id option:selected').attr('name');
                    // var selectedCity = $('#segmento_id');
                    const selectedStandard = $('#familias_id option:selected').attr('name');
                    // var selectedStandard = $('#familias_id');
                    const selectedType = $('#estandar_id option:selected').attr('name');
                    // var selectedType = $('#estandar_id');
                    const selectedEmisora = $('#tipoemisora_id option:selected').attr('name');
                    // var selectedEmisora = $('#tipoemisora_id');

                    // Verifica si las variables son undefined
                    console.log("City:", selectedCity);
                    console.log("Standard:", selectedStandard);
                    console.log("Type:", selectedType);
                    console.log("Emisora:", selectedEmisora);

                    // Construir la nueva URL del iframe
                    let nuevaURL = "";

                    if (selectedEmisora) {
                        nuevaURL =
                            `{{ asset('adminlte/simulaciones') }}/${encodeURIComponent(selectedCity)}/${encodeURIComponent(selectedStandard)}/${encodeURIComponent(selectedType)}/${encodeURIComponent(selectedEmisora)}/index.html`;
                    }
                    // Actualizar la fuente del iframe con la nueva URL
                    $('#simulacionIframe').attr('src', nuevaURL);
                });
            });
        </script> --}}
    @endsection
