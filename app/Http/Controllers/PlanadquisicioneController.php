<?php

namespace App\Http\Controllers;

use App\Planadquisicione;
use App\Area;
use App\Estandar;
use App\Fuente;
use App\Exports\PlanadquisicioneAllExport;
use App\Exports\PlanadquisicioneExport;
use App\Ciudad;
use App\Emisora;
use App\Http\Requests\Planadquisicione\StoreRequest;
use App\Http\Requests\Planadquisicione\UpdateRequest;
use App\TipoSimulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PlanadquisicioneController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth',]);
        $this->middleware('role:Admin', ['except' => ['show']]);
        $this->middleware('role:User', ['except' => ['show']]);
    }

    public function showOnlyAdmin()
    {
        $adminId = auth()->user()->id;
        $planadquisiciones = Planadquisicione::where('user_id', $adminId)->get();
        session()->put('showOnlyAdmin', true);

        return view('admin.planadquisiciones.index', compact('planadquisiciones'));
    }

    public function index()
    {

        if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Supervisor')) {
            $planadquisiciones = Planadquisicione::get();
        } else {
            $planadquisiciones = Planadquisicione::get();
        }
        return view('admin.planadquisiciones.index', compact('planadquisiciones'));
    }

    public function indexByArea($areaId)
    {
        $areas = Area::findOrFail($areaId);
        $planadquisiciones = Planadquisicione::where('area_id', $areaId)->get();

        return view('admin.planadquisiciones.index', compact('planadquisiciones', 'areas'));
    }




    public function create(Planadquisicione $inventario)
    {

        // $userArea = auth()->user()->area; // Obtener el área asociada al usuario
        // $user = auth()->user()->id;

        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        // $areas = collect([$userArea]); // Crear una colección con el área del usuario
        $tipos = TipoSimulacion::get();
        $emisoras = Emisora::get();

        return view('admin.planadquisiciones.create', compact('estandares', 'ciudades', 'tipos', 'emisoras', 'inventario'));
    }



    public function store(StoreRequest $request)
    {

        // $request->validate([
        //     'tipoemisora_id' => ['required'],
        //     // 'emisora_id' => ['required'],
        //     // 'area_id' => ['required']
        // ]);

        $slug = Str::slug($request->kmz);

        // Verificar si ya existe un Inventario con el mismo slug
        $counter = 1;
        while (Planadquisicione::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->kmz . '-' . $counter, '-');
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Planadquisicione::max('id') + 1;

        $slugWithId = $slug . '-' . $ultimoId;

        // Crear el Planadquisicione con los datos proporcionados
        $planadquisicione = Planadquisicione::create([
            'user_id' => auth()->user()->id,
            'kmz' => $request->kmz,
            'coordenadaX' => $request->coordenadaX,
            'coordenadaY' => $request->coordenadaY,
            'tipoemisora_id' => $request->tipoemisora_id,
            'slug' => $slugWithId,  // Utiliza el slug con el ID agregado
        ]);

        // Obtener el nombre de la ciudad, estándar, tipo de emisora y emisora utilizando los IDs proporcionados
        $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
        $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;
        $nombreTipoEmisora = TipoSimulacion::findOrFail($request->tipoemisora_id)->detfuente;
        $nombreEmisora = Emisora::findOrFail($request->emisora_id)->emisora;

        // Definir el nombre de la carpeta "kmz"
        $nombreCarpetaKmz = 'kmz';


        // Construir la ruta base para la carpeta de destino
        $carpetaBaseDestino = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $nombreCarpetaKmz . '/' .  $request->kmz;
        $carpetaDestino = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/';

        // Verificar si la carpeta de destino no existe y luego crearla
        if (!File::exists($carpetaBaseDestino)) {
            File::makeDirectory($carpetaBaseDestino, 0777, true);
        }


        // // Determinar la carpeta de destino dependiendo de si la emisora ya existe o no
        // if (!File::exists($nombreEmisora)) {
        //     $carpetaDestino = $carpetaBaseDestino . '/' . $nombreCarpetaKmz;
        // } else {
        //     $carpetaDestino = $carpetaBaseDestino . '/' . $nombreEmisora . '/' . $nombreCarpetaKmz;
        // }

        // Definir la ruta de destino para los directorios que deseas copiar
        $rutaCss = public_path('/adminlte/ExtensionesMapas/css');
        $rutaJs = public_path('/adminlte/ExtensionesMapas/js');
        $rutaWebFonts = public_path('/adminlte/ExtensionesMapas/webfonts');

        // Copiar los directorios y su contenido a la carpeta de destino
        File::copyDirectory($rutaCss, $carpetaDestino);
        File::copyDirectory($rutaJs, $carpetaDestino);
        File::copyDirectory($rutaWebFonts, $carpetaDestino);

        // // Mover el archivo .kmz a la carpeta de destino
        // $input = $request->all();
        // if ($request->hasFile('kmz')) {
        //     $file = $request->file('kmz');
        //     $nombreKmz = 'Signal level.kmz'; // Nombre deseado del archivo .kmz

        //     // Construir la ruta completa donde se guardará el archivo .kmz
        //     $rutaDestinoKmz = $carpetaDestino . '/' . $nombreKmz;

        //     // Mover el archivo .kmz a la ubicación de destino
        //     $file->move(public_path($rutaDestinoKmz));
        //     $input['kmz'] = $rutaDestinoKmz;
        // }


        // Actualizar el modelo Planadquisicione con los datos y la ruta del archivo .kmz actualizados
        // $planadquisicione->update($input);


        // $input = $request->all();
        // if ($request->hasFile('kmz')) {
        //     $file = $request->file('kmz');
        //     $extension = $file->getClientOriginalExtension();
        //     // $nombreKmz = time() . $file->getClientOriginalName() . $extension;
        //     $nombreKmz = 'Signal level' . $extension;
        //     $file->move(public_path($carpetaKmz), $nombreKmz);
        //     $input['kmz'] = $nombreKmz;
        // }

        // $rutaCoordenada = public_path('/adminlte/simulaciones/' . );
        // $rutaDestino = $nombreEmisora; // La carpeta de destino que ya has creado

        // Crear el archivo index.html dentro de la carpeta de la emisora
        // $contenidoIndex = '<!doctype html>
        //  <html lang="en">

        //  <head>
        //      <meta charset="utf-8">
        //      <meta http-equiv="X-UA-Compatible" content="IE=edge">
        //      <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
        //      <meta name="mobile-web-app-capable" content="yes">
        //      <meta name="apple-mobile-web-app-capable" content="yes">
        //      <link rel="stylesheet" href="css/leaflet.css">
        //      <link rel="stylesheet" href="css/qgis2web.css">
        //      <link rel="stylesheet" href="css/fontawesome-all.min.css">
        //      <!-- Leaflet (JS/CSS) -->
        //      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
        //      <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
        //      <!-- Leaflet-KMZ -->
        //      <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
        //      <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        //      <style>
        //          html,
        //          body,
        //          #map {
        //              height: 100vh;
        //              margin: 0;
        //              padding: 0;
        //              z-index: 0;
        //          }

        //          .legend {
        //              background-color: #ffffff73;
        //              padding: 10px;
        //              color: black;
        //              border: 1px solid #ccc;
        //              border-radius: 5px;
        //              max-height: 270px;
        //              overflow-y: auto;
        //          }

        //          @media only screen and (max-width: 600px) {
        //              .legend {
        //                  max-height: 250px;
        //                  max-width: 130px;
        //                  overflow-y: auto;
        //              }
        //          }
        //      </style>
        //  </head>

        //  <body>
        //      <div id="map">
        //      </div>
        //      <script src="js/qgis2web_expressions.js"></script>
        //      <script src="js/leaflet.rotatedMarker.js"></script>
        //      <script src="js/leaflet.pattern.js"></script>
        //      <script src="js/leaflet-hash.js"></script>
        //      <script src="js/Autolinker.min.js"></script>
        //      <script src="js/rbush.min.js"></script>
        //      <script src="js/labelgun.min.js"></script>
        //      <script src="js/labels.js"></script>
        //      <script>
        //          var map = L.map(\'map\', {
        //              zoomControl: true, maxZoom: 11, minZoom: 1
        //          }).fitBounds([[' . $request->coordenadaX . ', ' . $request->coordenadaY . '], [' . $request->coordenadaX . ', ' . $request->coordenadaY . ']]);
        //          var hash = new L.Hash(map);
        //          map.attributionControl.setPrefix(\'<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>\');
        //          var autolinker = new Autolinker({ truncate: { length: 30, location: \'smart\' } });
        //          var bounds_group = new L.featureGroup([]);
        //          function setBounds() {
        //          }
        //          map.createPane(\'pane_GoogleHybrid_0\');
        //          map.getPane(\'pane_GoogleHybrid_0\').style.zIndex = 0;
        //          var layer_GoogleHybrid_0 = L.tileLayer(\'https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}\', {
        //              pane: \'pane_GoogleHybrid_0\',
        //              opacity: 1.0,
        //              attribution: \'<a href="https://www.google.at/permissions/geoguidelines/attr-guide.html">Map data ©2015 Google</a>\',
        //              minZoom: 1,
        //              maxZoom: 28,
        //              minNativeZoom: 0,
        //              maxNativeZoom: 20
        //          });
        //          layer_GoogleHybrid_0;
        //          map.addLayer(layer_GoogleHybrid_0);
        //          var control = L.control.layers(null, null, { collapsed: true }).addTo(map);

        //          // Objeto para rastrear las capas cargadas
        //          var loadedLayers = {};

        //          // Función para cargar KMZ y agregar al control de capas con nombre personalizado
        //          function loadKmz(url, layerName) {
        //              // Verificar si la capa ya está cargada
        //              if (!loadedLayers[layerName]) {
        //                  // Crear nueva capa Leaflet para el KMZ
        //                  var kmzLayer = L.kmzLayer().addTo(map);

        //                  // Cargar el KMZ
        //                  kmzLayer.load(url);

        //                  // Escuchar el evento \'load\' de la capa KMZ
        //                  kmzLayer.on(\'load\', function (e) {
        //                      // Agregar la capa al control de capas con el nombre personalizado
        //                      control.addOverlay(e.layer, layerName);
        //                  });

        //                  // Marcar la capa como cargada
        //                  loadedLayers[layerName] = kmzLayer;
        //              }
        //          }

        //          // Cargar y asignar nombres a los KMZ
        //          loadKmz(\'kmz/Radioelectric elements.kmz\', \'Elementos de Radio\');
        //          loadKmz(\'kmz/Signal level.kmz\', \'Nivel de Señal\');

        //          var legends = {
        //              signalLevel:
        //                  \'<table cellpadding="0" cellspacing="0" ><tr><td><div style="border: 1px solid black; width:16px; height:9px;background-color:#ffffff;"></div></td><td><div style="margin-left: 10px;" class="info_txt04">[-∞ , -75) dBm (Sin señal)</div></td></tr><tr><td><div style="border: 1px solid black; width:16px; height:9px;background-color:#ff0000;"></div></td><td><div style="margin-left: 10px;" class="info_txt04">[-75 , -65) dBm (Señal baja)</div></td></tr><tr><td><div style="border: 1px solid black; width:16px; height:9px;background-color:#e1f622;"></div></td><td><div style="margin-left: 10px;" class="info_txt04">[-65 , -55) dBm (Señal Intermedia)</div></td></tr><tr><td><div style="border: 1px solid black; width:16px; height:9px;background-color:#009600;"></div></td><td><div style="margin-left: 10px;" class="info_txt04">[-55 , ∞) dBm (Señal excelente)</div></td></tr></table>\',
        //          };

        //          // Objeto para rastrear los controles de leyenda creados
        //          var legendControls = {};

        //          function addLegend(map, legendHTML, title, position) {
        //              var legendControl = L.control({ position: position });
        //              legendControl = L.control.layers(null, null, { collapsed: true }).addTo(map);

        //              legendControl.onAdd = function (map) {
        //                  var div = L.DomUtil.create(\'div\', \'legend\');
        //                  div.innerHTML = \'<h4>\' + title + \'</h4>\' + legendHTML;
        //                  return div;
        //              };

        //              legendControl.addTo(map);
        //              return legendControl;
        //          }

        //          // Ejemplo de llamadas a addLegend
        //          addLegend(map, legends.signalLevel, \'Nivel de Señal\', \'bottomright\');
        //          setBounds();
        //      </script>
        //  </body>

        //  </html>';

        // file_put_contents($rutaDestino . '/index.html', $contenidoIndex);

        return redirect()->route('admin.planadquisiciones.index')->with('flash', 'registrado');
    }


    // public function show(Planadquisicione $inventario)
    // {
    //     return view('admin.planadquisiciones.show', compact('inventario'));
    // }

    public function show(Planadquisicione $inventario)
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();
        $emisoras = Emisora::get();
        // $planadquisicione = Planadquisicione::with('user', 'fuentes', 'ciudades', 'estandares', 'emisoras')
        //     ->find($inventario);

        return view('admin.planadquisiciones.show', compact('estandares', 'ciudades', 'tipos', 'emisoras', 'inventario'));
    }

    public function edit(Planadquisicione $inventario)
    {
        // $userArea = $inventario->user->area; // Obtener el área asociada al usuario
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();
        $emisoras = Emisora::get();
        return view('admin.planadquisiciones.edit', compact('estandares', 'ciudades', 'tipos', 'emisoras', 'inventario'));
    }

    // public function update(Request $request, Planadquisicione $inventario)
    public function update(UpdateRequest $request, Planadquisicione $planadquisicione)

    {

        $request->validate([
            // 'kmz' => ['requerid'],
            'tipoemisora_id' => ['required'],
            // 'emisora_id' => ['required'],
        ]);

        // // Obtener los nombres de ciudad, estándar, tipo de emisora y emisora
        // $ciudad = $planadquisicione->ciudad->detciudad;
        // $estandar = $planadquisicione->fuente->estandar->detestandar;
        // $tipoEmisora = $planadquisicione->fuente->detfuente;
        // $emisora = $planadquisicione->emisora->emisora ?? 'No Aplica';

        // // Construir la ruta donde se guardará el archivo KMZ
        // if ($emisora == "No Aplica") {
        //     $filePath = "adminlte/simulaciones/{$ciudad}/{$estandar}/{$tipoEmisora}/kmz/";
        // } else {
        //     $filePath = "adminlte/simulaciones/{$ciudad}/{$estandar}/{$tipoEmisora}/{$emisora}/kmz/";
        // }


        // $input = $request->all();
        // if ($request->hasFile('kmz')) {
        //     $file = $request->file('kmz');
        //     $extension = $file->getClientOriginalExtension();
        //     $nombreKmz = time() . $file->getClientOriginalName() . $extension;
        //     $file->move(public_path() . $filePath, $nombreKmz);
        //     $input['kmz'] = $nombreKmz;
        // }

        $slug = Str::slug($request->kmz);

        // Verificar si el nuevo slug ya existe para otro registro
        $counter = 1;
        while (Planadquisicione::where('slug', $slug)->where('id', '<>', $planadquisicione->id)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Planadquisicione::max('id');

        $slugWithId = $slug . '-' . $ultimoId;
        $planadquisicione->update(array_merge($request->all(), [
            'user_id' => auth()->user()->id,
            'slug' => $slugWithId  // Utiliza el slug con el ID agregado
        ]));

        // ... (código para manejar la relación muchos a muchos si es necesario)

        return redirect()->route('admin.planadquisiciones.index')->with('flash', 'actualizado');
    }

    public function destroy(Planadquisicione $planadquisicion)
    {
        $planadquisicion->delete();
        return redirect()->route('admin.planadquisiciones.index')->with('flash', 'eliminado');
    }

    // public function retirar_producto(Planadquisicione $planadquisicione,Producto $producto){
    //     $producto_id = $producto->id;

    //     $planadquisicione->productos()->detach($producto_id);
    //     return redirect()->route('planadquisiciones.show', $planadquisicione)->with('flash','actualizado');
    // }

    public function exportar_planadquisiciones_excel(Planadquisicione $planadquisicion)
    {

        return Excel::download(new PlanadquisicioneExport($planadquisicion->id), 'Puntos de Ciudad - ' . $planadquisicion->id . '.xlsx');
        // 
        // plan_de_adquisicion 
    }
    // public function agregar_producto(Planadquisicione $planadquisicion)
    // {
    //     $segmentos = Segmento::all();
    //     return view('admin.planadquisiciones.agregar_producto', compact('planadquisicion', 'segmentos'));
    // }
    // public function agregar_producto_store(Request $request, Planadquisicione $planadquisicion)
    // {
    //     $planadquisicion->productos()->attach($request->producto_id);
    //     return redirect()->route('planadquisiciones.show', $planadquisicion)->with('flash', 'actualizado');
    // }
    public function export()
    {



        return Excel::download(new PlanadquisicioneAllExport, 'Puntos de Ciudad en General.xlsx');
    }

    // public function chart()
    // {
    //     $planadquisiciones = Planadquisicione::select(\DB::raw("COUNT(*) as count"))
    //         ->whereYear('created_at', date('Y'))
    //         ->groupBy(\DB::raw("Second(created_at)"))
    //         ->pluck('count');
    //     return view('planadquisiciones.chart', compact('planadquisiciones'));
    // }
}
