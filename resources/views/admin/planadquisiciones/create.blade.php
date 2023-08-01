@extends('layouts.admin')
@section('title', 'Inventario')
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
                        <h1>Inventario</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('planadquisiciones.index') }}">Listado Inventario
                                </a></li>
                            <li class="breadcrumb-item active">Inventario</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::open(['route' => 'planadquisiciones.store', 'method' => 'POST']) !!}
            <div class="card">
                <div class="card-body">

                    <div class="form-row">


                        {{-- <div class="form-group has-success">
                            <label class="form-label mt-4" for="inputValid">Valid input</label>
                            <input type="text" value="correct value" class="form-control is-valid" id="inputValid">
                            <div class="valid-feedback">Success! You've done it.</div>
                          </div> --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="area_id">OFICINA PRODUCTORA:</label>
                                <select class="select2 @error('area_id') is-invalid @enderror" name="area_id" id="area_id"
                                    style="width: 100%;">
                                    <option disabled selected>Seleccione una Unidad Administrativa</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}" selected>{{ $area->nomarea }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="modalidad_id">OBJETO:</label>
                                <select class="select2 @error('modalidad_id') is-invalid @enderror" name="modalidad_id"
                                    id="modalidad_id" style="width: 100%;">
                                    <option disabled selected>Seleccione un Objeto</option>
                                    @foreach ($modalidades as $modalidad)
                                        <option value="{{ $modalidad->id }}"
                                            {{ old('modalidad_id') == $modalidad->id ? 'selected' : '' }}>
                                            {{ $modalidad->detmodalidad }}</option>
                                    @endforeach
                                </select>
                                @error('modalidad_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="objeto">Objeto:</label>
                            <input type="text" placeholder="Escriba el Objeto Documental" name="objeto" id="objeto"
                                class="form-control" required>
                        </div>
                    </div> --}} -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="requiproyecto_id">CODIGO DE DEPENDENCIA:</label>
                                <select class="select2 @error('requiproyecto_id') is-invalid @enderror"
                                    name="requiproyecto_id" id="requiproyecto_id" style="width: 100%;">
                                    <option value="" disabled selected>Seleccione Codigo de Dependencia</option>
                                    @foreach ($requiproyectos as $requiproyectoId => $requiproyecto)
                                        <option value="{{ $requiproyectoId }}" selected>{{ $requiproyecto }}</option>
                                    @endforeach
                                </select>
                                @error('requiproyecto_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="segmento_id">TIPO DE SERIE DOCUMENTAL:</label>
                                <select class="select2 @error('segmento_id') is-invalid @enderror" name="segmento_id"
                                    id="segmento_id" style="width: 100%;">
                                    <option value="" disabled selected>Seleccione un Tipo de Series Documentales:
                                    </option>
                                    @foreach ($segmentos as $segmento)
                                        <option value="{{ $segmento->id }}"
                                            {{ old('segmento_id') == $segmento->id ? 'selected' : '' }}>
                                            {{ $segmento->id }} - {{ $segmento->detsegmento }}</option>
                                    @endforeach
                                </select>
                                @error('segmento_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="familias_id">TIPO DE SUBSERIE DOCUMENTAL:</label>
                                <select class="select2 @error('familias_id') is-invalid @enderror" name="familias_id"
                                    id="familias_id" style="width: 100%;">
                                    <option value="" disabled selected>Seleccione un Tipo de Subserie Documental:
                                    </option>
                                    {{-- @foreach ($familias as $familia)
                                <option value="{{$familia->id}}">{{$familia->detfamilia}}</option>
                                @endforeach --}}
                                </select>
                                @error('familias_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>FECHAS EXTREMAS | Fecha Inicial:</label>
                            <div class="form-label-group">
                                <input placeholder="Escriba la fecha inical" type="date" class="form-control"
                                    name="fechaInicial" id="fechaInicial" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="fechaFinal">FECHAS EXTREMAS | Fecha Final:</label>
                            <div class="form-group">
                                <input placeholder="Escriba la fecha final" type="date" class="form-control"
                                    name="fechaFinal" id="fechaFinal" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | CAJA:</label>
                            <div class="form-group mb-3">
                                <input placeholder="Escriba la unidad de las cajas" type="number" class="form-control"
                                    name="caja" id="caja" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | CARPETA:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la unidad de las carpetas" type="number" class="form-control"
                                    name="carpeta" id="carpeta" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | TOMO:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la unidad de tomos" type="number" class="form-control"
                                    name="tomo" id="tomo" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="requipoais_id">OPCION OTRO:</label>
                                <select class="select2 @error('requipoais_id') is-invalid @enderror" name="requipoais_id"
                                    id="requipoais_id" style="width: 100%;">
                                    <option disabled selected>Seleccione si es otro</option>
                                    @foreach ($requipoais as $requipoai)
                                        <option value="{{ $requipoai->id }}"
                                            {{ old('requipoais_id') == $requipoai->id ? 'selected' : '' }}>
                                            {{ $requipoai->detpoai }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('requipoais_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | OTRO:</label>
                            <div class="input-group mb-3">
                                <input hidden placeholder="Escriba la unidad de otros" type="text"
                                    class="form-control" name="otro" id="otro">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>NUMERO DE FOLIOS:</label>
                            <div class="input-group mb-3">

                                <input placeholder="Escriba el numero de folios" type="text" class="form-control"
                                    name="folio" id="folio" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fuente_id">SOPORTE DOCUMENTAL:</label>
                                <select class="select2 @error('fuente_id') is-invalid @enderror" name="fuente_id"
                                    id="fuente_id" style="width: 100%;">
                                    <option disabled selected>Seleccione el soporte de los documentos</option>
                                    @foreach ($fuentes as $fuentes)
                                        <option value="{{ $fuentes->id }}"
                                            {{ old('fuente_id') == $fuentes->id ? 'selected' : '' }}>
                                            {{ $fuentes->detfuente }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fuente_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipoprioridade_id">FRECUENCIA DE CONSULTA:</label>
                                <select class="select2 @error('tipoprioridade_id') is-invalid @enderror"
                                    name="tipoprioridade_id" id="tipoprioridade_id" style="width: 100%;">
                                    <option disabled selected>Seleccione la Frecuencia de consulta</option>
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
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label>NOTAS:</label>
                            <div class="input-group sm-3">
                                <input placeholder="Escriba una nota" type="text" class="form-control" name="nota"
                                    id="nota" required>
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

        });

        var segmento_id = $('#segmento_id');
        var familia_id = $('#familias_id');
        segmento_id.change(function() {
            $.ajax({
                url: "{{ route('obtener_familias') }}",
                method: 'GET',
                data: {
                    segmento_id: segmento_id.val(),
                },
                success: function(data) {
                    familia_id.empty();
                    familia_id.append(
                        '<option disabled selected>Seleccione un Tipo de Subserie Documental:</option>'
                    );
                    $.each(data, function(index, element) {
                        familia_id.append('<option value="' + element.id + '">' + element
                            .detfamilia + '</option>')
                    });

                }
            });
        });

        var otro = $('#otro');
        var requipoais_id = $('#requipoais_id');

        $(function() {
            $("#requipoais_id").change(function() {
                if ($(this).val() == 2) {
                    $("#otro").prop("hidden", true);
                    document.getElementById("otro").value = " ";
                } else {
                    $("#otro").prop("hidden", false);

                }
            });
        });
    </script>

@endsection
