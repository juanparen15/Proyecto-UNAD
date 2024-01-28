@extends('layouts.admin')
@section('title', 'Panel administrador')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cyborg/bootstrap.min.css"
        integrity="sha384-nEnU7Ae+3lD52AK+RGNzgieBWMnEfgTbRHIwEvp1XXPdqdO6uLTd/NwXbzboqjc2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    {!! Html::style('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') !!}
    <!-- DataTables -->
    {!! Html::style('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}
    {!! Html::style('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}


@endsection
@section('content')
    <div class="content-wrapper bg-black ">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Panel Administrador</h1>
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
                {{-- @if (auth()->user()->hasRole('Supervisor'))
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $adquisiciones1 }}</h3>
                                    <p>Inventario</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>{{ $users }}</h3>
                                    <p>Usuarios</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3>{{ $dependencias }}</h3>
                                    <p>Dependencias</p>
                                </div>
                                <div class="icon">
                                    <i class="fab fa-xbox"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-pink">
                                <div class="inner">
                                    <h3>{{ $areas }}</h3>
                                    <p>Areas</p>
                                </div>
                                <div class="icon">
                                    <i class="fab fa-playstation"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif --}}

                {{-- @if (auth()->user()->hasRole('Admin'))
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $adquisiciones1 }}</h3>
                                    <p>Inventario</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <a href="{{ route('planadquisiciones.index') }}" class="small-box-footer">Ver Todo
                                    <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>{{ $users }}</h3>
                                    <p>Usuarios</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <a href="{{ route('users.index') }}" class="small-box-footer">Ver todo <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3>{{ $dependencias }}</h3>
                                    <p>Dependencias</p>
                                </div>
                                <div class="icon">
                                    <i class="fab fa-xbox"></i>
                                </div>
                                <a href="{{ route('admin.dependencias.index') }}" class="small-box-footer">Ver Todo
                                    <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-pink">
                                <div class="inner">
                                    <h3>{{ $areas }}</h3>
                                    <p>Areas</p>
                                </div>
                                <div class="icon">
                                    <i class="fab fa-playstation"></i>
                                </div>
                                <a href="{{ route('admin.areas.index') }}" class="small-box-footer">Ver Todo <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif --}}

                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    CRC-UNAD
                                </h3>
                                {{-- @can('planadquisiciones.export')
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="btn btn-success" href="{{ route('planadquisiciones.export') }}">
                                                    <i class="far fa-file-excel"></i> Exportar Todo</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endcan --}}

                                <div class="card-tools">
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

                            </div>


                            <div class="row">
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="1">
                                        <figure class="highcharts-figure">
                                            <div id="column1"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="1">
                                        <figure class="highcharts-figure">
                                            <div id="column2"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="1">
                                        <div id="containerLine"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="1">
                                        <div id="containerLine2"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="1">
                                        <div id="containerBox"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box"data-ciudad="1">
                                        <div id="containerBox2"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="2">
                                        <figure class="highcharts-figure">
                                            <div id="columnBuca"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="2">
                                        <figure class="highcharts-figure">
                                            <div id="columnBuca2"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="2">
                                        <div id="containerLineBuca"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="2">
                                        <div id="containerLineBuca2"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="2">
                                        <div id="containerBoxBuca"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box"data-ciudad="2">
                                        <div id="containerBoxBuca2"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="3">
                                        <figure class="highcharts-figure">
                                            <div id="columnCali"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="3">
                                        <figure class="highcharts-figure">
                                            <div id="columnCali2"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="3">
                                        <div id="containerLineCali"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="3">
                                        <div id="containerLineCali2"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="3">
                                        <div id="containerBoxCali"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box"data-ciudad="3">
                                        <div id="containerBoxCali2"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="4">
                                        <figure class="highcharts-figure">
                                            <div id="columnMede"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="4">
                                        <figure class="highcharts-figure">
                                            <div id="columnMede2"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="4">
                                        <div id="containerLineMede"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="4">
                                        <div id="containerLineMede2"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box" data-ciudad="4">
                                        <div id="containerBoxMede"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box"data-ciudad="4">
                                        <div id="containerBoxMede2"></div>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {
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

        @php

            $encabezado3 = $encabezados[2] ?? 'Titulo Desconocido';
            $encabezado6 = $encabezados[5] ?? 'Titulo Desconocido';
            $encabezado9 = $encabezados[8] ?? 'Titulo Desconocido';
            $encabezado12 = $encabezados[11] ?? 'Titulo Desconocido';
            $encabezado15 = $encabezados[14] ?? 'Titulo Desconocido';
            $encabezado18 = $encabezados[17] ?? 'Titulo Desconocido';

            //Bucaramanga

            $encabezadoBuca3 = $encabezadosBuca[2] ?? 'Titulo Desconocido';
            $encabezadoBuca6 = $encabezadosBuca[5] ?? 'Titulo Desconocido';
            $encabezadoBuca9 = $encabezadosBuca[8] ?? 'Titulo Desconocido';
            $encabezadoBuca12 = $encabezadosBuca[11] ?? 'Titulo Desconocido';
            $encabezadoBuca15 = $encabezadosBuca[14] ?? 'Titulo Desconocido';
            $encabezadoBuca18 = $encabezadosBuca[17] ?? 'Titulo Desconocido';

            //Medellin

            $encabezadoMede3 = $encabezadosMede[2] ?? 'Titulo Desconocido';
            $encabezadoMede6 = $encabezadosMede[5] ?? 'Titulo Desconocido';
            $encabezadoMede9 = $encabezadosMede[8] ?? 'Titulo Desconocido';
            $encabezadoMede12 = $encabezadosMede[11] ?? 'Titulo Desconocido';
            $encabezadoMede15 = $encabezadosMede[14] ?? 'Titulo Desconocido';
            $encabezadoMede18 = $encabezadosMede[17] ?? 'Titulo Desconocido';

            //Cali

            $encabezadoCali3 = $encabezadosCali[2] ?? 'Titulo Desconocido';
            $encabezadoCali6 = $encabezadosCali[5] ?? 'Titulo Desconocido';
            $encabezadoCali9 = $encabezadosCali[8] ?? 'Titulo Desconocido';
            $encabezadoCali12 = $encabezadosCali[11] ?? 'Titulo Desconocido';
            $encabezadoCali15 = $encabezadosCali[14] ?? 'Titulo Desconocido';
            $encabezadoCali18 = $encabezadosCali[17] ?? 'Titulo Desconocido';

        @endphp


        <script>
            // Set up the chart
            const chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'column1',
                    type: 'column',
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                xAxis: {
                    categories: ['{!! $encabezado3 !!}', '{!! $encabezado6 !!}', '{!! $encabezado9 !!}'],
                },
                yAxis: {
                    title: {
                        text: 'Potencias',
                    },
                    min: 0, // Establecer el valor mínimo en el eje Y
                    // max: 200, // Establecer el valor máximo en el eje Y
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    // pointFormat: 'Cars sold: {point.y}'
                },
                title: {
                    text: 'PROMEDIO MULTICOBERTURA BOGOTÁ',
                    align: 'center'
                },
                subtitle: {
                    // text: 'Source: ' +
                    //     '<a href="https://ofv.no/registreringsstatistikk"' +
                    //     'target="_blank">OFV</a>',
                    align: 'left'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                series: [{
                    colorByPoint: true,
                    name: 'Promedio',
                    data: [
                        [

                            @foreach ($promPotencias as $promedioPot1)
                                {
                                    name: '{{ $promedioPot1->potenciaAM }}',
                                },
                                {{ $promedioPot1->promedioPot1 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotencias as $promedioPot2)
                                {
                                    name: '{!! $promedioPot2->potenciaFM !!}',
                                },
                                {{ $promedioPot2->promedioPot2 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotencias as $promedioPot3)
                                {
                                    name: '{{ $promedioPot3->potenciaDABHibrido }}',
                                },
                                {{ $promedioPot3->promedioPot3 }},
                            @endforeach
                        ],
                    ],
                }]
            });

            const chart2 = new Highcharts.Chart({
                chart: {
                    renderTo: 'column2',
                    type: 'column',
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                xAxis: {
                    categories: ['{!! $encabezado12 !!}', '{!! $encabezado15 !!}',
                        '{!! $encabezado18 !!}'
                    ],
                },
                yAxis: {
                    title: {
                        text: 'Potencias',
                    },
                    min: 0, // Establecer el valor mínimo en el eje Y
                    // max: 200, // Establecer el valor máximo en el eje Y
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    // pointFormat: 'Cars sold: {point.y}'
                },
                title: {
                    text: 'PROMEDIO INTERFERENCIA BOGOTÁ',
                    align: 'center'
                },
                subtitle: {
                    // text: 'Source: ' +
                    //     '<a href="https://ofv.no/registreringsstatistikk"' +
                    //     'target="_blank">OFV</a>',
                    align: 'left'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                series: [{
                    name: 'Promedio',
                    colorByPoint: true,
                    data: [
                        [

                            @foreach ($promPotencias as $promedioPot4)
                                {
                                    name: '{{ $promedioPot4->SNRAMHibrido }}',
                                },
                                {{ $promedioPot4->promedioPot4 }},
                            @endforeach
                        ],

                        [

                            @foreach ($promPotencias as $promedioPot5)
                                {
                                    name: '{{ $promedioPot5->SNRFMHibrido }}',
                                },
                                {{ $promedioPot5->promedioPot5 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotencias as $promedioPot6)
                                {
                                    name: '{{ $promedioPot6->SNRDAB }}',
                                },
                                {{ $promedioPot6->promedioPot6 }},
                            @endforeach
                        ],
                    ],
                }]
            });
            Highcharts.chart('containerLine', {
                credits: {
                    enabled: false
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'MULTICOBERTURA BOGOTÁ',
                    // 'BOGOTA',
                    // align: 'left',
                },

                subtitle: {

                    align: 'left'
                },

                yAxis: {
                    title: {
                        text: 'Potencias',
                    },
                    min: 0, // Establecer el valor mínimo en el eje Y
                    max: 200, // Establecer el valor máximo en el eje Y
                },

                xAxis: {
                    accessibility: {

                        // rangeDescription: 'Range: 2010 to 2020'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 1
                    }
                },
                series: [{
                        name: '{!! $encabezado3 !!}',
                        data: [
                            @foreach ($potencias as $pot1)
                                {
                                    name: '{{ $pot1->potenciaAM }}',
                                    y: {{ $pot1->pot1 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezado6 !!}',
                        data: [
                            @foreach ($potencias as $pot2)
                                {
                                    name: '{{ $pot2->potenciaFM }}',
                                    y: {{ $pot2->pot2 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezado9 !!}',
                        data: [
                            @foreach ($potencias as $pot3)
                                {
                                    name: '{{ $pot3->potenciaDABHibrido }}',
                                    y: {{ $pot3->pot3 }}
                                },
                            @endforeach
                        ]
                    }
                ],
                responsive: {
                    rules: [{
                        condition: {
                            // maxWidth: 200,
                            // maxHeight: 500,
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
            Highcharts.chart('containerLine2', {
                // chart: {
                //     type: 'spline'
                // },
                credits: {
                    enabled: false
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'INTERFERENCIA BOGOTÁ',
                    // 'BOGOTA',
                    // align: 'left',
                },

                subtitle: {

                    align: 'left'
                },

                yAxis: {
                    title: {
                        // enabled: false,
                        text: 'Potencias',
                    },
                    min: 0, // Establecer el valor mínimo en el eje Y
                    max: 200, // Establecer el valor máximo en el eje Y

                },
                xAxis: {
                    accessibility: {

                        // rangeDescription: 'Range: 2010 to 2020'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 1
                    }
                },
                series: [{
                        name: '{!! $encabezado12 !!}',
                        data: [
                            @foreach ($potencias as $pot4)
                                {
                                    name: '{{ $pot4->SNRAMHibrido }}',
                                    y: {{ $pot4->pot4 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezado15 !!}',
                        data: [
                            @foreach ($potencias as $pot5)
                                {
                                    name: '{{ $pot5->SNRFMHibrido }}',
                                    y: {{ $pot5->pot5 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezado18 !!}',
                        data: [
                            @foreach ($potencias as $pot6)
                                {
                                    name: '{{ $pot6->SNRDAB }}',
                                    y: {{ $pot6->pot6 }}
                                },
                            @endforeach
                        ]
                    }
                ],
                responsive: {
                    rules: [{
                        condition: {
                            // maxWidth: 500,
                            maxHeight: 500,
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
            Highcharts.chart('containerBox', {


                chart: {
                    type: 'boxplot'
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'VARIABILIDAD DE MULTICOBERTURA BOGOTÁ',
                    // getColumnNameByIndex(0),
                    // 'BOGOTÁ'
                },

                legend: {
                    enabled: false
                },
                // accessibility: {
                //     landmarkVerbosity: 'one'
                // },

                xAxis: {
                    // crosshair: {
                    //     enabled: true
                    // },
                    categories: ['{!! $encabezado3 !!}', '{!! $encabezado6 !!}',
                        '{!! $encabezado9 !!}'
                    ],
                    title: {
                        text: 'Potencias'
                    }
                },

                yAxis: {
                    tooltip: {
                        followPointer: true
                    },
                    title: {
                        text: 'Observaciones'
                    },
                    in: 0, // Establecer el valor mínimo en el eje Y
                    max: 200,
                    plotLines: [{
                        color: 'red',
                        label: {
                            align: 'center',
                            style: {
                                color: 'yellow'
                            }
                        }
                    }]
                },
                series: [{
                    type: 'boxplot',
                    medianWidth: 3,
                    stickyTracking: true,
                    cursor: 'pointer',
                    colorByPoint: true,
                    name: 'Observaciones',
                    data: [
                        [
                            @foreach ($potencias as $pot1)
                                {
                                    name: '{{ $pot1->potenciaAM }}',
                                },
                                {{ $pot1->pot1 }},
                            @endforeach
                        ],
                        [
                            @foreach ($potencias as $pot2)
                                {
                                    name: '{{ $pot2->potenciaFM }}',
                                },
                                {{ $pot2->pot2 }},
                            @endforeach
                        ],
                        [
                            @foreach ($potencias as $pot3)
                                {
                                    name: '{{ $pot3->potenciaDABHibrido }}',
                                },
                                {{ $pot3->pot3 }},
                            @endforeach
                        ],
                    ],

                    tooltip: {
                        headerFormat: '<em>{point.key}</em><br/>'
                    }
                }]
            });
            Highcharts.chart('containerBox2', {
                chart: {
                    type: 'boxplot'
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'VARIABILIDAD DE INTERFERENCIA BOGOTÁ',
                    // getColumnNameByIndex(0),
                    // 'BOGOTÁ'
                },

                legend: {
                    enabled: false
                },
                // accessibility: {
                //     landmarkVerbosity: 'one'
                // },

                xAxis: {
                    // crosshair: {
                    //     enabled: true
                    // },
                    categories: ['{!! $encabezado12 !!}', '{!! $encabezado15 !!}',
                        '{!! $encabezado18 !!}'
                    ],
                    title: {
                        text: 'Potencias'
                    }
                },

                yAxis: {
                    tooltip: {
                        followPointer: true
                    },
                    title: {
                        text: 'Observaciones'
                    },
                    in: 0, // Establecer el valor mínimo en el eje Y
                    // max: 200,
                    plotLines: [{
                        value: 932,
                        color: 'red',
                        width: 1,
                        label: {
                            // text: 'Theoretical mean: 932',
                            align: 'center',
                            style: {
                                color: 'yellow'
                            }
                        }
                    }]
                },

                series: [{
                    type: 'boxplot',
                    medianWidth: 3,
                    stickyTracking: true,
                    cursor: 'pointer',
                    colorByPoint: true,
                    name: 'Observaciones',
                    data: [
                        [
                            @foreach ($potencias as $pot4)
                                {
                                    name: '{{ $pot4->SNRAMHibrido }}',
                                },
                                {{ $pot4->pot4 }},
                            @endforeach
                        ],
                        [
                            @foreach ($potencias as $pot5)
                                {
                                    name: '{{ $pot5->SNRFMHibrido }}',
                                },
                                {{ $pot5->pot5 }},
                            @endforeach
                        ],
                        [
                            @foreach ($potencias as $pot6)
                                {
                                    name: '{{ $pot6->SNRDAB }}',
                                },
                                {{ $pot6->pot6 }},
                            @endforeach
                        ],
                    ],

                    tooltip: {
                        headerFormat: '<em>Potencia {point.key}</em><br/>'
                    }
                }, ]

            });
        </script>
        <script>
            // Set up the chart
            const chart3 = new Highcharts.Chart({
                chart: {
                    renderTo: 'columnBuca',
                    type: 'column',
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                xAxis: {
                    categories: ['{!! $encabezadoBuca3 !!}', '{!! $encabezadoBuca6 !!}', '{!! $encabezadoBuca9 !!}'],
                },
                yAxis: {
                    title: {
                        text: 'Potencias',
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    // pointFormat: 'Cars sold: {point.y}'
                },
                title: {
                    text: 'PROMEDIO MULTICOBERTURA BUCARAMANGA',
                    align: 'center'
                },
                subtitle: {
                    // text: 'Source: ' +
                    //     '<a href="https://ofv.no/registreringsstatistikk"' +
                    //     'target="_blank">OFV</a>',
                    align: 'left'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                series: [{
                    colorByPoint: true,
                    name: 'Promedio',
                    data: [
                        [

                            @foreach ($promPotenciasBuca as $promedioBucaPot1)
                                {
                                    name: '{{ $promedioBucaPot1->potenciaAM }}',
                                },
                                {{ $promedioBucaPot1->promedioBucaPot1 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotenciasBuca as $promedioBucaPot2)
                                {
                                    name: '{!! $promedioBucaPot2->potenciaFM !!}',
                                },
                                {{ $promedioBucaPot2->promedioBucaPot2 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotenciasBuca as $promedioBucaPot3)
                                {
                                    name: '{{ $promedioBucaPot3->potenciaDABHibrido }}',
                                },
                                {{ $promedioBucaPot3->promedioBucaPot3 }},
                            @endforeach
                        ],
                    ],
                }]
            });
            const chart4 = new Highcharts.Chart({
                chart: {
                    renderTo: 'columnBuca2',
                    type: 'column',
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                xAxis: {
                    categories: ['{!! $encabezadoBuca12 !!}', '{!! $encabezadoBuca15 !!}', '{!! $encabezadoBuca18 !!}'],
                },
                yAxis: {
                    title: {
                        text: 'Potencias',
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    // pointFormat: 'Cars sold: {point.y}'
                },
                title: {
                    text: 'PROMEDIO INTERFERENCIA BUCARAMANGA',
                    align: 'center'
                },
                subtitle: {
                    // text: 'Source: ' +
                    //     '<a href="https://ofv.no/registreringsstatistikk"' +
                    //     'target="_blank">OFV</a>',
                    align: 'left'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                series: [{
                    name: 'Promedio',
                    colorByPoint: true,
                    data: [
                        [

                            @foreach ($promPotenciasBuca as $promedioBucaPot4)
                                {
                                    name: '{{ $promedioBucaPot4->SNRAMHibrido }}',
                                },
                                {{ $promedioBucaPot4->promedioBucaPot4 }},
                            @endforeach
                        ],

                        [

                            @foreach ($promPotenciasBuca as $promedioBucaPot5)
                                {
                                    name: '{{ $promedioBucaPot5->SNRFMHibrido }}',
                                },
                                {{ $promedioBucaPot5->promedioBucaPot5 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotenciasBuca as $promedioBucaPot6)
                                {
                                    name: '{{ $promedioBucaPot6->SNRDAB }}',
                                },
                                {{ $promedioBucaPot6->promedioBucaPot6 }},
                            @endforeach
                        ],
                    ],
                }]
            });
            Highcharts.chart('containerLineBuca', {
                // chart: {
                //     type: 'spline'
                // },
                credits: {
                    enabled: false
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'MULTICOBERTURA BUCARAMANGA',
                    // 'BOGOTA',
                    // align: 'left',
                },

                subtitle: {

                    align: 'left'
                },

                yAxis: {
                    title: {
                        text: 'Potencias',
                    },
                    min: 0, // Establecer el valor mínimo en el eje Y
                    max: 200, // Establecer el valor máximo en el eje Y
                },

                xAxis: {
                    accessibility: {

                        // rangeDescription: 'Range: 2010 to 2020'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 1
                    }
                },
                series: [{
                        name: '{!! $encabezadoBuca3 !!}',
                        data: [
                            @foreach ($potenciasBuca as $pot1)
                                {
                                    name: '{{ $pot1->potenciaAM }}',
                                    y: {{ $pot1->pot1 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoBuca6 !!}',
                        data: [
                            @foreach ($potenciasBuca as $pot2)
                                {
                                    name: '{{ $pot2->potenciaFM }}',
                                    y: {{ $pot2->pot2 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoBuca9 !!}',
                        data: [
                            @foreach ($potenciasBuca as $pot3)
                                {
                                    name: '{{ $pot3->potenciaDABHibrido }}',
                                    y: {{ $pot3->pot3 }}
                                },
                            @endforeach
                        ]
                    }
                ],
                responsive: {
                    rules: [{
                        condition: {
                            // maxWidth: 200,
                            // maxHeight: 500,
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
            Highcharts.chart('containerLineBuca2', {
                // chart: {
                //     type: 'spline'
                // },
                credits: {
                    enabled: false
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'INTERFERENCIA BUCARAMANGA',
                    // 'BOGOTA',
                    // align: 'left',
                },

                subtitle: {

                    align: 'left'
                },

                yAxis: {
                    title: {
                        // enabled: false,
                        text: 'Potencias',
                    },
                    min: 0, // Establecer el valor mínimo en el eje Y
                    max: 200, // Establecer el valor máximo en el eje Y

                },
                xAxis: {
                    accessibility: {

                        // rangeDescription: 'Range: 2010 to 2020'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 1
                    }
                },
                series: [{
                        name: '{!! $encabezadoBuca12 !!}',
                        data: [
                            @foreach ($potenciasBuca as $pot4)
                                {
                                    name: '{{ $pot4->SNRAMHibrido }}',
                                    y: {{ $pot4->pot4 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoBuca15 !!}',
                        data: [
                            @foreach ($potenciasBuca as $pot5)
                                {
                                    name: '{{ $pot5->SNRFMHibrido }}',
                                    y: {{ $pot5->pot5 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoBuca18 !!}',
                        data: [
                            @foreach ($potenciasBuca as $pot6)
                                {
                                    name: '{{ $pot6->SNRDAB }}',
                                    y: {{ $pot6->pot6 }}
                                },
                            @endforeach
                        ]
                    }
                ],
                responsive: {
                    rules: [{
                        condition: {
                            // maxWidth: 500,
                            maxHeight: 500,
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
            Highcharts.chart('containerBoxBuca', {


                chart: {
                    type: 'boxplot'
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'VARIABILIDAD DE MULTICOBERTURA BUCARAMANGA',
                },

                legend: {
                    enabled: false
                },
                // accessibility: {
                //     landmarkVerbosity: 'one'
                // },

                xAxis: {
                    // crosshair: {
                    //     enabled: true
                    // },
                    categories: ['{!! $encabezadoBuca3 !!}', '{!! $encabezadoBuca3 !!}', '{!! $encabezadoBuca3 !!}'],
                    title: {
                        text: 'Potencias'
                    }
                },

                yAxis: {
                    tooltip: {
                        followPointer: true
                    },
                    title: {
                        text: 'Observaciones'
                    },
                    plotLines: [{
                        value: 932,
                        color: 'red',
                        width: 1,
                        label: {
                            // text: 'Theoretical mean: 932',
                            align: 'center',
                            style: {
                                color: 'yellow'
                            }
                        }
                    }]
                },
                series: [{
                    type: 'boxplot',
                    medianWidth: 3,
                    stickyTracking: true,
                    cursor: 'pointer',
                    colorByPoint: true,
                    name: 'Observaciones',
                    data: [
                        [
                            @foreach ($potenciasBuca as $pot1)
                                {
                                    name: '{{ $pot1->potenciaAM }}',
                                },
                                {{ $pot1->pot1 }},
                            @endforeach
                        ],
                        [
                            @foreach ($potenciasBuca as $pot2)
                                {
                                    name: '{{ $pot2->potenciaFM }}',
                                },
                                {{ $pot2->pot2 }},
                            @endforeach
                        ],
                        [
                            @foreach ($potenciasBuca as $pot3)
                                {
                                    name: '{{ $pot3->potenciaDABHibrido }}',
                                },
                                {{ $pot3->pot3 }},
                            @endforeach
                        ],
                    ],

                    tooltip: {
                        headerFormat: '<em>Potencia {point.key}</em><br/>'
                    }
                }]
            });
            Highcharts.chart('containerBoxBuca2', {


                chart: {
                    type: 'boxplot'
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'VARIABILIDAD DE INTERFERENCIA BUCARAMANGA',
                    // getColumnNameByIndex(0),
                    // 'BOGOTÁ'
                },

                legend: {
                    enabled: false
                },
                // accessibility: {
                //     landmarkVerbosity: 'one'
                // },

                xAxis: {
                    // crosshair: {
                    //     enabled: true
                    // },
                    categories: ['{!! $encabezadoBuca12 !!}', '{!! $encabezadoBuca15 !!}',
                        '{!! $encabezadoBuca18 !!}'
                    ],
                    title: {
                        text: 'Potencias'
                    }
                },

                yAxis: {
                    tooltip: {
                        followPointer: true
                    },
                    title: {
                        text: 'Observaciones'
                    },
                    plotLines: [{
                        value: 932,
                        color: 'red',
                        width: 1,
                        label: {
                            // text: 'Theoretical mean: 932',
                            align: 'center',
                            style: {
                                color: 'yellow'
                            }
                        }
                    }]
                },

                series: [{
                        type: 'boxplot',
                        medianWidth: 3,
                        stickyTracking: true,
                        cursor: 'pointer',
                        colorByPoint: true,
                        name: 'Observaciones',
                        data: [
                            [
                                @foreach ($potenciasBuca as $pot4)
                                    {
                                        name: '{{ $pot4->SNRAMHibrido }}',
                                        // '{{ $pot4->pot4 }}',
                                    },
                                    {{ $pot4->pot4 }},
                                @endforeach
                            ],
                            [
                                @foreach ($potenciasBuca as $pot5)
                                    {
                                        name: '{{ $pot5->SNRFMHibrido }}',
                                        // '{{ $pot5->pot5 }}',
                                    },
                                    {{ $pot5->pot5 }},
                                @endforeach
                            ],
                            [
                                @foreach ($potenciasBuca as $pot6)
                                    {
                                        name: '{{ $pot6->SNRDAB }}',
                                        // '{{ $pot6->pot6 }}',

                                    },
                                    {{ $pot6->pot6 }},
                                @endforeach
                            ],
                        ],

                        tooltip: {
                            headerFormat: '<em>Potencia {point.key}</em><br/>'
                        }
                    }
                ]

            });
        </script>
        <script>
            // Set up the chart
            const chart5 = new Highcharts.Chart({
                chart: {
                    renderTo: 'columnCali',
                    type: 'column',
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                xAxis: {
                    categories: ['{!! $encabezadoCali3 !!}', '{!! $encabezadoCali6 !!}', '{!! $encabezadoCali9 !!}'],
                },
                yAxis: {
                    title: {
                        text: 'Potencias',
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    // pointFormat: 'Cars sold: {point.y}'
                },
                title: {
                    text: 'PROMEDIO MULTICOBERTURA CALI',
                    align: 'center'
                },
                subtitle: {
                    // text: 'Source: ' +
                    //     '<a href="https://ofv.no/registreringsstatistikk"' +
                    //     'target="_blank">OFV</a>',
                    align: 'left'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                series: [{
                    colorByPoint: true,
                    name: 'Promedio',
                    data: [
                        [

                            @foreach ($promPotenciasCali as $promedioCaliPot1)
                                {
                                    name: '{{ $promedioCaliPot1->potenciaAM }}',
                                },
                                {{ $promedioCaliPot1->promedioCaliPot1 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotenciasCali as $promedioCaliPot2)
                                {
                                    name: '{!! $promedioCaliPot2->potenciaFM !!}',
                                },
                                {{ $promedioCaliPot2->promedioCaliPot2 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotenciasCali as $promedioCaliPot3)
                                {
                                    name: '{{ $promedioCaliPot3->potenciaDABHibrido }}',
                                },
                                {{ $promedioCaliPot3->promedioCaliPot3 }},
                            @endforeach
                        ],
                    ],
                }]
            });

            const chart6 = new Highcharts.Chart({
                chart: {
                    renderTo: 'columnCali2',
                    type: 'column',
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                xAxis: {
                    categories: ['{!! $encabezadoCali12 !!}', '{!! $encabezadoCali15 !!}', '{!! $encabezadoCali18 !!}'],
                },
                yAxis: {
                    title: {
                        text: 'Potencias',
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    // pointFormat: 'Cars sold: {point.y}'
                },
                title: {
                    text: 'PROMEDIO INTERFERENCIA CALI',
                    align: 'center'
                },
                subtitle: {
                    // text: 'Source: ' +
                    //     '<a href="https://ofv.no/registreringsstatistikk"' +
                    //     'target="_blank">OFV</a>',
                    align: 'left'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                series: [{
                    name: 'Promedio',
                    colorByPoint: true,
                    data: [
                        [

                            @foreach ($promPotenciasCali as $promedioCaliPot4)
                                {
                                    name: '{{ $promedioCaliPot4->SNRAMHibrido }}',
                                },
                                {{ $promedioCaliPot4->promedioCaliPot4 }},
                            @endforeach
                        ],

                        [

                            @foreach ($promPotenciasCali as $promedioCaliPot5)
                                {
                                    name: '{{ $promedioCaliPot5->SNRFMHibrido }}',
                                },
                                {{ $promedioCaliPot5->promedioCaliPot5 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotenciasCali as $promedioCaliPot6)
                                {
                                    name: '{{ $promedioCaliPot6->SNRDAB }}',
                                },
                                {{ $promedioCaliPot6->promedioCaliPot6 }},
                            @endforeach
                        ],
                    ],
                }]
            });
            Highcharts.chart('containerLineCali', {
                // chart: {
                //     type: 'spline'
                // },
                credits: {
                    enabled: false
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'MULTICOBERTURA CALI',
                    // 'BOGOTA',
                    // align: 'left',
                },

                subtitle: {

                    align: 'left'
                },

                yAxis: {
                    title: {
                        text: 'Potencias',
                    },
                    min: 0, // Establecer el valor mínimo en el eje Y
                    max: 200, // Establecer el valor máximo en el eje Y
                },

                xAxis: {
                    accessibility: {

                        // rangeDescription: 'Range: 2010 to 2020'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 1
                    }
                },
                series: [{
                        name: '{!! $encabezadoCali3 !!}',
                        data: [
                            @foreach ($potenciasCali as $pot1)
                                {
                                    name: '{{ $pot1->potenciaAM }}',
                                    y: {{ $pot1->pot1 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoCali6 !!}',
                        data: [
                            @foreach ($potenciasCali as $pot2)
                                {
                                    name: '{{ $pot2->potenciaFM }}',
                                    y: {{ $pot2->pot2 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoCali9 !!}',
                        data: [
                            @foreach ($potenciasCali as $pot3)
                                {
                                    name: '{{ $pot3->potenciaDABHibrido }}',
                                    y: {{ $pot3->pot3 }}
                                },
                            @endforeach
                        ]
                    }
                ],
                responsive: {
                    rules: [{
                        condition: {
                            // maxWidth: 200,
                            // maxHeight: 500,
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
            Highcharts.chart('containerLineCali2', {
                // chart: {
                //     type: 'spline'
                // },
                credits: {
                    enabled: false
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'INTERFERENCIA CALI',
                    // 'BOGOTA',
                    // align: 'left',
                },

                subtitle: {

                    align: 'left'
                },

                yAxis: {
                    title: {
                        // enabled: false,
                        text: 'Potencias',
                    },
                    min: 0, // Establecer el valor mínimo en el eje Y
                    max: 200, // Establecer el valor máximo en el eje Y

                },
                xAxis: {
                    accessibility: {

                        // rangeDescription: 'Range: 2010 to 2020'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 1
                    }
                },
                series: [{
                        name: '{!! $encabezadoCali12 !!}',
                        data: [
                            @foreach ($potenciasCali as $pot4)
                                {
                                    name: '{{ $pot4->SNRAMHibrido }}',
                                    y: {{ $pot4->pot4 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoCali15 !!}',
                        data: [
                            @foreach ($potenciasCali as $pot5)
                                {
                                    name: '{{ $pot5->SNRFMHibrido }}',
                                    y: {{ $pot5->pot5 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoCali18 !!}',
                        data: [
                            @foreach ($potenciasCali as $pot6)
                                {
                                    name: '{{ $pot6->SNRDAB }}',
                                    y: {{ $pot6->pot6 }}
                                },
                            @endforeach
                        ]
                    }
                ],
                responsive: {
                    rules: [{
                        condition: {
                            // maxWidth: 500,
                            maxHeight: 500,
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
            Highcharts.chart('containerBoxCali', {


                chart: {
                    type: 'boxplot'
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'VARIABILIDAD DE MULTICOBERTURA CALI',
                    // getColumnNameByIndex(0),
                    // 'BOGOTÁ'
                },

                legend: {
                    enabled: false
                },
                // accessibility: {
                //     landmarkVerbosity: 'one'
                // },

                xAxis: {
                    // crosshair: {
                    //     enabled: true
                    // },
                    categories: ['{!! $encabezadoCali3 !!}', '{!! $encabezadoCali6 !!}',
                        '{!! $encabezadoCali9 !!}'
                    ],
                    title: {
                        text: 'Potencias'
                    }
                },

                yAxis: {
                    tooltip: {
                        followPointer: true
                    },
                    title: {
                        text: 'Observaciones'
                    },
                    in: 0, // Establecer el valor mínimo en el eje Y
                    // max: 200,
                    plotLines: [{
                        value: 932,
                        color: 'red',
                        width: 1,
                        label: {
                            style: {
                                color: 'gray'
                            }
                        }
                    }]
                },

                series: [{
                    type: 'boxplot',
                    medianWidth: 3,
                    stickyTracking: true,
                    cursor: 'pointer',
                    colorByPoint: true,
                    name: 'Observaciones',
                    data: [
                        [
                            @foreach ($potenciasCali as $pot1)
                                {
                                    name: '{{ $pot1->potenciaAM }}',
                                },
                                {{ $pot1->pot1 }},
                            @endforeach
                        ],
                        [
                            @foreach ($potenciasCali as $pot2)
                                {
                                    name: '{{ $pot2->potenciaFM }}',
                                },
                                {{ $pot2->pot2 }},
                            @endforeach
                        ],
                        [
                            @foreach ($potenciasCali as $pot3)
                                {
                                    name: '{{ $pot3->potenciaDABHibrido }}',
                                },
                                {{ $pot3->pot3 }},
                            @endforeach
                        ],
                    ],

                    tooltip: {
                        headerFormat: '<em>Potencia {point.key}</em><br/>'
                    }
                }, ]

            });
            Highcharts.chart('containerBoxCali2', {


                chart: {
                    type: 'boxplot'
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'VARIABILIDAD DE INTERFERENCIA CALI',
                    // getColumnNameByIndex(0),
                    // 'BOGOTÁ'
                },

                legend: {
                    enabled: false
                },
                // accessibility: {
                //     landmarkVerbosity: 'one'
                // },

                xAxis: {
                    // crosshair: {
                    //     enabled: true
                    // },
                    categories: ['{!! $encabezadoCali12 !!}', '{!! $encabezadoCali15 !!}',
                        '{!! $encabezadoCali18 !!}'
                    ],
                    title: {
                        text: 'Potencias'
                    }
                },

                yAxis: {
                    tooltip: {
                        followPointer: true
                    },
                    title: {
                        text: 'Observaciones'
                    },
                    in: 0, // Establecer el valor mínimo en el eje Y
                    // max: 200,
                    plotLines: [{
                        value: 932,
                        color: 'red',
                        width: 1,
                        label: {
                            // text: 'Theoretical mean: 932',
                            align: 'center',
                            style: {
                                color: 'yellow'
                            }
                        }
                    }]
                },

                series: [{
                        type: 'boxplot',
                        medianWidth: 3,
                        stickyTracking: true,
                        cursor: 'pointer',
                        colorByPoint: true,
                        name: 'Observaciones',
                        data: [
                            [
                                @foreach ($potenciasCali as $pot4)
                                    {
                                        name: '{{ $pot4->SNRAMHibrido }}',
                                    },
                                    {{ $pot4->pot4 }},
                                @endforeach
                            ],
                            [
                                @foreach ($potenciasCali as $pot5)
                                    {
                                        name: '{{ $pot5->SNRFMHibrido }}',
                                    },
                                    {{ $pot5->pot5 }},
                                @endforeach
                            ],
                            [
                                @foreach ($potenciasCali as $pot6)
                                    {
                                        name: '{{ $pot6->SNRDAB }}',
                                    },
                                    {{ $pot6->pot6 }},
                                @endforeach
                            ],
                        ],

                        tooltip: {
                            headerFormat: '<em>Potencia {point.key}</em><br/>'
                        }
                    }
                ]

            });
        </script>
        <script>
            // Set up the chart
            const chart7 = new Highcharts.Chart({
                chart: {
                    renderTo: 'columnMede',
                    type: 'column',
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                xAxis: {
                    categories: ['{!! $encabezadoMede3 !!}', '{!! $encabezadoMede6 !!}', '{!! $encabezadoMede9 !!}'],
                },
                yAxis: {
                    title: {
                        text: 'Potencias'
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    // pointFormat: 'Cars sold: {point.y}'
                },
                title: {
                    text: 'PROMEDIO MULTICOBERTURA MEDELLIN',
                    align: 'center'
                },
                subtitle: {
                    // text: 'Source: ' +
                    //     '<a href="https://ofv.no/registreringsstatistikk"' +
                    //     'target="_blank">OFV</a>',
                    align: 'left'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                series: [{
                    colorByPoint: true,
                    name: 'Promedio',
                    data: [
                        [

                            @foreach ($promPotenciasMede as $promedioMedePot1)
                                {
                                    name: '{{ $promedioMedePot1->potenciaAM }}',
                                },
                                {{ $promedioMedePot1->promedioMedePot1 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotenciasMede as $promedioMedePot2)
                                {
                                    name: '{!! $promedioMedePot2->potenciaFM !!}',
                                },
                                {{ $promedioMedePot2->promedioMedePot2 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotenciasMede as $promedioMedePot3)
                                {
                                    name: '{{ $promedioMedePot3->potenciaDABHibrido }}',
                                },
                                {{ $promedioMedePot3->promedioMedePot3 }},
                            @endforeach
                        ],
                    ],
                }]
            });

            const chart8 = new Highcharts.Chart({
                chart: {
                    renderTo: 'columnMede2',
                    type: 'column',
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                xAxis: {
                    categories: ['{!! $encabezadoMede12 !!}', '{!! $encabezadoMede15 !!}', '{!! $encabezadoMede18 !!}'],
                },
                yAxis: {
                    title: {
                        text: 'Potencias'
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    // pointFormat: 'Cars sold: {point.y}'
                },
                title: {
                    text: 'PROMEDIO INTERFERENCIA MEDELLIN',
                    align: 'center'
                },
                subtitle: {
                    // text: 'Source: ' +
                    //     '<a href="https://ofv.no/registreringsstatistikk"' +
                    //     'target="_blank">OFV</a>',
                    align: 'left'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                series: [{
                    colorByPoint: true,
                    name: 'Promedio',
                    data: [
                        [

                            @foreach ($promPotenciasMede as $promedioMedePot4)
                                {
                                    name: '{{ $promedioMedePot4->potenciaAM }}',
                                },
                                {{ $promedioMedePot4->promedioMedePot4 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotenciasMede as $promedioMedePot5)
                                {
                                    name: '{!! $promedioMedePot5->potenciaFM !!}',
                                },
                                {{ $promedioMedePot5->promedioMedePot5 }},
                            @endforeach
                        ],
                        [

                            @foreach ($promPotenciasMede as $promedioMedePot6)
                                {
                                    name: '{{ $promedioMedePot6->potenciaDABHibrido }}',
                                },
                                {{ $promedioMedePot6->promedioMedePot6 }},
                            @endforeach
                        ],
                    ],
                }]

            });
            Highcharts.chart('containerLineMede', {
                // chart: {
                //     type: 'spline'
                // },
                credits: {
                    enabled: false
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'MULTICOBERTURA MEDELLIN',
                    // 'BOGOTA',
                    // align: 'left',
                },

                subtitle: {

                    align: 'left'
                },

                yAxis: {
                    title: {
                        text: 'Potencias',
                    },
                    min: 0, // Establecer el valor mínimo en el eje Y
                    max: 200, // Establecer el valor máximo en el eje Y
                },

                xAxis: {
                    accessibility: {

                        // rangeDescription: 'Range: 2010 to 2020'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 1
                    }
                },
                series: [{
                        name: '{!! $encabezadoMede3 !!}',
                        data: [
                            @foreach ($potenciasMede as $pot1)
                                {
                                    name: '{{ $pot1->potenciaAM }}',
                                    y: {{ $pot1->pot1 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoMede6 !!}',
                        data: [
                            @foreach ($potenciasMede as $pot2)
                                {
                                    name: '{{ $pot2->potenciaFM }}',
                                    y: {{ $pot2->pot2 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoMede9 !!}',
                        data: [
                            @foreach ($potenciasMede as $pot3)
                                {
                                    name: '{{ $pot3->potenciaDABHibrido }}',
                                    y: {{ $pot3->pot3 }}
                                },
                            @endforeach
                        ]
                    }
                ],
                responsive: {
                    rules: [{
                        condition: {
                            // maxWidth: 200,
                            // maxHeight: 500,
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
            Highcharts.chart('containerLineMede2', {
                // chart: {
                //     type: 'spline'
                // },
                credits: {
                    enabled: false
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'INTERFERENCIA MEDELLIN',
                    // 'BOGOTA',
                    // align: 'left',
                },

                subtitle: {

                    align: 'left'
                },

                yAxis: {
                    title: {
                        // enabled: false,
                        text: 'Potencias',
                    },
                    min: 0, // Establecer el valor mínimo en el eje Y
                    max: 200, // Establecer el valor máximo en el eje Y

                },
                xAxis: {
                    accessibility: {

                        // rangeDescription: 'Range: 2010 to 2020'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 1
                    }
                },
                series: [{
                        name: '{!! $encabezadoMede12 !!}',
                        data: [
                            @foreach ($potenciasMede as $pot4)
                                {
                                    name: '{{ $pot4->SNRAMHibrido }}',
                                    y: {{ $pot4->pot4 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoMede15 !!}',
                        data: [
                            @foreach ($potenciasMede as $pot5)
                                {
                                    name: '{{ $pot5->SNRFMHibrido }}',
                                    y: {{ $pot5->pot5 }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: '{!! $encabezadoMede18 !!}',
                        data: [
                            @foreach ($potenciasMede as $pot6)
                                {
                                    name: '{{ $pot6->SNRDAB }}',
                                    y: {{ $pot6->pot6 }}
                                },
                            @endforeach
                        ]
                    }
                ],
                responsive: {
                    rules: [{
                        condition: {
                            // maxWidth: 500,
                            maxHeight: 500,
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
            Highcharts.chart('containerBoxMede', {


                chart: {
                    type: 'boxplot'
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'VARIABILIDAD DE MULTICOBERTURA MEDELLIN',
                    // getColumnNameByIndex(0),
                    // 'BOGOTÁ'
                },

                legend: {
                    enabled: false
                },
                // accessibility: {
                //     landmarkVerbosity: 'one'
                // },

                xAxis: {
                    // crosshair: {
                    //     enabled: true
                    // },
                    categories: ['{!! $encabezadoMede3 !!}', '{!! $encabezadoMede6 !!}',
                        '{!! $encabezadoMede9 !!}'
                    ],
                    title: {
                        text: 'Potencias'
                    }
                },

                yAxis: {
                    tooltip: {
                        followPointer: true
                    },
                    title: {
                        text: 'Observaciones'
                    },
                    in: 0, // Establecer el valor mínimo en el eje Y
                    // max: 200,
                    plotLines: [{
                        value: 932,
                        color: 'red',
                        width: 1,
                        label: {
                            // text: 'Theoretical mean: 932',
                            align: 'center',
                            style: {
                                color: 'yellow'
                            }
                        }
                    }]
                },

                series: [{
                        type: 'boxplot',
                        medianWidth: 3,
                        stickyTracking: true,
                        cursor: 'pointer',
                        colorByPoint: true,
                        name: 'Observaciones',
                        data: [
                            [
                                @foreach ($potenciasMede as $pot1)
                                    {
                                        name: '{{ $pot1->potenciaAM }}',
                                    },
                                    {{ $pot1->pot1 }},
                                @endforeach
                            ],
                            [
                                @foreach ($potenciasMede as $pot2)
                                    {
                                        name: '{{ $pot2->potenciaFM }}',
                                    },
                                    {{ $pot2->pot2 }},
                                @endforeach
                            ],
                            [
                                @foreach ($potenciasMede as $pot3)
                                    {
                                        name: '{{ $pot3->potenciaDABHibrido }}',
                                    },
                                    {{ $pot3->pot3 }},
                                @endforeach
                            ],
                        ],

                        tooltip: {
                            headerFormat: '<em>Potencia {point.key}</em><br/>'
                        }
                    }
                ]

            });
            Highcharts.chart('containerBoxMede2', {


                chart: {
                    type: 'boxplot'
                },
                lang: {
                    downloadCSV: "Descargar CSV",
                    downloadXLS: "Descargar XLS",
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    printChart: "Imprimir Grafica",
                    downloadJPEG: "Descargar JPG",
                    downloadPDF: "Descargar PDF",
                    downloadPNG: "Descargar PNG",
                    downloadSVG: "Descargar SVG",
                    hideData: "Ocultar Datos",
                    viewData: "Mostrar Datos"
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'VARIABILIDAD DE INTERFERENCIA MEDELLIN',
                },

                legend: {
                    enabled: false
                },
                accessibility: {
                    landmarkVerbosity: 'one'
                },

                xAxis: {
                    // crosshair: {
                    //     enabled: true
                    // },
                    categories: ['{!! $encabezadoMede12 !!}', '{!! $encabezadoMede15 !!}',
                        '{!! $encabezadoMede18 !!}'
                    ],
                    title: {
                        text: 'Potencias'
                    }
                },

                yAxis: {
                    tooltip: {
                        followPointer: true
                    },
                    title: {
                        text: 'Observaciones'
                    },
                    in: 0, // Establecer el valor mínimo en el eje Y
                    // max: 200,
                    plotLines: [{
                        value: 932,
                        color: 'red',
                        width: 1,
                        label: {
                            // text: 'Theoretical mean: 932',
                            align: 'center',
                            style: {
                                color: 'yellow'
                            }
                        }
                    }]
                },

                series: [{
                        type: 'boxplot',
                        medianWidth: 3,
                        stickyTracking: true,
                        cursor: 'pointer',
                        colorByPoint: true,
                        name: 'Observaciones',
                        data: [
                            [
                                @foreach ($potenciasMede as $pot4)
                                    {
                                        name: '{{ $pot4->SNRAMHibrido }}',
                                    },
                                    {{ $pot4->pot4 }},
                                @endforeach
                            ],
                            [
                                @foreach ($potenciasMede as $pot5)
                                    {
                                        name: '{{ $pot5->SNRFMHibrido }}',
                                    },
                                    {{ $pot5->pot5 }},
                                @endforeach
                            ],
                            [
                                @foreach ($potenciasMede as $pot6)
                                    {
                                        name: '{{ $pot6->SNRDAB }}',
                                    },
                                    {{ $pot6->pot6 }},
                                @endforeach
                            ],
                        ],

                        tooltip: {
                            headerFormat: '<em>Potencia {point.key}</em><br/>'
                        }
                    }
                ]

            });
        </script>
    @endsection
