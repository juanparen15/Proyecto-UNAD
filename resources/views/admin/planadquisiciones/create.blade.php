@extends('layouts.admin')
@section('title', 'Crear Mapa')
@section('style')

    <!-- Select2 -->
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}

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
                <div class="card-body" style="height: 720px;">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="segmento_id">CIUDAD:</label>
                                <select class="select2 @error('segmento_id') is-invalid @enderror" name="segmento_id"
                                    id="segmento_id" style="width: 100%;">
                                    <option value="" disabled selected>Seleccione una Ciudad:
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
                            <div class="form-group">
                                <label for="familias_id">Estandar</label>
                                <select id="familias_id" class="form-control select2" required>
                                    <option value="" disabled selected>Seleccione un Estandar:</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estandar_id">Tipo de Emisora</label>
                                <select id="estandar_id" class="form-control select2" required>
                                    <option value="" disabled selected>Seleccione el Tipo de Emisora:</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="emisora_id">Emisora</label>
                                <select id="emisora_id" class="form-control select2" required>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 mb-2">
                            <input type="submit" value="Mostrar" class="btn btn-primary float-left">

                            <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a>
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
                            familias_id.append('<option value="' + element.id + '">' + element.id +
                                "-" + element.detfamilia + '</option>')
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
                            estandar_id.append('<option value="' + element.id + '">' + element.id +
                                "-" + element.detfuente + '</option>');
                        });
                    }
                });
            });
        </script>

        <script>
            var emisora_id = $('#emisora_id');
            estandar_id.change(function() {
                $.ajax({
                    url: "{{ route('obtener_emisora') }}",
                    method: 'GET',
                    data: {
                        estandar_id: estandar_id.val(),
                    },
                    success: function(data) {
                        emisora_id.empty();
                        emisora_id.append(
                            '<option disabled selected>Seleccione la Emisora:</option>');
                        $.each(data, function(index, element) {
                            emisora_id.append('<option value="' + element.id + '">' + element
                                .id +
                                "-" + element.detfuente + '</option>');
                        });
                    }
                });
            });
        </script>
    @endsection
