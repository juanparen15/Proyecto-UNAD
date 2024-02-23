@extends('layouts.admin')
@section('title', 'Recomendaciones')
@section('style')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') !!}
    <!-- DataTables -->
    {!! Html::style('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}
@endsection

@section('content')
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (auth()->user()->hasRole('Admin'))
                            <h1 class="m-0">Panel Administrador</h1>
                        @elseif(auth()->user()->hasRole('User'))
                            <h1 class="m-0">Panel Usuario</h1>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                <div class="form-row">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        RADSODI
                                    </h3>
                                    <div class="card text-start col-md-6 ml-md-auto">
                                        Para el módulo de recomendaciones se consideran como indicadores de desempeño para
                                        cada estándar digital las siguientes variables:
                                        <div class="text-start">
                                            • Promedio aritmético de potencia (dBu) de los 100 puntos de interés medidos en
                                            la ciudad seleccionada.
                                            <div class="text-start">
                                                • Promedio aritmético de interferencia (dB) de los 100 puntos de interés
                                                medidos en la ciudad seleccionada.
                                                <div class="text-start">
                                                    A partir de estas dos variables que nos indican la potencia de la señal
                                                    captada por los receptores y la relación entre la potencia de la señal
                                                    de interés y la potencia de la señal de ruido, se propone calcular un
                                                    único indicador
                                                    de desempeño.
                                                    <div class="text-start">
                                                        Este indicador es la suma ponderada de las dos variables
                                                        normalizadas,
                                                        representadas en escala lineal.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 ml-md-auto">
                                        <div class="form-group" style="width: 100%">
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
                                            <label>Ponderación para Potencia</label>
                                            <input placeholder="Ponderación para Potencia" type="number" step="0.1"
                                                min="0" max="1" id="recoPotencia" name="recoPotencia"
                                                value="{{ old('recoPotencia') }}"
                                                class="form-control @error('recoPotencia') is-invalid @enderror"
                                                style="width: 100%" inputmode="decimal" pattern="^(0(\.[0-9])?|1(\.0)?)$">
                                            @error('recoPotencia')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Ponderación para Interferencia</label>
                                            <input disabled placeholder="Ponderación para Interferencia" type="text"
                                                id="recoInterferencia" name="recoInterferencia"
                                                value="{{ old('recoInterferencia') }}"
                                                class="form-control @error('recoInterferencia') is-invalid @enderror">
                                            @error('recoInterferencia')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-16">
                                    <div class="small-box" data-ciudad="1">
                                        <figure class="highcharts-figure">
                                            <div id="column1" style="margin-bottom: 1em;" class="chart-display"></div>
                                        </figure>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12 col-16"> --}}
                                <div class="card-body table-responsive">
                                    <div class="small-box" data-ciudad="1">
                                        {{-- <figure class="highcharts-figure"> --}}
                                            <table id="example" class="display responsive nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Estándar</th>
                                                        <th>Potencia en dBu (promedio)</th>
                                                        <th>Escala lineal</th>
                                                        <th>Potencia Normalizada</th>
                                                        <th>Score Final</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($promPotencias as $promedioPot)
                                                        @php
                                                            $linearScaleValues = [pow(10, $promedioPot->promedioPot1 / 20) * 0.775, pow(10, $promedioPot->promedioPot2 / 20) * 0.775, pow(10, $promedioPot->promedioPot3 / 20) * 0.775];
                                                            $maxLinearScaleValue = max($linearScaleValues);
                                                        @endphp
                                                        @if ($loop->first)
                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot1 }}</td>
                                                                <td>{{ $linearScaleValues[0] }}</td>
                                                                <td>{{ $linearScaleValues[0] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot2 }}</td>
                                                                <td>{{ $linearScaleValues[1] }}</td>
                                                                <td>{{ $linearScaleValues[1] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot3 }}</td>
                                                                <td>{{ $linearScaleValues[2] }}</td>
                                                                <td>{{ $linearScaleValues[2] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Estándar</th>
                                                        <th>SNR en dB (promedio)</th>
                                                        <th>Escala lineal</th>
                                                        <th>Potencia Normalizada</th>
                                                        {{-- <th>Score Final</th> --}}

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($promPotencias as $promedioPot)
                                                        @php
                                                            $linearScaleValues = [pow(10, $promedioPot->promedioPot4 / 20) * 0.775, pow(10, $promedioPot->promedioPot5 / 20) * 0.775, pow(10, $promedioPot->promedioPot6 / 20) * 0.775];
                                                            $maxLinearScaleValue = max($linearScaleValues);
                                                        @endphp
                                                        @if ($loop->first)
                                                            <tr>
                                                                <td>IBOC AM Híbrido</td>
                                                                <td>{{ $promedioPot->promedioPot4 }}</td>
                                                                <td>{{ $linearScaleValues[0] }}</td>
                                                                <td>{{ $linearScaleValues[0] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>

                                                            <tr>
                                                                <td>IBOC FM Híbrido</td>
                                                                <td>{{ $promedioPot->promedioPot5 }}</td>
                                                                <td>{{ $linearScaleValues[1] }}</td>
                                                                <td>{{ $linearScaleValues[1] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>

                                                            <tr>
                                                                <td>DAB</td>
                                                                <td>{{ $promedioPot->promedioPot6 }}</td>
                                                                <td>{{ $linearScaleValues[2] }}</td>
                                                                <td>{{ $linearScaleValues[2] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        {{-- </figure> --}}
                                    </div>
                                </div>
                                <div class="col-lg-12 col-16">
                                    <div class="small-box" data-ciudad="2">
                                        <figure class="highcharts-figure">
                                            <div id="column2" style="margin-bottom: 1em;" class="chart-display"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-16">
                                    <div class="small-box" data-ciudad="2">
                                        <figure class="highcharts-figure">
                                            <table id="example2" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Estándar</th>
                                                        <th>Potencia en dBu (promedio)</th>
                                                        <th>Escala lineal</th>
                                                        <th>Potencia Normalizada</th>
                                                        <th>Score Final</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($promPotenciasBuca as $promedioPot)
                                                        @php
                                                            $linearScaleValues = [pow(10, $promedioPot->promedioPot1 / 20) * 0.775, pow(10, $promedioPot->promedioPot2 / 20) * 0.775, pow(10, $promedioPot->promedioPot3 / 20) * 0.775];
                                                            $maxLinearScaleValue = max($linearScaleValues);
                                                        @endphp
                                                        @if ($loop->first)
                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot1 }}</td>
                                                                <td>{{ $linearScaleValues[0] }}</td>
                                                                <td>{{ $linearScaleValues[0] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot2 }}</td>
                                                                <td>{{ $linearScaleValues[1] }}</td>
                                                                <td>{{ $linearScaleValues[1] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot3 }}</td>
                                                                <td>{{ $linearScaleValues[2] }}</td>
                                                                <td>{{ $linearScaleValues[2] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Estándar</th>
                                                        <th>SNR en dB (promedio)</th>
                                                        <th>Escala lineal</th>
                                                        <th>Potencia Normalizada</th>
                                                        {{-- <th>Score Final</th> --}}

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($promPotenciasBuca as $promedioPot)
                                                        @php
                                                            $linearScaleValues = [pow(10, $promedioPot->promedioPot4 / 20) * 0.775, pow(10, $promedioPot->promedioPot5 / 20) * 0.775, pow(10, $promedioPot->promedioPot6 / 20) * 0.775];
                                                            $maxLinearScaleValue = max($linearScaleValues);
                                                        @endphp
                                                        @if ($loop->first)
                                                            <tr>
                                                                <td>IBOC AM Híbrido</td>
                                                                <td>{{ $promedioPot->promedioPot4 }}</td>
                                                                <td>{{ $linearScaleValues[0] }}</td>
                                                                <td>{{ $linearScaleValues[0] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>

                                                            <tr>
                                                                <td>IBOC FM Híbrido</td>
                                                                <td>{{ $promedioPot->promedioPot5 }}</td>
                                                                <td>{{ $linearScaleValues[1] }}</td>
                                                                <td>{{ $linearScaleValues[1] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>

                                                            <tr>
                                                                <td>DAB</td>
                                                                <td>{{ $promedioPot->promedioPot6 }}</td>
                                                                <td>{{ $linearScaleValues[2] }}</td>
                                                                <td>{{ $linearScaleValues[2] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-16">
                                    <div class="small-box" data-ciudad="3">
                                        <figure class="highcharts-figure">
                                            <div id="column3" style="margin-bottom: 1em;" class="chart-display"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-16">
                                    <div class="small-box" data-ciudad="3">
                                        <figure class="highcharts-figure">
                                            <table id="example3" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Estándar</th>
                                                        <th>Potencia en dBu (promedio)</th>
                                                        <th>Escala lineal</th>
                                                        <th>Potencia Normalizada</th>
                                                        <th>Score Final</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($promPotenciasCali as $promedioPot)
                                                        @php
                                                            $linearScaleValues = [pow(10, $promedioPot->promedioPot1 / 20) * 0.775, pow(10, $promedioPot->promedioPot2 / 20) * 0.775, pow(10, $promedioPot->promedioPot3 / 20) * 0.775];
                                                            $maxLinearScaleValue = max($linearScaleValues);
                                                        @endphp
                                                        @if ($loop->first)
                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot1 }}</td>
                                                                <td>{{ $linearScaleValues[0] }}</td>
                                                                <td>{{ $linearScaleValues[0] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot2 }}</td>
                                                                <td>{{ $linearScaleValues[1] }}</td>
                                                                <td>{{ $linearScaleValues[1] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot3 }}</td>
                                                                <td>{{ $linearScaleValues[2] }}</td>
                                                                <td>{{ $linearScaleValues[2] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Estándar</th>
                                                        <th>SNR en dB (promedio)</th>
                                                        <th>Escala lineal</th>
                                                        <th>Potencia Normalizada</th>
                                                        {{-- <th>Score Final</th> --}}

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($promPotenciasCali as $promedioPot)
                                                        @php
                                                            $linearScaleValues = [pow(10, $promedioPot->promedioPot4 / 20) * 0.775, pow(10, $promedioPot->promedioPot5 / 20) * 0.775, pow(10, $promedioPot->promedioPot6 / 20) * 0.775];
                                                            $maxLinearScaleValue = max($linearScaleValues);
                                                        @endphp
                                                        @if ($loop->first)
                                                            <tr>
                                                                <td>IBOC AM Híbrido</td>
                                                                <td>{{ $promedioPot->promedioPot4 }}</td>
                                                                <td>{{ $linearScaleValues[0] }}</td>
                                                                <td>{{ $linearScaleValues[0] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>

                                                            <tr>
                                                                <td>IBOC FM Híbrido</td>
                                                                <td>{{ $promedioPot->promedioPot5 }}</td>
                                                                <td>{{ $linearScaleValues[1] }}</td>
                                                                <td>{{ $linearScaleValues[1] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>

                                                            <tr>
                                                                <td>DAB</td>
                                                                <td>{{ $promedioPot->promedioPot6 }}</td>
                                                                <td>{{ $linearScaleValues[2] }}</td>
                                                                <td>{{ $linearScaleValues[2] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-16">
                                    <div class="small-box" data-ciudad="4">
                                        <figure class="highcharts-figure">
                                            <div id="column4" style="margin-bottom: 1em;" class="chart-display">
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-16">
                                    <div class="small-box" data-ciudad="4">
                                        <figure class="highcharts-figure">
                                            <table id="example4" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Estándar</th>
                                                        <th>Potencia en dBu (promedio)</th>
                                                        <th>Escala lineal</th>
                                                        <th>Potencia Normalizada</th>
                                                        <th>Score Final</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($promPotenciasMede as $promedioPot)
                                                        @php
                                                            $linearScaleValues = [pow(10, $promedioPot->promedioPot1 / 20) * 0.775, pow(10, $promedioPot->promedioPot2 / 20) * 0.775, pow(10, $promedioPot->promedioPot3 / 20) * 0.775];
                                                            $maxLinearScaleValue = max($linearScaleValues);
                                                        @endphp
                                                        @if ($loop->first)
                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot1 }}</td>
                                                                <td>{{ $linearScaleValues[0] }}</td>
                                                                <td>{{ $linearScaleValues[0] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot2 }}</td>
                                                                <td>{{ $linearScaleValues[1] }}</td>
                                                                <td>{{ $linearScaleValues[1] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $promedioPot->promedioPot3 }}</td>
                                                                <td>{{ $linearScaleValues[2] }}</td>
                                                                <td>{{ $linearScaleValues[2] / $maxLinearScaleValue }}
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Estándar</th>
                                                        <th>SNR en dB (promedio)</th>
                                                        <th>Escala lineal</th>
                                                        <th>Potencia Normalizada</th>
                                                        {{-- <th>Score Final</th> --}}

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($promPotenciasMede as $promedioPot)
                                                        @php
                                                            $linearScaleValues = [pow(10, $promedioPot->promedioPot4 / 20) * 0.775, pow(10, $promedioPot->promedioPot5 / 20) * 0.775, pow(10, $promedioPot->promedioPot6 / 20) * 0.775];
                                                            $maxLinearScaleValue = max($linearScaleValues);
                                                        @endphp
                                                        @if ($loop->first)
                                                            <tr>
                                                                <td>IBOC AM Híbrido</td>
                                                                <td>{{ $promedioPot->promedioPot4 }}</td>
                                                                <td>{{ $linearScaleValues[0] }}</td>
                                                                <td>{{ $linearScaleValues[0] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>

                                                            <tr>
                                                                <td>IBOC FM Híbrido</td>
                                                                <td>{{ $promedioPot->promedioPot5 }}</td>
                                                                <td>{{ $linearScaleValues[1] }}</td>
                                                                <td>{{ $linearScaleValues[1] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>

                                                            <tr>
                                                                <td>DAB</td>
                                                                <td>{{ $promedioPot->promedioPot6 }}</td>
                                                                <td>{{ $linearScaleValues[2] }}</td>
                                                                <td>{{ $linearScaleValues[2] / $maxLinearScaleValue }}
                                                                </td>
                                                                {{-- <td></td> --}}
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    @endsection
    @section('script')
        <!-- Select2 -->
        {!! Html::script('adminlte/plugins/select2/js/select2.full.min.js') !!}
        <!-- DataTables -->
        {!! Html::script('adminlte/plugins/datatables/jquery.dataTables.min.js') !!}
        {!! Html::script('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}

        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.small-box').hide();
                // Agrega el evento change al select
                $('#ciudad_id').change(function() {
                    var ciudad_id = $(this).val();

                    // Oculta todas las gráficas
                    $('.small-box').hide();

                    if (ciudad_id) {
                        // Muestra solo las gráficas correspondientes a la ciudad seleccionada
                        $('.small-box[data-ciudad="' + ciudad_id + '"]').show();
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#recoPotencia').mask("#.0", {
                    reverse: true
                });
                $('#recoPotencia').on('input', function() {
                    var val = parseFloat($(this).val());
                    if (isNaN(val) || val < 0 || val > 1) {
                        $(this).addClass('is-invalid');
                        document.getElementById('recoInterferencia').value = '';
                    } else {
                        $(this).removeClass('is-invalid');
                        var recoPotencia = $(this).val();
                        var recoInterferencia = (1 - recoPotencia).toFixed(1);
                        document.getElementById('recoInterferencia').value = recoInterferencia;
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Define una función para actualizar la gráfica
                function updateChart() {
                    // Calcula el score final para cada punto de la serie
                    var newData = [];

                    // Itera sobre los puntos de la serie
                    @foreach ($promPotencias as $promedioPot)

                        @if ($loop->first)
                            @php
                                $linearScaleValues1 = [pow(10, $promedioPot->promedioPot1 / 20) * 0.775, pow(10, $promedioPot->promedioPot2 / 20) * 0.775, pow(10, $promedioPot->promedioPot3 / 20) * 0.775];
                                $linearScaleValues2 = [pow(10, $promedioPot->promedioPot4 / 20) * 0.775, pow(10, $promedioPot->promedioPot5 / 20) * 0.775, pow(10, $promedioPot->promedioPot6 / 20) * 0.775];
                                $maxLinearScaleValue1 = max($linearScaleValues1);
                                $maxLinearScaleValue2 = max($linearScaleValues2);
                            @endphp
                            newData.push({
                                name: 'IBOC AM Híbrido',
                                y: {{ $linearScaleValues1[0] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[0] / $maxLinearScaleValue2 }} *
                                    parseFloat($('#recoInterferencia').val())
                            });
                        @endif
                        @if ($loop->first)
                            newData.push({
                                name: 'IBOC FM Híbrido',
                                y: {{ $linearScaleValues1[1] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[1] / $maxLinearScaleValue2 }} * parseFloat($(
                                        '#recoInterferencia').val())
                            });
                        @endif
                        @if ($loop->first)
                            newData.push({
                                name: 'DAB',
                                y: {{ $linearScaleValues1[2] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[2] / $maxLinearScaleValue2 }} * parseFloat($(
                                        '#recoInterferencia').val())
                            });
                        @endif
                    @endforeach

                    // Actualiza los datos de la serie en la gráfica
                    chart.series[0].setData(newData);
                    updateTable(newData, '#example');
                }

                function updateTable(newData, table) {
                    $(table + ' tbody tr').each(function(index) {
                        if (newData[index]) {
                            var category = newData[index].name;
                            var scoreFinal = newData[index].y.toFixed(2);
                            $(this).find('td:eq(4)').text(scoreFinal);
                            $(this).find('td:eq(0)').text(category);
                        }
                    });
                }
                // Calculate Potencia Normalizada
                var table = $('#example').DataTable({
                    responsive: true
                });

                var chartData = [];

                // Iterar sobre los datos y construir chartData
                @foreach ($promPotencias as $promedioPot)
                    @if ($loop->first)
                        chartData.push({
                            name: 'IBOC AM Híbrido',
                            y: parseFloat("{{ $promedioPot->promedioPot1 }}")
                        });
                    @endif
                    @if ($loop->first)
                        chartData.push({
                            name: 'IBOC FM Híbrido',
                            y: parseFloat("{{ $promedioPot->promedioPot2 }}")
                        });
                    @endif
                    @if ($loop->first)
                        chartData.push({
                            name: 'DAB',
                            y: parseFloat("{{ $promedioPot->promedioPot3 }}")
                        });
                    @endif
                @endforeach
                // Update the chart
                var chart = Highcharts.chart('column1', {
                    chart: {
                        type: 'column',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        styledMode: false
                    },
                    lang: {
                        downloadCSV: "Descargar CSV",
                        downloadXLS: "Descargar XLS",
                        viewFullscreen: "Ver en Pantalla Completa",
                        exitFullscreen: "Salir de Pantalla Completa",
                        printChart: "Imprimir Grafica",
                        downloadJPEG: "Descargar JPG",
                        downloadPDF: "Descargar PDF",
                        downloadPNG: "Descargar PNG",
                        downloadSVG: "Descargar SVG",
                        hideData: "Ocultar Datos",
                        viewData: "Mostrar Datos"
                    },
                    xAxis: {
                        categories: ['IBOC AM Híbrido', 'IBOC FM Híbrido', 'DAB'],
                    },
                    yAxis: {
                        title: {
                            // text: 'Potencias (dBu)',
                            enabled: false,
                        },
                        min: 0, // Establecer el valor mínimo en el eje Y
                        // max: 200, // Establecer el valor máximo en el eje Y
                    },
                    colorAxis: [{
                        maxColor: '#00d460',
                        minColor: '#004ffa',
                    }],
                    credits: {
                        enabled: false
                    },
                    tooltip: {
                        headerFormat: '<b>{point.key}</b><br>',
                        // pointFormat: 'Cars sold: {point.y}'
                    },
                    title: {
                        text: 'SCORE FINAL BOGOTÁ',
                        align: 'center'
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        column: {
                            colorByPoint: true,
                            // colors: ['green', 'blue', 'red']
                        },
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}'
                            }
                        }
                    },
                    series: [{
                        // colorByPoint: true,
                        name: 'Promedio',
                        data: chartData,
                    }]
                });

                // Agrega un evento de cambio al campo de recoPotencia
                $('#recoPotencia').change(function() {
                    var recoPotencia = parseFloat($(this).val());

                    // Actualiza la gráfica con el nuevo valor de recoPotencia
                    updateChart();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Define una función para actualizar la gráfica
                function updateChart() {
                    // Calcula el score final para cada punto de la serie
                    var newData = [];

                    // Itera sobre los puntos de la serie
                    @foreach ($promPotenciasBuca as $promedioPot)

                        @if ($loop->first)
                            @php
                                $linearScaleValues1 = [pow(10, $promedioPot->promedioPot1 / 20) * 0.775, pow(10, $promedioPot->promedioPot2 / 20) * 0.775, pow(10, $promedioPot->promedioPot3 / 20) * 0.775];
                                $linearScaleValues2 = [pow(10, $promedioPot->promedioPot4 / 20) * 0.775, pow(10, $promedioPot->promedioPot5 / 20) * 0.775, pow(10, $promedioPot->promedioPot6 / 20) * 0.775];
                                $maxLinearScaleValue1 = max($linearScaleValues1);
                                $maxLinearScaleValue2 = max($linearScaleValues2);
                            @endphp
                            newData.push({
                                name: 'IBOC AM Híbrido',
                                y: {{ $linearScaleValues1[0] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[0] / $maxLinearScaleValue2 }} *
                                    parseFloat($('#recoInterferencia').val())
                            });
                        @endif
                        @if ($loop->first)
                            newData.push({
                                name: 'IBOC FM Híbrido',
                                y: {{ $linearScaleValues1[1] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[1] / $maxLinearScaleValue2 }} * parseFloat($(
                                        '#recoInterferencia').val())
                            });
                        @endif
                        @if ($loop->first)
                            newData.push({
                                name: 'DAB',
                                y: {{ $linearScaleValues1[2] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[2] / $maxLinearScaleValue2 }} * parseFloat($(
                                        '#recoInterferencia').val())
                            });
                        @endif
                    @endforeach

                    // Actualiza los datos de la serie en la gráfica
                    chart.series[0].setData(newData);
                    updateTable(newData, '#example2');
                }

                function updateTable(newData, table) {
                    $(table + ' tbody tr').each(function(index) {
                        if (newData[index]) {
                            var category = newData[index].name;
                            var scoreFinal = newData[index].y.toFixed(2);
                            $(this).find('td:eq(4)').text(scoreFinal);
                            $(this).find('td:eq(0)').text(category);
                        }
                    });
                }

                // Calculate Potencia Normalizada
                var table = $('#example2').DataTable();

                var chartData = [];

                // Iterar sobre los datos y construir chartData
                @foreach ($promPotenciasBuca as $promedioPot)
                    @if ($loop->first)
                        chartData.push({
                            name: 'IBOC AM Híbrido',
                            y: parseFloat("{{ $promedioPot->promedioPot1 }}")
                        });
                    @endif
                    @if ($loop->first)
                        chartData.push({
                            name: 'IBOC FM Híbrido',
                            y: parseFloat("{{ $promedioPot->promedioPot2 }}")
                        });
                    @endif
                    @if ($loop->first)
                        chartData.push({
                            name: 'DAB',
                            y: parseFloat("{{ $promedioPot->promedioPot3 }}")
                        });
                    @endif
                @endforeach
                // Update the chart
                var chart = Highcharts.chart('column2', {
                    chart: {
                        type: 'column',
                        styledMode: false
                    },
                    lang: {
                        downloadCSV: "Descargar CSV",
                        downloadXLS: "Descargar XLS",
                        viewFullscreen: "Ver en Pantalla Completa",
                        exitFullscreen: "Salir de Pantalla Completa",
                        printChart: "Imprimir Grafica",
                        downloadJPEG: "Descargar JPG",
                        downloadPDF: "Descargar PDF",
                        downloadPNG: "Descargar PNG",
                        downloadSVG: "Descargar SVG",
                        hideData: "Ocultar Datos",
                        viewData: "Mostrar Datos"
                    },
                    xAxis: {
                        categories: ['IBOC AM Híbrido', 'IBOC FM Híbrido', 'DAB'],
                    },
                    yAxis: {
                        title: {
                            // text: 'Potencias (dBu)',
                            enabled: false,
                        },
                        min: 0, // Establecer el valor mínimo en el eje Y
                        // max: 200, // Establecer el valor máximo en el eje Y
                    },
                    colorAxis: [{
                        maxColor: '#00d460',
                        minColor: '#004ffa',
                    }],
                    credits: {
                        enabled: false
                    },
                    tooltip: {
                        headerFormat: '<b>{point.key}</b><br>',
                        // pointFormat: 'Cars sold: {point.y}'
                    },
                    title: {
                        text: 'SCORE FINAL BUCARAMANGA',
                        align: 'center'
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}'
                            }
                        }
                    },
                    series: [{
                        colorByPoint: true,
                        name: 'Promedio',
                        data: chartData,
                    }]
                });

                // Agrega un evento de cambio al campo de recoPotencia
                $('#recoPotencia').change(function() {
                    var recoPotencia = parseFloat($(this).val());

                    // Actualiza la gráfica con el nuevo valor de recoPotencia
                    updateChart();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Define una función para actualizar la gráfica
                function updateChart() {
                    // Calcula el score final para cada punto de la serie
                    var newData = [];

                    // Itera sobre los puntos de la serie
                    @foreach ($promPotenciasCali as $promedioPot)

                        @if ($loop->first)
                            @php
                                $linearScaleValues1 = [pow(10, $promedioPot->promedioPot1 / 20) * 0.775, pow(10, $promedioPot->promedioPot2 / 20) * 0.775, pow(10, $promedioPot->promedioPot3 / 20) * 0.775];
                                $linearScaleValues2 = [pow(10, $promedioPot->promedioPot4 / 20) * 0.775, pow(10, $promedioPot->promedioPot5 / 20) * 0.775, pow(10, $promedioPot->promedioPot6 / 20) * 0.775];
                                $maxLinearScaleValue1 = max($linearScaleValues1);
                                $maxLinearScaleValue2 = max($linearScaleValues2);
                            @endphp
                            newData.push({
                                name: 'IBOC AM Híbrido',
                                y: {{ $linearScaleValues1[0] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[0] / $maxLinearScaleValue2 }} *
                                    parseFloat($('#recoInterferencia').val())
                            });
                        @endif
                        @if ($loop->first)
                            newData.push({
                                name: 'IBOC FM Híbrido',
                                y: {{ $linearScaleValues1[1] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[1] / $maxLinearScaleValue2 }} * parseFloat($(
                                        '#recoInterferencia').val())
                            });
                        @endif
                        @if ($loop->first)
                            newData.push({
                                name: 'DAB',
                                y: {{ $linearScaleValues1[2] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[2] / $maxLinearScaleValue2 }} * parseFloat($(
                                        '#recoInterferencia').val())
                            });
                        @endif
                    @endforeach

                    // Actualiza los datos de la serie en la gráfica
                    chart.series[0].setData(newData);
                    updateTable(newData, '#example3');
                }

                function updateTable(newData, table) {
                    $(table + ' tbody tr').each(function(index) {
                        if (newData[index]) {
                            var category = newData[index].name;
                            var scoreFinal = newData[index].y.toFixed(2);
                            $(this).find('td:eq(4)').text(scoreFinal);
                            $(this).find('td:eq(0)').text(category);
                        }
                    });
                }

                // Calculate Potencia Normalizada
                var table = $('#example3').DataTable();

                var chartData = [];

                // Iterar sobre los datos y construir chartData
                @foreach ($promPotenciasCali as $promedioPot)
                    @if ($loop->first)
                        chartData.push({
                            name: 'IBOC AM Híbrido',
                            y: parseFloat("{{ $promedioPot->promedioPot1 }}")
                        });
                    @endif
                    @if ($loop->first)
                        chartData.push({
                            name: 'IBOC FM Híbrido',
                            y: parseFloat("{{ $promedioPot->promedioPot2 }}")
                        });
                    @endif
                    @if ($loop->first)
                        chartData.push({
                            name: 'DAB',
                            y: parseFloat("{{ $promedioPot->promedioPot3 }}")
                        });
                    @endif
                @endforeach
                // Update the chart
                var chart = Highcharts.chart('column3', {
                    chart: {
                        type: 'column',
                        styledMode: false
                    },
                    lang: {
                        downloadCSV: "Descargar CSV",
                        downloadXLS: "Descargar XLS",
                        viewFullscreen: "Ver en Pantalla Completa",
                        exitFullscreen: "Salir de Pantalla Completa",
                        printChart: "Imprimir Grafica",
                        downloadJPEG: "Descargar JPG",
                        downloadPDF: "Descargar PDF",
                        downloadPNG: "Descargar PNG",
                        downloadSVG: "Descargar SVG",
                        hideData: "Ocultar Datos",
                        viewData: "Mostrar Datos"
                    },
                    xAxis: {
                        categories: ['IBOC AM Híbrido', 'IBOC FM Híbrido', 'DAB'],
                    },
                    yAxis: {
                        title: {
                            // text: 'Potencias (dBu)',
                            enabled: false,
                        },
                        min: 0, // Establecer el valor mínimo en el eje Y
                        // max: 200, // Establecer el valor máximo en el eje Y
                    },
                    colorAxis: [{
                        maxColor: '#00d460',
                        minColor: '#004ffa',
                    }],
                    credits: {
                        enabled: false
                    },
                    tooltip: {
                        headerFormat: '<b>{point.key}</b><br>',
                        // pointFormat: 'Cars sold: {point.y}'
                    },
                    title: {
                        text: 'SCORE FINAL CALI',
                        align: 'center'
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}'
                            }
                        }
                    },
                    series: [{
                        colorByPoint: true,
                        name: 'Promedio',
                        data: chartData,
                    }]
                });

                // Agrega un evento de cambio al campo de recoPotencia
                $('#recoPotencia').change(function() {
                    var recoPotencia = parseFloat($(this).val());

                    // Actualiza la gráfica con el nuevo valor de recoPotencia
                    updateChart();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Define una función para actualizar la gráfica
                function updateChart() {
                    // Calcula el score final para cada punto de la serie
                    var newData = [];

                    // Itera sobre los puntos de la serie
                    @foreach ($promPotenciasMede as $promedioPot)

                        @if ($loop->first)
                            @php
                                $linearScaleValues1 = [pow(10, $promedioPot->promedioPot1 / 20) * 0.775, pow(10, $promedioPot->promedioPot2 / 20) * 0.775, pow(10, $promedioPot->promedioPot3 / 20) * 0.775];
                                $linearScaleValues2 = [pow(10, $promedioPot->promedioPot4 / 20) * 0.775, pow(10, $promedioPot->promedioPot5 / 20) * 0.775, pow(10, $promedioPot->promedioPot6 / 20) * 0.775];
                                $maxLinearScaleValue1 = max($linearScaleValues1);
                                $maxLinearScaleValue2 = max($linearScaleValues2);
                            @endphp
                            newData.push({
                                name: 'IBOC AM Híbrido',
                                y: {{ $linearScaleValues1[0] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[0] / $maxLinearScaleValue2 }} *
                                    parseFloat($('#recoInterferencia').val())
                            });
                        @endif
                        @if ($loop->first)
                            newData.push({
                                name: 'IBOC FM Híbrido',
                                y: {{ $linearScaleValues1[1] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[1] / $maxLinearScaleValue2 }} * parseFloat($(
                                        '#recoInterferencia').val())
                            });
                        @endif
                        @if ($loop->first)
                            newData.push({
                                name: 'DAB',
                                y: {{ $linearScaleValues1[2] / $maxLinearScaleValue1 }} *
                                    parseFloat($('#recoPotencia').val()) +
                                    {{ $linearScaleValues2[2] / $maxLinearScaleValue2 }} * parseFloat($(
                                        '#recoInterferencia').val())
                            });
                        @endif
                    @endforeach

                    // Actualiza los datos de la serie en la gráfica
                    chart.series[0].setData(newData);
                    updateTable(newData, '#example4');
                }

                function updateTable(newData, table) {
                    $(table + ' tbody tr').each(function(index) {
                        if (newData[index]) {
                            var category = newData[index].name;
                            var scoreFinal = newData[index].y.toFixed(2);
                            $(this).find('td:eq(4)').text(scoreFinal);
                            $(this).find('td:eq(0)').text(category);
                        }
                    });
                }
                // Calculate Potencia Normalizada
                var table = $('#example4').DataTable();

                var chartData = [];

                // Iterar sobre los datos y construir chartData
                @foreach ($promPotenciasMede as $promedioPot)
                    @if ($loop->first)
                        chartData.push({
                            name: 'IBOC AM Híbrido',
                            y: parseFloat("{{ $promedioPot->promedioPot1 }}")
                        });
                    @endif
                    @if ($loop->first)
                        chartData.push({
                            name: 'IBOC FM Híbrido',
                            y: parseFloat("{{ $promedioPot->promedioPot2 }}")
                        });
                    @endif
                    @if ($loop->first)
                        chartData.push({
                            name: 'DAB',
                            y: parseFloat("{{ $promedioPot->promedioPot3 }}")
                        });
                    @endif
                @endforeach
                // Update the chart
                var chart = Highcharts.chart('column4', {
                    chart: {
                        type: 'column',
                        styledMode: false
                    },
                    lang: {
                        downloadCSV: "Descargar CSV",
                        downloadXLS: "Descargar XLS",
                        viewFullscreen: "Ver en Pantalla Completa",
                        exitFullscreen: "Salir de Pantalla Completa",
                        printChart: "Imprimir Grafica",
                        downloadJPEG: "Descargar JPG",
                        downloadPDF: "Descargar PDF",
                        downloadPNG: "Descargar PNG",
                        downloadSVG: "Descargar SVG",
                        hideData: "Ocultar Datos",
                        viewData: "Mostrar Datos"
                    },
                    xAxis: {
                        categories: ['IBOC AM Híbrido', 'IBOC FM Híbrido', 'DAB'],
                    },
                    yAxis: {
                        title: {
                            // text: 'Potencias (dBu)',
                            enabled: false,
                        },
                        min: 0, // Establecer el valor mínimo en el eje Y
                        // max: 200, // Establecer el valor máximo en el eje Y
                    },
                    colorAxis: [{
                        maxColor: '#00d460',
                        minColor: '#004ffa',
                    }],
                    credits: {
                        enabled: false
                    },
                    tooltip: {
                        headerFormat: '<b>{point.key}</b><br>',
                        // pointFormat: 'Cars sold: {point.y}'
                    },
                    title: {
                        text: 'SCORE FINAL MEDELLÍN',
                        align: 'center'
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}'
                            }
                        }
                    },
                    series: [{
                        colorByPoint: true,
                        name: 'Promedio',
                        data: chartData,
                    }]
                });

                // Agrega un evento de cambio al campo de recoPotencia
                $('#recoPotencia').change(function() {
                    var recoPotencia = parseFloat($(this).val());

                    // Actualiza la gráfica con el nuevo valor de recoPotencia
                    updateChart();
                });
            });
        </script>
    @endsection
