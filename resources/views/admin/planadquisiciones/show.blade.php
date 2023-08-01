@extends('layouts.admin')
@section('title', 'Detalles de Inventario')
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
                        <h1>Detalles de Inventario</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('planadquisiciones.index') }}">Inventario </a></li>
                            <li class="breadcrumb-item active">Detalles de Inventario</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="card">
                {{--  <div class="card-header">
              <h3 class="card-title">General</h3>
            </div>  --}}
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>NUMERO DE ORDEN:</strong><br>
                                {{ $inventario->id }}
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>ENTIDAD PRODUCTORA:</strong><br>
                                {{ $inventario->area->dependencia->nomdependencia }}
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>UNIDAD ADMINISTRATIVA:</strong><br>
                                {{ $inventario->area->nomarea }}
                            </address>
                        </div>

                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>OBJETO:</strong><br>
                                {{ $inventario->modalidad->detmodalidad }}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>CODIGO DE DEPENDENCIA:</strong><br>
                                {{ $inventario->requiproyecto->detproyeto }}
                            </address>
                        </div>
                        <!-- /.col -->


                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>TIPO DE SERIES DOCUMENTALES:</strong><br>
                                {{ $inventario->segmento->detsegmento }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>TIPO DE SUBSERIE DOCUMENTAL:</strong><br>
                                {{ $inventario->familias->detfamilia }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>FECHAS EXTREMAS | FECHA INICIAL:</strong><br>
                                {{ $inventario->fechaInicial }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>FECHAS EXTREMAS | FECHA FINAL:</strong><br>
                                {{ $inventario->fechaFinal }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>UNIDAD DE CONSERVACIÓN | CAJA:</strong><br>
                                {{ $inventario->caja }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>UNIDAD DE CONSERVACIÓN | CARPETA:</strong><br>
                                {{ $inventario->carpeta }}
                            </address>
                        </div>


                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>UNIDAD DE CONSERVACIÓN | TOMO:</strong><br>
                                {{ $inventario->tomo }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>OPCION OTRO:</strong><br>
                                {{ $inventario->requipoais->detpoai }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>UNIDAD DE CONSERVACIÓN | OTRO:</strong><br>
                                {{ $inventario->otro }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>NUMERO DE FOLIOS:</strong><br>
                                {{ $inventario->folio }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>FUENTE DE LOS RECURSOS:</strong><br>
                                {{ $inventario->fuente->detfuente }}
                            </address>
                        </div>


                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>FRECUENCIA DE CONSULTA:</strong><br>
                                {{ $inventario->tipoprioridade->detprioridad }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>NOTAS:</strong><br>
                                {{ $inventario->nota }}
                            </address>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                    <table class="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th>CODIGO UNSPSC:</th>
                                <th>Producto</th>
                                @can('retirar_producto')
                                <th>Acciones</th>
                                @endcan 
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($planadquisicione->productos as $producto)
                                <tr>
                                    <td scope="row">{{$producto->id}}</td>
                                    <td>{{$producto->detproducto}}</td>
                                    @can('retirar_producto')
                                    <td>
                                             <a href="{{route('retirar_producto', [$planadquisicione,$producto])}}" class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                    @endcan 
                                </tr>
                                @endforeach
                                
                            </tbody>
                    </table>
                </div>
            </div> --}}
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="row">
                    <div class="col-12 mb-2">
                        <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
                        <a href="{{ route('planadquisiciones.index') }}" class="btn btn-success">Finalizar</a>


                        {{-- @can('agregar_producto')
            <a class="btn btn-primary float-right" href="{{route('agregar_producto', $planadquisicione)}}">
                 Agregar producto
             </a>
            @endcan  --}}

                    </div>

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
        function RefrescaProducto() {
            var ip = [];
            var i = 0;
            $('#guardar').attr('disabled', 'disabled'); //Deshabilito el Boton Guardar
            $('.iProduct').each(function(index, element) {
                i++;
                ip.push({
                    id_pro: $(this).val()
                });
            });
            // Si la lista de Productos no es vacia Habilito el Boton Guardar
            if (i > 0) {
                $('#guardar').removeAttr('disabled', 'disabled');
            }
            var ipt = JSON.stringify(ip); //Convierto la Lista de Productos a un JSON para procesarlo en tu controlador
            $('#ListaPro').val(encodeURIComponent(ipt));
        }

        function agregarProducto() {

            // var sel = $('#pro_id').find(':selected').val(); 
            //Capturo el Value del Producto
            // var text = $('#pro_id').find(':selected').text();
            //Capturo el Nombre del Producto- Texto dentro del Select

            var sel = $('#detproducto').find(':selected').val();
            var text = $('#detproducto').find(':selected').text();



            // var sptext = text.split();

            var newtr = '<tr class="item"  data-id="' + sel + '">';
            newtr = newtr + '<td class="iProduct" > <input type="hidden" name="producto_id[]" value="' + sel + '">' + sel +
                '</td>';
            newtr = newtr + '<td>' + text + '</td>';


            newtr = newtr +
                '<td><button type="button" class="btn btn-danger btn-xs remove-item"><i class="fa fa-times"></i></button></td></tr>';

            $('#ProSelected').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected


            RefrescaProducto(); //Refresco Productos
            limpiar();
            CierraPopup();
            $('.remove-item').off().click(function(e) {
                $(this).parent('td').parent('tr').remove(); //En accion elimino el Producto de la Tabla
                if ($('#ProSelected tr.item').length == 0)
                    $('#ProSelected .no-item').slideDown(300);
                RefrescaProducto();
            });
            $('.iProduct').off().change(function(e) {
                RefrescaProducto();
            });

            // cerrar el modal y setear los valores del modal en vacios 

        }

        function limpiar() {
            $("#medicine").val("");
            $("#detproducto").val("");
        }

        function CierraPopup() {
            $("#modal-default").modal('hide'); //ocultamos el modal

        }
    </script>
@endsection
