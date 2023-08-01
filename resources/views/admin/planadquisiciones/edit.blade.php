@extends('layouts.admin')
@section('title', 'Editar Inventario Documental')
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
                        <h1>Editar Inventario Documental</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('planadquisiciones.index') }}">Inventario</a></li>
                            <li class="breadcrumb-item active">Editar Inventario Documental</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::model($inventario, ['route' => ['planadquisiciones.update', $inventario], 'method' => 'PUT']) !!}
            <div class="card card-primary">
                {{-- <div class="card-header">
              <h3 class="card-title">General</h3>
            </div> --}}
                <div class="card-body">
                    <div class="form-row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="area_id">OFICINA PRODUCTORA:</label>
                                <select class="select2 @error('area_id') is-invalid @enderror" name="area_id" id="area_id"
                                    style="width: 100%;">
                                    <option disabled>Seleccione una Unidad Administrativa</option>
                                    <option value="{{ $userArea->id }}" selected>{{ $userArea->nomarea }}</option>
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

                                    @foreach ($modalidades as $modalidad)
                                        <option value="{{ $modalidad->id }}"
                                            {{ old('modalidad_id', $inventario->modalidad_id) == $modalidad->id ? 'selected' : '' }}>
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
                                value="{{ old('descripcioncont', $planadquisicione->descripcioncont) }}"
                                class="form-control" required>
                            </div>
                        </div> --}} -->

                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="requiproyecto_id">Codigo De Dependencia:</label>
                                <select class="select2 @error('requiproyecto_id') is-invalid @enderror"
                                    name="requiproyecto_id" id="requiproyecto_id" style="width: 100%;">
                                    @foreach ($requiproyectos as $requiproyecto)
                                        <option value="{{ $requiproyecto->id }}"
                                            {{ old('requiproyecto_id', $inventario->requiproyecto_id) == $requiproyecto->id ? 'selected' : '' }}>
                                            {{ $requiproyecto->detproyeto }}</option>
                                    @endforeach
                                </select>
                                @error('requiproyecto_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="requiproyecto_id">CODIGO DE DEPENDENCIA:</label>
                                <select class="select2 @error('requiproyecto_id') is-invalid @enderror"
                                    name="requiproyecto_id" id="requiproyecto_id" style="width: 100%;">
                                    <option value="" selected>Seleccione Codigo de Dependencia</option>
                                    @foreach ($requiproyectos as $requiproyectoId => $requiproyecto)
                                        <option value="{{ $requiproyectoId }}"
                                            {{ old('requiproyecto_id', $requiproyecto) }} selected>{{ $requiproyecto }}
                                        </option>
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
                                <label for="segmento_id">Tipo de Series Documentales:</label>
                                <select class="select2 @error('segmento_id') is-invalid @enderror" name="segmento_id"
                                    id="segmento_id" style="width: 100%;">
                                    @foreach ($segmentos as $segmento)
                                        <option value="{{ $segmento->id }}"
                                            {{ old('segmento_id', $inventario->segmento_id) == $segmento->id ? 'selected' : '' }}>
                                            {{ $segmento->id }} - {{ $segmento->detsegmento }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="familias_id">Tipo de Subserie Documental:</label>
                            <select class="select2 @error('familias_id') is-invalid @enderror" name="familias_id"
                                id="familias_id" style="width: 100%;">
                                <option value="" disabled selected>Seleccione un Tipo de Subserie Documental:
                                </option>
                            </select>
                        </div>
                    </div> --}} -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="familias_id">Tipo de Subserie Documental:</label>
                                <select class="select2 @error('familias_id') is-invalid @enderror" name="familias_id"
                                    id="familias_id" style="width: 100%;">
                                    {{-- @foreach ($familias as $familia)
                                <option value="{{$familia->id}}"
                                    {{ old('familias_id', $planadquisicione->familias_id) == $familia->id ? 'selected' : ''}}>
                                    {{$familia->detfamilia}}</option>
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
                            <div class="form-group">
                                <input placeholder="Escriba la fecha inical" type="date" class="form-control"
                                    name="fechaInicial" id="fechaInicial"
                                    value="{{ old('fechaInicial', $inventario->fechaInicial) }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="fechaFinal">FECHAS EXTREMAS | Fecha Final:</label>
                            <div class="form-group">
                                <input placeholder="Escriba la fecha final" type="date" name="fechaFinal" id="fechaFinal"
                                    class="form-control" value="{{ old('fechaFinal', $inventario->fechaFinal) }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | CAJA:</label>
                            <div class="form-group mb-3">
                                <input placeholder="Escriba la unidad de las cajas" type="number" class="form-control"
                                    name="caja" id="caja" value="{{ old('caja', $inventario->caja) }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | CARPETA:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la unidad de las carpetas" type="number" class="form-control"
                                    name="carpeta" id="carpeta" value="{{ old('carpeta', $inventario->carpeta) }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | TOMO:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la unidad de tomos" type="number" class="form-control"
                                    name="tomo" id="tomo" value="{{ old('tomo', $inventario->tomo) }}" required>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="requipoais_id">OPCION OTRO:</label>
                                <select class="select2 @error('requipoais_id') is-invalid @enderror" name="requipoais_id"
                                    id="requipoais_id" style="width: 100%;">

                                    @foreach ($requipoais as $requipoai)
                                        <option value="{{ $requipoai->id }}"
                                            {{ old('requipoais_id', $inventario->requipoais_id) == $requipoai->id ? 'selected' : '' }}>
                                            {{ $requipoai->detpoai }}</option>
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
                                    class="form-control" name="otro" id="otro"
                                    value="{{ old('otro', $inventario->otro) }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>NUMERO DE FOLIOS:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba el numero de folios" type="text" class="form-control"
                                    name="folio" id="folio" value="{{ old('folio', $inventario->folio) }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fuente_id">SOPORTE DOCUMENTAL:</label>
                                <select class="select2 @error('fuente_id') is-invalid @enderror" name="fuente_id"
                                    id="fuente_id" style="width: 100%;">

                                    @foreach ($fuentes as $fuente)
                                        <option value="{{ $fuente->id }}"
                                            {{ old('fuente_id', $inventario->fuente_id) == $fuente->id ? 'selected' : '' }}>
                                            {{ $fuente->detfuente }}
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

                                    @foreach ($tipoprioridades as $tipoprioridad)
                                        <option value="{{ $tipoprioridad->id }}"
                                            {{ old('tipoprioridade_id', $inventario->tipoprioridade_id) == $tipoprioridad->id ? 'selected' : '' }}>
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
                                    id="nota" value="{{ old('nota', $inventario->nota) }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- {{-- <div class="form-group">
                    <table class="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th>CODIGO UNSPSC: </th>
                                <th>Producto:</th>
                                <th>Acciones:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($planadquisicione->productos as $producto)
                            <tr>
                                <td scope="row">{{$producto->id}}</td>
                                <td>{{$producto->detproducto}}</td>
                                <td>


                                    <a href="{{route('retirar_producto', [$planadquisicione,$producto])}}"
                                        class="btn btn-danger btn-sm">Eliminar</a>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div> --}} -->
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
    <!-- <script>
        $(document).ready(function() {
            $('#valorestimadocont').mask("#.##0", {
                reverse: true
            });
            $('#valorestimadovig').mask("#.##0", {
                reverse: true
            });
        });
    </script> -->

    <script>
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
    </script>
    <script>
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
