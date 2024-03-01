@extends('layouts.admin')
@section('title', 'Editar la Emisora')
@section('style')
    <!-- Select2 -->
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
@endsection
@section('content')
    <script>
        Swal.bindClickHandler();
        /* Bind a mixin to a click handler */
        Swal.mixin({
            icon: "info",
            toast: true,
            position: "top-center",
            title: 'Se debe agregar la coordenada X en números decimales.',
            text: 'Ejemplo: 4.60971',
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).bindClickHandler("coordenadaX");

        Swal.bindClickHandler();
        /* Bind a mixin to a click handler */
        Swal.mixin({
            icon: "info",
            toast: true,
            position: "top-center",
            title: 'Se debe agregar la coordenada Y en números decimales.',
            text: 'Ejemplo: -74.08175',
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).bindClickHandler("coordenadaY");

        Swal.bindClickHandler();
        /* Bind a mixin to a click handler */
        Swal.mixin({
            // icon: "info",
            toast: true,
            position: "top-center",
            width: 760,
            // height: 515,
            responsive: true,
            html: '<iframe width="660" height="415" src="{{ asset('adminlte/dist/video/Ejemplo Leyenda KMZ.mp4') }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
        }).bindClickHandler("leyenda");
    </script>
    <style>
        iframe {
            width: 100%;
            /* height: 100%; */
        }

        /* Pantallas de 320px o superior */
        @media (min-width: 320px) {
            iframe {
                width: 100%;
                /* height: 100%; */
            }
        }

        /* Pantalla 768px o superior */
        @media (min-width: 768px) {
            iframe {
                width: 100%;
                /* height: 100%; */
            }
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Emisora</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.emisoras.index') }}">Emisora</a></li>
                            <li class="breadcrumb-item active">Editar Emisora</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {{-- {!! Form::model($emisora, ['route' => ['admin.emisoras.update', $emisora], 'method' => 'PUT']) !!} --}}
            <form method="POST" action="{{ route('admin.emisoras.update', $emisora) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="ciudad_id">CIUDAD:</label>
                            <select class="select2 @error('ciudad_id') is-invalid @enderror" name="ciudad_id" id="ciudad_id"
                                style="width: 100%;">
                                <option disabled>Selecciona una Ciudad</option>
                                @foreach ($ciudades as $ciudad)
                                    <option value="{{ $ciudad->id }}"
                                        {{ old('ciudad_id', $emisora->tipo->estandar->ciudad_id) == $ciudad->id ? 'selected' : '' }}>
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
                                        {{ old('estandar_id', $emisora->tipo->estandar_id) == $estandar->id ? 'selected' : '' }}>
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
                        <div hidden class="form-group tipoemisora_id">
                            <label for="tipoemisora_id">TIPO DE SIMULACIÓN:</label>
                            <select class="select2 @error('tipoemisora_id') is-invalid @enderror" name="tipoemisora_id"
                                id="tipoemisora_id" style="width: 100%;" required>
                                <option value="" disabled selected>Seleccione el Tipo de Simulación:</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ old('tipoemisora_id', $emisora->tipoemisora_id) == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->detfuente }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($emisora->exists)
                                <small class="text-danger" style="font-size: 10pt">No cambiar el Tipo de Simulación (Altera
                                    el
                                    orden de los mapas).</small>
                            @endif
                            <span id="tipoemisora_id-error" class="invalid-feedback" role="alert"></span>
                            <!-- Mensaje de error -->
                            @error('tipoemisora_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group emisora">
                            <label for="emisora">NOMBRE DE LA EMISORA:</label>
                            <input required type="text" name="emisora" id="emisora" class="form-control"
                                value="{{ old('emisora', $emisora->emisora) }}">
                            <span id="emisora-error" class="invalid-feedback" role="alert"></span>
                            <!-- Mensaje de error -->
                            @error('emisora')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="coordenadas_fields" id="coordenadas_fields" style="display: block;">
                            <div class="form-group">
                                <label for="coordenadaX">COORDENADA (X) DE LA CIUDAD:</label>
                                <i class="btn btn-primary fas fa-question" coordenadaX="#my-template"></i>
                                <input type="text" id="coordenadaX" name="coordenadaX" class="form-control"
                                    style="width: 100%" value="{{ old('coordenadaX', $emisora->coordenadaX) }}">
                            </div>

                            <div class="form-group">
                                <label for="coordenadaY">COORDENADA (Y) DE LA CIUDAD:</label>
                                <i class="btn btn-primary fas fa-question" coordenadaY="#my-template"></i>
                                <input type="text" id="coordenadaY" name="coordenadaY" class="form-control"
                                    style="width: 100%" value="{{ old('coordenadaY', $emisora->coordenadaY) }}">
                            </div>

                            <div class="form-group">
                                <label for="kmzRadio">ARCHIVO KMZ (ELEMENTOS DE RADIO):</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary btn-file">
                                            Examinar <input accept=".kmz" class="custom-file-input" name="kmzRadioFile"
                                                type="file" id="kmzRadioFile" lang="es">
                                        </span>
                                    </label>
                                    <input class="form-control" id="kmzRadio" readonly="readonly" name="kmzRadio"
                                        type="text" value="{{ old('kmzRadio', $emisora->kmzRadio) }}" lang="es">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="leyendaSignal">LEYENDA DE NIVEL DE SEÑAL:</label>
                                <i class="btn btn-primary fas fa-question" leyenda="#my-template"></i>
                                <textarea id="leyendaSignal" name="leyendaSignal" class="form-control" style="width: 100%" rows="5">{{ old('leyendaSignal', $emisora->leyendaSignal) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="kmz">ARCHIVO KMZ (NIVEL DE SEÑAL):</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary btn-file">
                                            Examinar <input accept=".kmz" class="custom-file-input" name="kmzFile"
                                                type="file" id="kmzFile" lang="es">
                                        </span>
                                    </label>
                                    <input class="form-control" id="kmz" readonly="readonly" name="kmz"
                                        type="text" value="{{ old('kmz', $emisora->kmz) }}" lang="es">
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
        {{-- <script>
            $(document).ready(function() {
                $('#tipoemisora_id').on('change', function() {
                    var tipo = $(this).val().toLowerCase(); // Convertir a minúsculas para comparar
                    var errorSpan = $('#tipoemisora_id-error'); // Obtener el span del mensaje de error
                    var coordenadasFields = $('#coordenadas_fields');

                    if (tipo.includes('multicobertura')) {
                        coordenadasFields.hide();
                    } else {
                        coordenadasFields.show();
                    }
                    if (tipo.includes('interferencia')) {
                        coordenadasFieldsInter.hide();
                        coordenadasFields.hide();
                    } else {
                        coordenadasFieldsInter.show();
                        coordenadasFields.show();
                    }
                });
            });
        </script> --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var detfuenteInput = document.getElementById('tipoemisora_id');
                var coordenadasFields = document.getElementById('coordenadas_fields');

                detfuenteInput.addEventListener('select', function() {
                    var detfuenteValue = this.value.toLowerCase();

                    // if (detfuenteValue.includes('cobertura individual')) {
                    //     coordenadasFields.style.display = 'block';
                    // } else {
                    //     coordenadasFields.style.display = 'none';
                    // }
                    if (detfuenteValue.includes('multicobertura')) {
                        coordenadasFields.style.display = 'none';
                    } else {
                        coordenadasFields.style.display = 'block';
                    }
                    if (detfuenteValue.includes('interferencia')) {
                        coordenadas_fields.style.display = 'none';
                    } else {
                        coordenadas_fields.style.display = 'block';
                    }
                });

                // Ejecutar el evento 'input' en la carga de la página para verificar el valor inicial de 'detfuente'
                detfuenteInput.dispatchEvent(new Event('select'));
            });
        </script>
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                var detemisoraInput = document.getElementById('emisora');
                var coordenadasFields = document.getElementById('coordenadas_fields');

                detfuenteInput.addEventListener('input', function() {
                    var detfuenteValue = this.value.toLowerCase();

                    if (!detfuenteValue.includes('multicobertura')) {
                        coordenadasFields.style.display = 'block';
                    } else {
                        coordenadasFields.style.display = 'none';
                    }
                    if (!detfuenteValue.includes('interferencia')) {
                        coordenadasFieldsInter.style.display = 'block';
                    } else {
                        coordenadasFieldsInter.style.display = 'none';
                    }
                });
                // Ejecutar el evento 'input' en la carga de la página para verificar el valor inicial de 'detfuente'
                detfuenteInput.dispatchEvent(new Event('input'));
            });
        </script> --}}
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
                // tipoemisora_id.change(function() {
                //     // var tipoemisora_id = $(this).val();
                //     var tipoemisora_id = this.value.toLowerCase();
                //     if (tipoemisora_id) {
                //         // console.log('Tipo de Emisora:', tipoemisora_id);
                //         if ($('#tipoemisora_id option:selected').attr('name') === 'Multicobertura' || $(
                //                 '#tipoemisora_id option:selected').attr('name') === 'Interferencia') {
                //             $('.emisora').hide();
                //             $('.coordenadas_fields').hide();
                //             $('#emisora').empty();
                //             $('#coordenadaX').empty();
                //             $('#coordenadaY').empty();
                //             // $('#kmzRadio').empty();
                //             $('#leyendaSignal').empty();
                //             // $('#kmzInterferencia').empty();
                //         } else {
                //             $('.emisora').show();
                //             $('.coordenadas_fields').show();
                //         }
                //     } else {
                //         $('#emisora').empty();
                //         $('#coordenadaX').empty();
                //         $('#coordenadaY').empty();
                //         // $('#kmzRadio').empty();
                //         $('#leyendaSignal').empty();
                //         // $('#kmzInterferencia').empty();
                //     }
                // });
            });
        </script>

    @endsection
