<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Estandar;
use App\Http\Requests\TipoSimulacion\StoreRequest;
use App\Http\Requests\TipoSimulacion\UpdateRequest;
use App\TipoSimulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TipoSimulacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoSimulacion::get();
        return view('admin.tipos.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();

        return view('admin.tipos.create', compact('estandares', 'ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $slug = Str::slug($request->detfuente);

        // Verificar si ya existe un Inventario con el mismo slug
        $counter = 1;
        while (TipoSimulacion::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->detfuente . '-' . $counter, '-');
            $counter++;
        }
        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = TipoSimulacion::max('id') + 1;

        $slugWithId = $slug . '-' . $ultimoId;

        $nombreKmz = 'Signal level.kmz'; // Nombre deseado del archivo .kmz
        $nombreKmzRadio = 'Radioelectric elements.kmz';
        $nombreKmzBest = 'Best server.kmz';
        $nombreKmzOver = 'Overlapping.kmz';
        $nombreKmzInter = 'Interference level (CI).kmz';

        $tipoemisora = TipoSimulacion::create([
            'detfuente' => $request->detfuente,
            'slug' => $slugWithId,
            'kmz' => $nombreKmz,
            'kmzRadio' => $nombreKmzRadio,
            'kmzBest' => $nombreKmzBest,
            'kmzOver' => $nombreKmzOver,
            'kmzInterferencia' => $nombreKmzInter,
            'leyendaSignal' => $request->leyendaSignal,
            'leyendaBest' => $request->leyendaBest,
            'leyendaOver' => $request->leyendaOver,
            'estandar_id' => $request->estandar_id,
            'coordenadaX' => $request->coordenadaX,
            'coordenadaY' => $request->coordenadaY
        ]);

        // Obtener el nombre de la ciudad utilizando el ID
        $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
        $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;

        // Crear la carpeta para el estándar de la ciudad utilizando el nombre ingresado
        $carpetaTipo = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $request->detfuente;
        $kmz = 'kmz';
        $css = 'css';
        $js = 'js';
        $web = 'webfonts';
        // Verificar si la carpeta no existe y luego crearla
        if (!File::exists($carpetaTipo)) {
            File::makeDirectory($carpetaTipo, 0777, true);
        }

        if (ucfirst(strtolower($request->detfuente)) == "Multicobertura" || ucfirst(strtolower($request->detfuente)) == "Interferencia") {
            File::makeDirectory($carpetaTipo . '/' . $css, 0777, true);
            File::makeDirectory($carpetaTipo . '/' . $js, 0777, true);
            File::makeDirectory($carpetaTipo . '/' . $web, 0777, true);
            File::makeDirectory($carpetaTipo . '/' . $kmz, 0777, true);

            // Rutas de origen y destino para los directorios que deseas copiar
            $rutaCss = public_path('/adminlte/ExtensionesMapas/css');
            $rutaJs = public_path('/adminlte/ExtensionesMapas/js');
            $rutaWebFonts = public_path('/adminlte/ExtensionesMapas/webfonts');
            $rutaDestinoCss = $carpetaTipo . '/' . $css; // La carpeta de destino que ya has creado
            $rutaDestinoJs = $carpetaTipo . '/' . $js; // La carpeta de destino que ya has creado
            $rutaDestinoWeb = $carpetaTipo . '/' . $web; // La carpeta de destino que ya has creado
            $rutaDestinoKmz = $carpetaTipo . '/' . $kmz; // La carpeta de destino que ya has creado

            // Copiar los directorios y su contenido
            File::copyDirectory($rutaCss, $rutaDestinoCss);
            File::copyDirectory($rutaJs, $rutaDestinoJs);
            File::copyDirectory($rutaWebFonts, $rutaDestinoWeb);
        }



        // Mover el archivo .kmz a la carpeta de destino
        // $input = $request->all();
        if (ucfirst(strtolower($request->detfuente)) == "Multicobertura") {
            if ($request->hasFile('kmz', 'kmzRadio', 'kmzBest', 'kmzOver')) {
                $file = $request->file('kmz');
                $fileRadio = $request->file('kmzRadio');
                $fileBest = $request->file('kmzBest');
                $fileOver = $request->file('kmzOver');
                // Mover el archivo .kmz a la ubicación de destino
                $file->move($rutaDestinoKmz, $nombreKmz);
                $fileRadio->move($rutaDestinoKmz, $nombreKmzRadio);
                $fileBest->move($rutaDestinoKmz, $nombreKmzBest);
                $fileOver->move($rutaDestinoKmz, $nombreKmzOver);
                // Guardar solo el nombre del archivo en la base de datos
                $tipoemisora->kmz = $nombreKmz;
                $tipoemisora->kmzRadio = $nombreKmzRadio;
                $tipoemisora->kmzBest = $nombreKmzBest;
                $tipoemisora->kmzOver = $nombreKmzOver;
                $tipoemisora->save();
            }
        }
        if (ucfirst(strtolower($request->detfuente)) == "Interferencia") {
            if ($request->hasFile('kmzRadio', 'kmzInterferencia')) {
                $fileRadio = $request->file('kmzRadio');
                $fileInter = $request->file('kmzInterferencia');
                // Mover el archivo .kmz a la ubicación de destino
                $fileRadio->move($rutaDestinoKmz, $nombreKmzRadio);
                $fileInter->move($rutaDestinoKmz, $nombreKmzInter);
                // Guardar solo el nombre del archivo en la base de datos
                $tipoemisora->kmzRadio = $nombreKmzRadio;
                $tipoemisora->kmzInterferencia = $nombreKmzInter;
                $tipoemisora->save();
            }
        }

        if (ucfirst(strtolower($request->detfuente)) == "Multicobertura" || ucfirst(strtolower($request->detfuente)) == "Interferencia") {
            // Crear el archivo index.html dentro de la carpeta de la emisora
            $contenidoIndex = '<!doctype html>
         <html lang="en">

         <head>
             <meta charset="utf-8">
             <meta http-equiv="X-UA-Compatible" content="IE=edge">
             <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
             <meta name="mobile-web-app-capable" content="yes">
             <meta name="apple-mobile-web-app-capable" content="yes">
             <link rel="stylesheet" href="css/leaflet.css">
             <link rel="stylesheet" href="css/qgis2web.css">
             <link rel="stylesheet" href="css/fontawesome-all.min.css">
             <!-- Leaflet (JS/CSS) -->
             <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
             <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
             <!-- Leaflet-KMZ -->
             <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
             <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
             <style>
                 html,
                 body,
                 #map {
                     height: 100vh;
                     margin: 0;
                     padding: 0;
                     z-index: 0;
                 }

                 .legend {
                     background-color: #ffffff73;
                     padding: 10px;
                     color: black;
                     border: 1px solid #ccc;
                     border-radius: 5px;
                     max-height: 270px;
                     overflow-y: auto;
                 }

                 @media only screen and (max-width: 600px) {
                     .legend {
                         max-height: 250px;
                         max-width: 130px;
                         overflow-y: auto;
                     }
                 }
             </style>
         </head>

         <body>
             <div id="map">
             </div>
             <script src="js/qgis2web_expressions.js"></script>
             <script src="js/leaflet.rotatedMarker.js"></script>
             <script src="js/leaflet.pattern.js"></script>
             <script src="js/leaflet-hash.js"></script>
             <script src="js/Autolinker.min.js"></script>
             <script src="js/rbush.min.js"></script>
             <script src="js/labelgun.min.js"></script>
             <script src="js/labels.js"></script>
             <script>
                 var map = L.map(\'map\', {
                     zoomControl: true, maxZoom: 11, minZoom: 1
                 }).fitBounds([[' . $request->coordenadaX . ', ' . $request->coordenadaY . '], [' . $request->coordenadaX . ', ' . $request->coordenadaY . ']]);
                 var hash = new L.Hash(map);
                 map.attributionControl.setPrefix(\'<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>\');
                 var autolinker = new Autolinker({ truncate: { length: 30, location: \'smart\' } });
                 var bounds_group = new L.featureGroup([]);
                 function setBounds() {
                 }
                 map.createPane(\'pane_GoogleHybrid_0\');
                 map.getPane(\'pane_GoogleHybrid_0\').style.zIndex = 0;
                 var layer_GoogleHybrid_0 = L.tileLayer(\'https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}\', {
                     pane: \'pane_GoogleHybrid_0\',
                     opacity: 1.0,
                     attribution: \'<a href="https://www.google.at/permissions/geoguidelines/attr-guide.html">Map data ©2015 Google</a>\',
                     minZoom: 1,
                     maxZoom: 28,
                     minNativeZoom: 0,
                     maxNativeZoom: 20
                 });
                 layer_GoogleHybrid_0;
                 map.addLayer(layer_GoogleHybrid_0);
                 var control = L.control.layers(null, null, { collapsed: true }).addTo(map);

                 // Objeto para rastrear las capas cargadas
                 var loadedLayers = {};

                 // Función para cargar KMZ y agregar al control de capas con nombre personalizado
                 function loadKmz(url, layerName) {
                     // Verificar si la capa ya está cargada
                     if (!loadedLayers[layerName]) {
                         // Crear nueva capa Leaflet para el KMZ
                         var kmzLayer = L.kmzLayer().addTo(map);

                         // Cargar el KMZ
                         kmzLayer.load(url);

                         // Escuchar el evento \'load\' de la capa KMZ
                         kmzLayer.on(\'load\', function (e) {
                             // Agregar la capa al control de capas con el nombre personalizado
                             control.addOverlay(e.layer, layerName);
                         });

                         // Marcar la capa como cargada
                         loadedLayers[layerName] = kmzLayer;
                     }
                 }
                 // Condicional para cargar los KMZ según el tipo de fuente
        ';

            // Condiciones para cada tipo de fuente
            if (ucfirst(strtolower($request->detfuente)) == "Interferencia") {
                $contenidoIndex .= '
        loadKmz(\'kmz/Radioelectric elements.kmz\', \'Elementos de Radio\');
        loadKmz(\'kmz/Interference level (CI).kmz\', \'Nivel de Interferencia\');
    ';
            } elseif (ucfirst(strtolower($request->detfuente)) == "Multicobertura") {
                $contenidoIndex .= '
        loadKmz(\'kmz/Radioelectric elements.kmz\', \'Elementos de Radio\');
        loadKmz(\'kmz/Signal level.kmz\', \'Nivel de Señal\');
        loadKmz(\'kmz/Best server.kmz\', \'Mejor Servidor\');
        loadKmz(\'kmz/Overlapping.kmz\', \'Solapamiento\');
    ';
            }
            $contenidoIndex .= 'var legends = {
                     signalLevel:
                         \'' . $request->leyendaSignal . '\',

                     bestServer:
                        \'' . $request->leyendaBest . '\',
         
                     overlapping:
                         \'' . $request->leyendaOver . '\',
                 };

                 // Objeto para rastrear los controles de leyenda creados
                 var legendControls = {};

                 function addLegend(map, legendHTML, title, position) {
                     var legendControl = L.control({ position: position });
                     legendControl = L.control.layers(null, null, { collapsed: true }).addTo(map);

                     legendControl.onAdd = function (map) {
                         var div = L.DomUtil.create(\'div\', \'legend\');
                         div.innerHTML = \'<h4>\' + title + \'</h4>\' + legendHTML;
                         return div;
                     };

                     legendControl.addTo(map);
                     return legendControl;
                 }
                 ';
            // Condiciones para cada tipo de fuente
            if (ucfirst(strtolower($request->detfuente)) == "Interferencia") {
                $contenidoIndex .= '
            addLegend(map, legends.signalLevel, \'Nivel de Interferencia\', \'bottomright\');
    ';
            } elseif (ucfirst(strtolower($request->detfuente)) == "Multicobertura") {
                $contenidoIndex .= '
            addLegend(map, legends.signalLevel, \'Nivel de Señal\', \'bottomright\');
            addLegend(map, legends.overlapping, \'Solapamiento\', \'bottomright\');
            addLegend(map, legends.bestServer, \'Mejor Servidor\', \'bottomright\');
    ';
            }
            $contenidoIndex .= 'setBounds();
        </script>
        </body>
        </html>';


            file_put_contents($carpetaTipo . '/index.html', $contenidoIndex);
        }

        return redirect()->route('admin.tipos.index')->with('flash', 'registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TipoSimulacion $tipo)
    {
        return view('admin.tipos.show', compact('tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoSimulacion $tipo, $slug)
    {
        $tipo = TipoSimulacion::where('slug', $slug)->firstOrFail();
        $ciudades = Ciudad::get();
        $estandares = Estandar::where('ciudad_id', $tipo->estandar->ciudad_id)->get();


        return view('admin.tipos.edit', compact('estandares', 'ciudades',  'tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, TipoSimulacion $tipo, $slug)
    {

        // $tipo = TipoSimulacion::where('slug', $slug)->firstOrFail();
        $tipo = $tipo->where('slug', $slug)->firstOrFail();
        $ciudades = Ciudad::get();
        $estandares = Estandar::where('ciudad_id', $tipo->estandar->ciudad_id)->get();
        $oldTipoEmisoraName = $tipo->detfuente;


        $slug = Str::slug($request->detfuente);

        // Verificar si el nuevo slug ya existe para otro registro
        $counter = 1;
        while (TipoSimulacion::where('slug', $slug)->where('id', '<>', $tipo->id)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = TipoSimulacion::max('id');

        $slugWithId = $slug . '-' . $ultimoId;


        $nombreKmz = 'Signal level.kmz'; // Nombre deseado del archivo .kmz
        $nombreKmzRadio = 'Radioelectric elements.kmz';
        $nombreKmzBest = 'Best server.kmz';
        $nombreKmzOver = 'Overlapping.kmz';
        $nombreKmzInter = 'Interference level (CI).kmz';


        $tipoemisora = $tipo->update([
            'detfuente' => $request->detfuente,
            'slug' => $slugWithId,
            'kmz' => $nombreKmz,
            'kmzRadio' => $nombreKmzRadio,
            'kmzBest' => $nombreKmzBest,
            'kmzOver' => $nombreKmzOver,
            'kmzInterferencia' => $nombreKmzInter,
            'leyendaSignal' => $request->leyendaSignal,
            'leyendaBest' => $request->leyendaBest,
            'leyendaOver' => $request->leyendaOver,
            'estandar_id' => $request->estandar_id,
            'coordenadaX' => $request->coordenadaX,
            'coordenadaY' => $request->coordenadaY
        ]);

        // dd($oldTipoEmisoraName);

        // Verificar si el nombre del estándar ha cambiado
        if ($oldTipoEmisoraName !== $request->detfuente) {
            // Obtener el nombre de la ciudad utilizando el ID
            $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
            $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;

            // Renombrar la carpeta del estándar
            $oldFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $oldTipoEmisoraName;
            $newFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $request->detfuente;

            if (File::exists($oldFolderPath)) {
                // sleep(1); // Espera 5 segundos
                File::move($oldFolderPath, $newFolderPath);
            }
            $css = 'css';
            $js = 'js';
            $web = 'webfonts';
            $kmz = 'kmz';

            if (ucfirst(strtolower($request->detfuente)) != "Multicobertura" || ucfirst(strtolower($request->detfuente)) != "Interferencia") {
                File::deleteDirectory($newFolderPath . '/' . $css);
                File::deleteDirectory($newFolderPath . '/' . $js);
                File::deleteDirectory($newFolderPath . '/' . $web);
                File::deleteDirectory($newFolderPath . '/' . $kmz);
            }

            if (ucfirst(strtolower($request->detfuente)) == "Multicobertura" || ucfirst(strtolower($request->detfuente)) == "Interferencia") {

                File::makeDirectory($newFolderPath . '/' . $css, 0777, true);
                File::makeDirectory($newFolderPath . '/' . $js, 0777, true);
                File::makeDirectory($newFolderPath . '/' . $web, 0777, true);
                File::makeDirectory($newFolderPath . '/' . $kmz, 0777, true);

                // Rutas de origen y destino para los directorios que deseas copiar
                $rutaCss = public_path('/adminlte/ExtensionesMapas/css');
                $rutaJs = public_path('/adminlte/ExtensionesMapas/js');
                $rutaWebFonts = public_path('/adminlte/ExtensionesMapas/webfonts');
                $rutaDestinoCss = $newFolderPath . '/' . $css; // La carpeta de destino que ya has creado
                $rutaDestinoJs = $newFolderPath . '/' . $js; // La carpeta de destino que ya has creado
                $rutaDestinoWeb = $newFolderPath . '/' . $web; // La carpeta de destino que ya has creado
                $rutaDestinoKmz = $newFolderPath . '/' . $kmz; // La carpeta de destino que ya has creado

                // Copiar los directorios y su contenido
                File::copyDirectory($rutaCss, $rutaDestinoCss);
                File::copyDirectory($rutaJs, $rutaDestinoJs);
                File::copyDirectory($rutaWebFonts, $rutaDestinoWeb);
            }


            // Mover el archivo .kmz a la carpeta de destino
            // $input = $request->all();
            if (ucfirst(strtolower($request->detfuente)) == "Multicobertura") {
                if ($request->hasFile('kmz', 'kmzRadio', 'kmzBest', 'kmzOver')) {
                    $file = $request->file('kmz');
                    $fileRadio = $request->file('kmzRadio');
                    $fileBest = $request->file('kmzBest');
                    $fileOver = $request->file('kmzOver');
                    // Mover el archivo .kmz a la ubicación de destino
                    $file->move($rutaDestinoKmz, $nombreKmz);
                    $fileRadio->move($rutaDestinoKmz, $nombreKmzRadio);
                    $fileBest->move($rutaDestinoKmz, $nombreKmzBest);
                    $fileOver->move($rutaDestinoKmz, $nombreKmzOver);
                    // Guardar solo el nombre del archivo en la base de datos
                    $tipoemisora->kmz = $nombreKmz;
                    $tipoemisora->kmzRadio = $nombreKmzRadio;
                    $tipoemisora->kmzBest = $nombreKmzBest;
                    $tipoemisora->kmzOver = $nombreKmzOver;
                    $tipoemisora->save();
                }
            }
            if (ucfirst(strtolower($request->detfuente)) == "Interferencia") {
                if ($request->hasFile('kmzRadio', 'kmzInterferencia')) {
                    $fileRadio = $request->file('kmzRadio');
                    $fileInter = $request->file('kmzInterferencia');
                    // Mover el archivo .kmz a la ubicación de destino
                    $fileRadio->move($rutaDestinoKmz, $nombreKmzRadio);
                    $fileInter->move($rutaDestinoKmz, $nombreKmzInter);
                    // Guardar solo el nombre del archivo en la base de datos
                    $tipoemisora->kmzRadio = $nombreKmzRadio;
                    $tipoemisora->kmzInterferencia = $nombreKmzInter;
                    $tipoemisora->save();
                }
            }
        }
        // Obtener el nombre de la ciudad utilizando el ID
        $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
        $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;

        $newFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $request->detfuente;
        // Crear el archivo index.html dentro de la carpeta de la emisora
        $contenidoIndex = '<!doctype html>
         <html lang="en">

         <head>
             <meta charset="utf-8">
             <meta http-equiv="X-UA-Compatible" content="IE=edge">
             <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
             <meta name="mobile-web-app-capable" content="yes">
             <meta name="apple-mobile-web-app-capable" content="yes">
             <link rel="stylesheet" href="css/leaflet.css">
             <link rel="stylesheet" href="css/qgis2web.css">
             <link rel="stylesheet" href="css/fontawesome-all.min.css">
             <!-- Leaflet (JS/CSS) -->
             <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
             <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
             <!-- Leaflet-KMZ -->
             <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
             <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
             <style>
                 html,
                 body,
                 #map {
                     height: 100vh;
                     margin: 0;
                     padding: 0;
                     z-index: 0;
                 }

                 .legend {
                     background-color: #ffffff73;
                     padding: 10px;
                     color: black;
                     border: 1px solid #ccc;
                     border-radius: 5px;
                     max-height: 270px;
                     overflow-y: auto;
                 }

                 @media only screen and (max-width: 600px) {
                     .legend {
                         max-height: 250px;
                         max-width: 130px;
                         overflow-y: auto;
                     }
                 }
             </style>
         </head>

         <body>
             <div id="map">
             </div>
             <script src="js/qgis2web_expressions.js"></script>
             <script src="js/leaflet.rotatedMarker.js"></script>
             <script src="js/leaflet.pattern.js"></script>
             <script src="js/leaflet-hash.js"></script>
             <script src="js/Autolinker.min.js"></script>
             <script src="js/rbush.min.js"></script>
             <script src="js/labelgun.min.js"></script>
             <script src="js/labels.js"></script>
             <script>
                 var map = L.map(\'map\', {
                     zoomControl: true, maxZoom: 11, minZoom: 1
                 }).fitBounds([[' . $request->coordenadaX . ', ' . $request->coordenadaY . '], [' . $request->coordenadaX . ', ' . $request->coordenadaY . ']]);
                 var hash = new L.Hash(map);
                 map.attributionControl.setPrefix(\'<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>\');
                 var autolinker = new Autolinker({ truncate: { length: 30, location: \'smart\' } });
                 var bounds_group = new L.featureGroup([]);
                 function setBounds() {
                 }
                 map.createPane(\'pane_GoogleHybrid_0\');
                 map.getPane(\'pane_GoogleHybrid_0\').style.zIndex = 0;
                 var layer_GoogleHybrid_0 = L.tileLayer(\'https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}\', {
                     pane: \'pane_GoogleHybrid_0\',
                     opacity: 1.0,
                     attribution: \'<a href="https://www.google.at/permissions/geoguidelines/attr-guide.html">Map data ©2015 Google</a>\',
                     minZoom: 1,
                     maxZoom: 28,
                     minNativeZoom: 0,
                     maxNativeZoom: 20
                 });
                 layer_GoogleHybrid_0;
                 map.addLayer(layer_GoogleHybrid_0);
                 var control = L.control.layers(null, null, { collapsed: true }).addTo(map);

                 // Objeto para rastrear las capas cargadas
                 var loadedLayers = {};

                 // Función para cargar KMZ y agregar al control de capas con nombre personalizado
                 function loadKmz(url, layerName) {
                     // Verificar si la capa ya está cargada
                     if (!loadedLayers[layerName]) {
                         // Crear nueva capa Leaflet para el KMZ
                         var kmzLayer = L.kmzLayer().addTo(map);

                         // Cargar el KMZ
                         kmzLayer.load(url);

                         // Escuchar el evento \'load\' de la capa KMZ
                         kmzLayer.on(\'load\', function (e) {
                             // Agregar la capa al control de capas con el nombre personalizado
                             control.addOverlay(e.layer, layerName);
                         });

                         // Marcar la capa como cargada
                         loadedLayers[layerName] = kmzLayer;
                     }
                 }
                 // Condicional para cargar los KMZ según el tipo de fuente
        ';

        // Condiciones para cada tipo de fuente
        if (ucfirst(strtolower($request->detfuente)) == "Interferencia") {
            $contenidoIndex .= '
        loadKmz(\'kmz/Radioelectric elements.kmz\', \'Elementos de Radio\');
        loadKmz(\'kmz/Interference level (CI).kmz\', \'Nivel de Interferencia\');
    ';
        } elseif (ucfirst(strtolower($request->detfuente)) == "Multicobertura") {
            $contenidoIndex .= '
        loadKmz(\'kmz/Radioelectric elements.kmz\', \'Elementos de Radio\');
        loadKmz(\'kmz/Signal level.kmz\', \'Nivel de Señal\');
        loadKmz(\'kmz/Best server.kmz\', \'Mejor Servidor\');
        loadKmz(\'kmz/Overlapping.kmz\', \'Solapamiento\');
    ';
        }
        $contenidoIndex .= 'var legends = {
                     signalLevel:
                         \'' . $request->leyendaSignal . '\',

                     bestServer:
                        \'' . $request->leyendaBest . '\',
         
                     overlapping:
                         \'' . $request->leyendaOver . '\',
                 };

                 // Objeto para rastrear los controles de leyenda creados
                 var legendControls = {};

                 function addLegend(map, legendHTML, title, position) {
                     var legendControl = L.control({ position: position });
                     legendControl = L.control.layers(null, null, { collapsed: true }).addTo(map);

                     legendControl.onAdd = function (map) {
                         var div = L.DomUtil.create(\'div\', \'legend\');
                         div.innerHTML = \'<h4>\' + title + \'</h4>\' + legendHTML;
                         return div;
                     };

                     legendControl.addTo(map);
                     return legendControl;
                 }
                 ';
        // Condiciones para cada tipo de fuente
        if (ucfirst(strtolower($request->detfuente)) == "Interferencia") {
            $contenidoIndex .= '
            addLegend(map, legends.signalLevel, \'Nivel de Interferencia\', \'bottomright\');
    ';
        } elseif (ucfirst(strtolower($request->detfuente)) == "Multicobertura") {
            $contenidoIndex .= '
            addLegend(map, legends.signalLevel, \'Nivel de Señal\', \'bottomright\');
            addLegend(map, legends.overlapping, \'Solapamiento\', \'bottomright\');
            addLegend(map, legends.bestServer, \'Mejor Servidor\', \'bottomright\');
    ';
        }
        $contenidoIndex .= 'setBounds();
        </script>
        </body>
        </html>';

        file_put_contents($newFolderPath . '/index.html', $contenidoIndex);

        return redirect()->route('admin.tipos.index', compact('ciudades', 'estandares', 'tipo'))->with('flash', 'actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoSimulacion $tipo)
    {
        // No es necesario buscar $request ya que $tipo ya es la instancia correcta de TipoSimulacion
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();

        // Verificar si la relación estandar es válida y si tiene una ciudad asociada
        foreach ($tipos as $tipo) {
            $nombreCiudad = $tipo->estandar->ciudad->detciudad;
            $nombreEstandar = $tipo->estandar->detestandar;
        }
        // Ruta de la carpeta asociada al estándar
        $folderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $tipo->detfuente;

        // Verificar si la carpeta existe antes de intentar eliminarla
        if (File::exists($folderPath)) {
            // Eliminar la carpeta asociada al estándar
            File::deleteDirectory($folderPath);
            // Eliminar el registro de TipoSimulacion
        }
        $tipo->delete();


        return redirect()->route('admin.tipos.index', compact('ciudades', 'estandares'))->with('flash', 'El registro fue eliminado correctamente');
    }
}
