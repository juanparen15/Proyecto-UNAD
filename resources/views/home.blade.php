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
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <div id="containerLine"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <div id="containerBox"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <div id="containerLine2"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <div id="containerBox2"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <div id="containerLine3"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <div id="containerBox3"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <div id="containerLine4"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <div id="containerBox4"></div>
                                    </div>
                                </div>
                                {{-- {<div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <div id="container"></div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <div id="containerTime"></div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6 col-16">
                                    <div class="small-box">
                                        <canvas id="planes"></canvas>
                                    </div>
                                </div> --}}
                            </div>

                            {{-- <figure class="highcharts-figure">
                            </figure> --}}


                            {{-- <figure class="highcharts-figure">
                                <div id="containerLabel"></div>
                            </figure> --}}
                        </div>
                    </section>
                </div>
            </div>
        </div>


    @endsection

    @section('script')

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/timeline.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
        <script src="https://code.highcharts.com/themes/dark-unica.js"></script>
        <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>



        {{-- <script> --}}
        {{-- // import Highcharts from 'https://code.highcharts.com/es-modules/masters/highcharts.src.js'; --}}
        {{-- Highcharts.chart('containerTime', {
                chart: {
                    type: 'timeline',
                },
                credits: {
                    enabled: false
                },

                accessibility: {
                    screenReaderSection: {
                        beforeChartFormat: '<h5>{chartTitle}</h5>' +
                            '<div>{typeDescription}</div>' +
                            '<div>{chartSubtitle}</div>' +
                            '<div>{chartLongdesc}</div>' +
                            '<div>{viewTableButton}</div>'
                    },
                    point: {
                        valueDescriptionFormat: '{index}. {point.name}. {point.description}.'
                    }
                },
                xAxis: {
                    visible: false
                },
                yAxis: {
                    visible: false
                },
                title: {
                    text: '<br>Linea de tiempo</br>'
                },
                subtitle: {
                    // backgroundColor: '#ffff',
                    // color: '#ffffff',
                    // text: 'Mas Información: <a href="https://www.puertoboyaca-boyaca.gov.co">https://www.puertoboyaca-boyaca.gov.co</a>'

                },
                colors: [
                    '#4185F3',
                    '#427CDD',
                    '#406AB2',
                    '#3E5A8E',
                    '#3B4A68',
                    '#363C46'
                ],
                series: [{
                    data: [<?php foreach ($adquisiciones3 as $adq) { ?> {
                            name: '<?php echo $adq->anyo; ?>',
                            description: 'Total Carpetas: ' + <?php echo $adq->adq; ?>
                        },
                        <?php } ?>
                    ]

                }]
            });


            Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie',
                    // backgroundColor: '#272727',


                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'Grafica',
                    align: 'left',
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f}%',
                            // style: {
                            //     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            // }
                        }
                    }
                },

                series: [{
                    type: 'pie',
                    name: 'Carpetas',
                    colorByPoint: true,
                    data: [<?php foreach ($adquisiciones as $adq) { ?> {
                            name: '<?php echo $adq->area_name; ?>',
                            y: <?php echo $adq->adq; ?>
                        },
                        <?php } ?>
                    ]


                }]
            }); --}}
        <script>
            Highcharts.chart('containerLine', {
                chart: {
                    type: 'spline'
                },
                credits: {
                    enabled: false
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'BOGOTA',
                    // align: 'left',
                },

                subtitle: {
                    // text: 'By Job Category. Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>.',
                    align: 'left'
                },

                yAxis: {
                    title: {
                        // text: 'Number of Employees'
                    }
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
                    color: 'yellow',
                    name: 'Potencia',
                    // data: [<?php foreach ($potencias as $pot) { ?> {
                    //         name: '<?php echo $pot->potencia; ?>',
                    //         description: 'Potencia: ' + <?php echo $pot->pot; ?>
                    //     },
                    //     <?php } ?>
                    // ],
                    data: [
                        @foreach ($potencias as $pot)
                            {
                                name: '{{ $pot->potencia }}',
                                y: {{ $pot->pot }}
                            },
                        @endforeach
                    ],

                    // data: [81.4, 82.6, 83.7, 84.3, 85.4, 84.6, 84.7, 85.5, 86.5, 85.6, 87.5, 86.7, 87.5, 87,
                    //     85.8, 84.2, 82.5, 83.7, 85.2, 87.8, 89.4, 90, 89.3, 90, 92.8, 92.9, 92.1, 87.7, 86,
                    //     86.1, 89.2, 93, 97.1, 96.5, 94, 94.8, 98.5, 99.9, 96.4, 92.6, 88, 91.1, 96.8, 102.6,
                    //     102.4, 99.7, 101.1, 102.5, 95.4, 91.2, 89.4, 89.2, 90.9, 94.1, 99.8, 108.2, 104.1,
                    //     105.7, 100.8, 94.5, 89.9, 93.2, 95.3, 97.4, 99, 99.9, 104.7, 105.8, 107.6, 109.5,
                    //     90.5, 96.3, 99.6, 102.1, 106, 106.3, 91.2, 96, 99.6, 103.6, 92.8, 99.1, 111.8,
                    //     106.4, 99.7, 101.4, 102.8, 100.7, 92, 95.4, 90.2, 94.6, 98.5, 107.3, 104.4, 121.9,
                    //     103.3, 98.6, 96.3, 93.9,
                    // ],

                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500,
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
                credits: {
                    enabled: false
                },
                title: {
                    text: 'BOGOTÁ'
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
                    categories: ['Bogotá'],
                    title: {
                        text: 'Potencia No.'
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
                    color: 'yellow',
                    name: 'Observaciones',
                    data: [

                        [81.4, 82.6, 83.7, 84.3, 85.4, 84.6, 84.7, 85.5, 86.5, 85.6, 87.5, 86.7, 87.5, 87,
                            85.8, 84.2, 82.5, 83.7, 85.2, 87.8, 89.4, 90, 89.3, 90, 92.8, 92.9, 92.1, 87.7,
                            86, 86.1, 89.2, 93, 97.1, 96.5, 94, 94.8, 98.5, 99.9, 96.4, 92.6, 88, 91.1,
                            96.8,
                            102.6, 102.4, 99.7, 101.1, 102.5, 95.4, 91.2, 89.4, 89.2, 90.9, 94.1, 99.8,
                            108.2,
                            104.1, 105.7, 100.8, 94.5, 89.9, 93.2, 95.3, 97.4, 99, 99.9, 104.7, 105.8,
                            107.6,
                            109.5, 90.5, 96.3, 99.6, 102.1, 106, 106.3, 91.2, 96, 99.6, 103.6, 92.8, 99.1,
                            111.8,
                            106.4, 99.7, 101.4, 102.8, 100.7, 92, 95.4, 90.2, 94.6, 98.5, 107.3, 104.4,
                            121.9, 103.3, 98.6, 96.3, 93.9
                        ],
                    ],
                    tooltip: {
                        headerFormat: '<em>Potencia {point.key}</em><br/>'
                    }
                }, {
                    name: 'Outliers',
                    color: Highcharts.getOptions().colors[0],
                    type: 'scatter',
                    data: [ // x, y positions where 0 is the first category
                        // [0, 644],


                    ],
                    marker: {
                        fillColor: 'white',
                        lineWidth: 1,
                        lineColor: Highcharts.getOptions().colors[0]
                    },
                    tooltip: {
                        pointFormat: 'Observacion: {point.y}'
                    }
                }]

            });

            Highcharts.chart('containerLine2', {
                chart: {
                    type: 'spline'
                },
                credits: {
                    enabled: false
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'BUCARAMANGA',
                    // align: 'left',
                },

                subtitle: {
                    // text: 'By Job Category. Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>.',
                    align: 'left'
                },

                yAxis: {
                    title: {
                        // text: 'Number of Employees'
                    }
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
                    color: 'blue',
                    name: 'Potencia',
                    data: [107.1, 104.7, 110.5, 109.7, 107.8, 105.8, 104.2, 103.9, 104.3, 105.7, 104.7, 106.4,
                        108.9, 111.6, 112.6, 112.3, 109.7, 113.2, 116.2, 115.5, 111.8, 108.4, 105.7, 104.9,
                        107.5, 110.8, 117.3, 131.4, 116.1, 116.2, 114.9, 120.5, 113.3, 109, 106.1, 104.7,
                        107.1, 110.2, 114.4, 118.6, 112.6, 121.6, 113.4, 110.8, 106.6, 104.4, 104, 110.8,
                        114.7, 117.2, 118.3, 113.6, 115.5, 112.6, 109.3, 107, 105.3, 106.6, 107.9, 112.6,
                        116.1, 114.4, 117.5, 114.4, 109.8, 108.1, 106.7, 103.1, 102.4, 103.1, 117.8, 120.3,
                        115.5, 110.1, 109.3, 102.6, 117.4, 112.6, 119.4, 118.6, 113.9, 113.2, 109, 106.1,
                        101.7, 104.6, 106.6, 109, 103.2, 102.8, 87.4, 98.5, 102.2, 102.2, 102.5, 102.8,
                        100.8, 101.5, 99, 87.5,
                    ],

                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500,
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

            Highcharts.chart('containerBox2', {


                chart: {
                    type: 'boxplot'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'BUCARAMANGA'
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
                    categories: ['Bucaramanga'],
                    title: {
                        text: 'Potencia No.'
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
                        color: 'blue',
                        width: 1,
                        label: {
                            // text: 'Theoretical mean: 932',
                            align: 'center',
                            style: {
                                color: 'blue'
                            }
                        }
                    }]
                },

                series: [{
                    type: 'boxplot',
                    medianWidth: 3,
                    stickyTracking: true,
                    cursor: 'pointer',
                    color: 'blue',
                    name: 'Observaciones',
                    data: [

                        [107.1, 104.7, 110.5, 109.7, 107.8, 105.8, 104.2, 103.9, 104.3, 105.7, 104.7, 106.4,
                            108.9, 111.6, 112.6, 112.3, 109.7, 113.2, 116.2, 115.5, 111.8, 108.4, 105.7,
                            104.9, 107.5, 110.8, 117.3, 131.4, 116.1, 116.2, 114.9, 120.5, 113.3, 109,
                            106.1, 104.7, 107.1, 110.2, 114.4, 118.6, 112.6, 121.6, 113.4, 110.8, 106.6,
                            104.4, 104, 110.8, 114.7, 117.2, 118.3, 113.6, 115.5, 112.6, 109.3, 107, 105.3,
                            106.6, 107.9, 112.6, 116.1, 114.4, 117.5, 114.4, 109.8, 108.1, 106.7, 103.1,
                            102.4, 103.1, 117.8, 120.3, 115.5, 110.1, 109.3, 102.6, 117.4, 112.6, 119.4,
                            118.6, 113.9, 113.2, 109, 106.1, 101.7, 104.6, 106.6, 109, 103.2, 102.8, 87.4,
                            98.5, 102.2, 102.2, 102.5, 102.8, 100.8, 101.5, 99, 87.5,
                        ],
                    ],
                    tooltip: {
                        headerFormat: '<em>Potencia {point.key}</em><br/>'
                    }
                }, {
                    name: 'Outliers',
                    color: Highcharts.getOptions().colors[0],
                    type: 'scatter',
                    data: [ // x, y positions where 0 is the first category
                        // [0, 644],


                    ],
                    marker: {
                        fillColor: 'white',
                        lineWidth: 1,
                        lineColor: Highcharts.getOptions().colors[0]
                    },
                    tooltip: {
                        pointFormat: 'Observacion: {point.y}'
                    }
                }]

            });

            Highcharts.chart('containerLine3', {
                chart: {
                    type: 'spline'
                },
                credits: {
                    enabled: false
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'CALI',
                    // align: 'left',
                },

                subtitle: {
                    // text: 'By Job Category. Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>.',
                    align: 'left'
                },

                yAxis: {
                    title: {
                        // text: 'Number of Employees'
                    }
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
                    color: 'orange',
                    name: 'Potencia',
                    data: [98.7, 96.2, 102, 101.1, 99.2, 97.3, 95.6, 95.3, 95.7, 97.2, 96.1, 97.8, 100.3, 102.9,
                        104, 103.8, 101.3, 104.8, 107.6, 99.6, 103.1, 99.7, 97.1, 96.3, 98.9, 102.2, 108.4,
                        126.5, 107.7, 107.8, 106.4, 111.9, 104.6, 100.4, 97.5, 96.2, 98.5, 101.6, 105.8,
                        110.1, 111.1, 113.1, 105, 102.4, 98, 95.9, 97.2, 102.4, 106.2, 108.7, 109.8, 105.1,
                        107, 104.1, 100.9, 108.1, 95.7, 104.4, 101.4, 104.1, 107.6, 105.9, 109.1, 105.9,
                        101.3, 99.6, 98.2, 103.8, 103.8, 100.4, 109.4, 111.8, 107.1, 101.7, 102.5, 102.9,
                        109, 109.3, 111, 105.3, 105.5, 104.8, 110.3, 106.6, 94.7, 103.5, 102.7, 100.7, 95.7,
                        94.3, 94.5, 93.6, 98.2, 95.6, 95.9, 121.3, 95.8, 95, 93.4, 84.8,
                    ],

                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500,
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

            Highcharts.chart('containerBox3', {


                chart: {
                    type: 'boxplot'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'CALI'
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
                    categories: ['Cali'],
                    title: {
                        text: 'Potencia No.'
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
                        color: 'orange',
                        width: 1,
                        label: {
                            // text: 'Theoretical mean: 932',
                            align: 'center',
                            style: {
                                color: 'orange'
                            }
                        }
                    }]
                },

                series: [{
                    type: 'boxplot',
                    medianWidth: 3,
                    stickyTracking: true,
                    cursor: 'pointer',
                    color: 'orange',
                    name: 'Observaciones',
                    data: [

                        [
                            98.7, 96.2, 102, 101.1, 99.2, 97.3, 95.6, 95.3, 95.7, 97.2, 96.1, 97.8, 100.3,
                            102.9, 104, 103.8, 101.3, 104.8, 107.6, 99.6, 103.1, 99.7, 97.1, 96.3, 98.9,
                            102.2, 108.4, 126.5, 107.7, 107.8, 106.4, 111.9, 104.6, 100.4, 97.5, 96.2, 98.5,
                            101.6, 105.8, 110.1, 111.1, 113.1, 105, 102.4, 98, 95.9, 97.2, 102.4, 106.2,
                            108.7, 109.8, 105.1, 107, 104.1, 100.9, 108.1, 95.7, 104.4, 101.4, 104.1, 107.6,
                            105.9, 109.1, 105.9, 101.3, 99.6, 98.2, 103.8, 103.8, 100.4, 109.4, 111.8,
                            107.1, 101.7, 102.5, 102.9, 109, 109.3, 111, 105.3, 105.5, 104.8, 110.3, 106.6,
                            94.7, 103.5, 102.7, 100.7, 95.7, 94.3, 94.5, 93.6, 98.2, 95.6, 95.9, 121.3,
                            95.8, 95, 93.4, 84.8,
                        ],
                    ],
                    tooltip: {
                        headerFormat: '<em>Potencia {point.key}</em><br/>'
                    }
                }, {
                    name: 'Outliers',
                    color: Highcharts.getOptions().colors[0],
                    type: 'scatter',
                    data: [ // x, y positions where 0 is the first category
                        // [0, 644],


                    ],
                    marker: {
                        fillColor: 'white',
                        lineWidth: 1,
                        lineColor: Highcharts.getOptions().colors[0]
                    },
                    tooltip: {
                        pointFormat: 'Observacion: {point.y}'
                    }
                }]

            });

            Highcharts.chart('containerLine4', {
                chart: {
                    type: 'spline'
                },
                credits: {
                    enabled: false
                },
                title: {
                    style: {
                        color: '#E0E0E3',
                        textTransform: 'uppercase',
                        fontSize: '20px'
                    },
                    text: 'MEDELLIN',
                    // align: 'left',
                },

                subtitle: {
                    // text: 'By Job Category. Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>.',
                    align: 'left'
                },

                yAxis: {
                    title: {
                        // text: 'Number of Employees'
                    }
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
                    color: 'pink',
                    name: 'Potencia',
                    data: [
                        93.25, 93.26, 100.67, 100.64, 100.73, 93.35, 93.37, 93.3, 93.37, 93.36, 93.36,
                        100.61, 100.74, 100.86, 100.81, 100.7, 93.24, 100.65, 100.82, 100.91, 100.93,
                        100.84, 100.61, 93.81, 101, 101.18, 101.14, 100.89, 100.79, 100.76, 100.99, 101.16,
                        101.41, 101.18, 93.84, 93.87, 94, 101.58, 101.37, 101.1, 98.72, 0.94, 101.37,
                        101.68, 101.43, 93.92, 93.81, 101.58, 101.09, 98.74, 98.8, 98.8, 98.84, 98.87,
                        101.08, 94.12, 93.47, 93.96, 100.78, 98.82, 98.85, 98.88, 98.9, 98.95, 98.91, 93.41,
                        99.72, 107.93, 108.05, 108.07, 98.85, 98.99, 99.02, 98.97, 99.07, 105.97, 98.9, 99,
                        99.01, 99, 98.91, 98.98, 99.08, 106.26, 97.07, 97.34, 99.05, 98.97, 98.95, 98.98,
                        98.91, 98.91, 97.39, 97.67, 97.54, 97.37, 97.56, 97.37, 98.95, 98.93,
                    ],

                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500,
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

            Highcharts.chart('containerBox4', {


                chart: {
                    type: 'boxplot'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'MEDELLIN'
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
                    categories: ['Medellin'],
                    title: {
                        text: 'Potencia No.'
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
                        color: 'pink',
                        width: 1,
                        label: {
                            // text: 'Theoretical mean: 932',
                            align: 'center',
                            style: {
                                color: 'pink'
                            }
                        }
                    }]
                },

                series: [{
                    type: 'boxplot',
                    medianWidth: 3,
                    stickyTracking: true,
                    cursor: 'pointer',
                    color: 'pink',
                    name: 'Observaciones',
                    data: [

                        [
                            93.25, 93.26, 100.67, 100.64, 100.73, 93.35, 93.37, 93.3, 93.37, 93.36, 93.36,
                            100.61, 100.74, 100.86, 100.81, 100.7, 93.24, 100.65, 100.82, 100.91, 100.93,
                            100.84, 100.61, 93.81, 101, 101.18, 101.14, 100.89, 100.79, 100.76, 100.99,
                            101.16, 101.41, 101.18, 93.84, 93.87, 94, 101.58, 101.37, 101.1, 98.72, 0.94,
                            101.37, 101.68, 101.43, 93.92, 93.81, 101.58, 101.09, 98.74, 98.8, 98.8, 98.84,
                            98.87, 101.08, 94.12, 93.47, 93.96, 100.78, 98.82, 98.85, 98.88, 98.9, 98.95,
                            98.91, 93.41, 99.72, 107.93, 108.05, 108.07, 98.85, 98.99, 99.02, 98.97, 99.07,
                            105.97, 98.9, 99, 99.01, 99, 98.91, 98.98, 99.08, 106.26, 97.07, 97.34, 99.05,
                            98.97, 98.95, 98.98, 98.91, 98.91, 97.39, 97.67, 97.54, 97.37, 97.56, 97.37,
                            98.95, 98.93,
                        ],
                    ],
                    tooltip: {
                        headerFormat: '<em>Potencia {point.key}</em><br/>'
                    }
                }, {
                    name: 'Outliers',
                    color: Highcharts.getOptions().colors[0],
                    type: 'scatter',
                    data: [ // x, y positions where 0 is the first category
                        // [0, 644],


                    ],
                    marker: {
                        fillColor: 'white',
                        lineWidth: 1,
                        lineColor: Highcharts.getOptions().colors[0]
                    },
                    tooltip: {
                        pointFormat: 'Observacion: {point.y}'
                    }
                }]

            });
        </script>

        {{-- <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
        <script>
            $(function() {
                var varCompra = document.getElementById('planes').getContext('2d');

                var charCompra = new Chart(varCompra, {
                    type: 'line',
                    data: {
                        labels: [<?php foreach ($planes as $reg) {
                            setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
                            $mes_traducido = strftime('%B', strtotime($reg->mes));
                        
                            echo '"' . $mes_traducido . '",';
                        } ?>],
                        datasets: [{
                            label: 'Total del mes',
                            data: [<?php foreach ($planes as $reg) {
                                echo '' . $reg->totalmes . ',';
                            } ?>],

                            backgroundColor: '#E91E63',
                            borderColor: '#E91E63',
                            borderWidth: 3
                        }]
                    },

                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {

                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        },
                        elements: {
                            point: {
                                radius: 5
                            }
                        }
                    }
                });
            });
        </script> --}}
    @endsection
