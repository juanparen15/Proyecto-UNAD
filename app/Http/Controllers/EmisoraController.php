<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Emisora;
use App\Estandar;
use Illuminate\Http\Request;
use App\Http\Requests\Emisora\StoreRequest;
use App\Http\Requests\Emisora\UpdateRequest;
use App\TipoSimulacion;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class EmisoraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }
    public function index()
    {
        // $emisoras = Emisora::get();
        $emisoras = Emisora::get();
        return view('admin.emisoras.index', compact('emisoras'));
    }


    public function create(Emisora $emisora)
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();

        return view('admin.emisoras.create', compact('estandares', 'ciudades', 'tipos', 'emisora'));
    }

    public function store(StoreRequest $request)
    {

        $slug = Str::slug($request->emisora);

        // Verificar si ya existe un Inventario con el mismo slug
        $counter = 1;
        while (Emisora::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->emisora . '-' . $counter, '-');
            $counter++;
        }
        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Emisora::max('id') + 1;

        $slugWithId = $slug . '-' . $ultimoId;

        $nombreKmzRadio = 'Radioelectric elements.kmz';
        $nombreKmz = 'Signal level.kmz'; // Nombre deseado del archivo .kmz

        $emisora = Emisora::create([
            'emisora' => $request->emisora,
            'kmzRadio' => $nombreKmzRadio,
            'kmz' => $nombreKmz,
            'leyendaSignal' => $request->leyendaSignal,
            'coordenadaX' => $request->coordenadaX,
            'coordenadaY' => $request->coordenadaY,
            'slug' => $slugWithId,
            'tipoemisora_id' => $request->tipoemisora_id
        ]);


        // Obtener el nombre de la ciudad utilizando el ID
        $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
        $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;
        $nombreTipoEmisora = TipoSimulacion::findOrFail($request->tipoemisora_id)->detfuente;

        // Crear la carpeta para el estándar de la ciudad utilizando el nombre ingresado
        $carpetaEmisora = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $request->emisora;
        $css = 'css';
        $js = 'js';
        $web = 'webfonts';
        $kmz = 'kmz';
        // Verificar si la carpeta no existe y luego crearla
        if (!File::exists($carpetaEmisora)) {
            File::makeDirectory($carpetaEmisora, 0777, true);
            File::makeDirectory($carpetaEmisora . '/' . $css, 0777, true);
            File::makeDirectory($carpetaEmisora . '/' . $js, 0777, true);
            File::makeDirectory($carpetaEmisora . '/' . $web, 0777, true);
            File::makeDirectory($carpetaEmisora . '/' . $kmz, 0777, true);

            // Rutas de origen y destino para los directorios que deseas copiar
            $rutaCss = public_path('/adminlte/ExtensionesMapas/css');
            $rutaJs = public_path('/adminlte/ExtensionesMapas/js');
            $rutaWebFonts = public_path('/adminlte/ExtensionesMapas/webfonts');
            $rutaDestinoCss = $carpetaEmisora . '/' . $css; // La carpeta de destino que ya has creado
            $rutaDestinoJs = $carpetaEmisora . '/' . $js; // La carpeta de destino que ya has creado
            $rutaDestinoWeb = $carpetaEmisora . '/' . $web; // La carpeta de destino que ya has creado
            $rutaDestinoKmz = $carpetaEmisora . '/' . $kmz; // La carpeta de destino que ya has creado

            // Copiar los directorios y su contenido
            File::copyDirectory($rutaCss, $rutaDestinoCss);
            File::copyDirectory($rutaJs, $rutaDestinoJs);
            File::copyDirectory($rutaWebFonts, $rutaDestinoWeb);
        }

        if ($request->hasFile('kmz', 'kmzRadio')) {
            $file = $request->file('kmz');
            $fileRadio = $request->file('kmzRadio');
            // Mover el archivo .kmz a la ubicación de destino
            $file->move($rutaDestinoKmz, $nombreKmz);
            $fileRadio->move($rutaDestinoKmz, $nombreKmzRadio);
            // Guardar solo el nombre del archivo en la base de datos
            $emisora->kmz = $nombreKmz;
            $emisora->kmzRadio = $nombreKmzRadio;
            $emisora->save();
        }

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
                        loadKmz(\'kmz/Radioelectric elements.kmz\', \'Elementos de Radio\');
                        loadKmz(\'kmz/Signal level.kmz\', \'Nivel de Señal\');
                        ';

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
                    
                    addLegend(map, legends.signalLevel, \'Nivel de Señal\', \'bottomright\');
                    setBounds();
                    </script>
                    </body>
                    </html>';


        file_put_contents($carpetaEmisora . '/index.html', $contenidoIndex);

        return redirect()->route('admin.emisoras.index')->with('flash', 'registrado');
    }


    public function show(Emisora $emisora)
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();

        return view('admin.emisoras.show', compact('estandares', 'ciudades', 'tipos', 'emisora'));
    }


    public function edit(Emisora $emisora)
    {

        // $emisoras = Emisora::where('slug', $slug)->firstOrFail();
        $ciudades = Ciudad::get();
        $estandares = Estandar::where('ciudad_id', $emisora->tipo->estandar->ciudad_id)->get();
        $tipos = TipoSimulacion::where('estandar_id', $emisora->tipo->estandar_id)->get();

        return view('admin.emisoras.edit', compact('ciudades', 'estandares', 'tipos', 'emisora'));
    }


    public function update(UpdateRequest $request, Emisora $emisora)
    {
        // $emisora = Emisora::where('slug', $slug)->firstOrFail();
        // $emisora = $emisora->where('slug', $slug)->firstOrFail();
        $ciudades = Ciudad::get();
        $estandares = Estandar::where('ciudad_id', $emisora->tipo->estandar->ciudad_id)->get();
        $tipos = TipoSimulacion::where('estandar_id', $emisora->tipo->estandar_id)->get();


        $slug = Str::slug($request->emisora);

        // Verificar si el nuevo slug ya existe para otro registro
        $counter = 1;
        while (Emisora::where('slug', $slug)->where('id', '<>', $emisora->id)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Emisora::max('id');

        $slugWithId = $slug . '-' . $ultimoId;

        // Guardar el nombre anterior del estándar
        $oldEmisoraName = $emisora->emisora;

        $nombreKmzRadio = 'Radioelectric elements.kmz';
        $nombreKmz = 'Signal level.kmz'; // Nombre deseado del archivo .kmz

        $emisora = $emisora->update([
            'emisora' => $request->emisora,
            'kmzRadio' => $nombreKmzRadio,
            'kmz' => $nombreKmz,
            'leyendaSignal' => $request->leyendaSignal,
            'coordenadaX' => $request->coordenadaX,
            'coordenadaY' => $request->coordenadaY,
            'slug' => $slugWithId,
            'tipoemisora_id' => $request->tipoemisora_id
        ]);

        // Verificar si el nombre del estándar ha cambiado
        if ($oldEmisoraName !== $request->emisora) {
            // Obtener el nombre de la ciudad utilizando el ID
            $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
            $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;
            $nombreTipoEmisora = TipoSimulacion::findOrFail($request->tipoemisora_id)->detfuente;

            // Renombrar la carpeta del estándar
            $oldFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $oldEmisoraName;
            $newFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $request->emisora;

            if (File::exists($oldFolderPath)) {
                File::move($oldFolderPath, $newFolderPath);
            }

            $css = 'css';
            $js = 'js';
            $web = 'webfonts';
            $kmz = 'kmz';

            // Rutas de origen y destino para los directorios que deseas copiar
            $rutaCss = public_path('/adminlte/ExtensionesMapas/css');
            $rutaJs = public_path('/adminlte/ExtensionesMapas/js');
            $rutaWebFonts = public_path('/adminlte/ExtensionesMapas/webfonts');
            $rutaDestinoCss = $newFolderPath . '/' . $css; // La carpeta de destino que ya has creado
            $rutaDestinoJs = $newFolderPath . '/' . $js; // La carpeta de destino que ya has creado
            $rutaDestinoWeb = $newFolderPath . '/' . $web; // La carpeta de destino que ya has creado
            $rutaDestinoKmz = $newFolderPath . '/' . $kmz; // La carpeta de destino que ya has creado

            if (!File::exists($rutaDestinoCss)) {
                File::makeDirectory($newFolderPath . '/' . $css, 0777, true);
                File::copyDirectory($rutaCss, $rutaDestinoCss);
            }
            if (!File::exists($rutaDestinoJs)) {
                File::makeDirectory($newFolderPath . '/' . $js, 0777, true);
                File::copyDirectory($rutaJs, $rutaDestinoJs);
            }
            if (!File::exists($rutaDestinoWeb)) {
                File::makeDirectory($newFolderPath . '/' . $web, 0777, true);
                File::copyDirectory($rutaWebFonts, $rutaDestinoWeb);
            }
            if (!File::exists($rutaDestinoKmz)) {
                File::makeDirectory($newFolderPath . '/' . $kmz, 0777, true);
            }

            if ($request->hasFile('kmz', 'kmzRadio')) {
                $file = $request->file('kmz');
                $fileRadio = $request->file('kmzRadio');
                // Mover el archivo .kmz a la ubicación de destino
                $file->move($rutaDestinoKmz, $nombreKmz);
                $fileRadio->move($rutaDestinoKmz, $nombreKmzRadio);
                // Guardar solo el nombre del archivo en la base de datos
                $emisora->kmz = $nombreKmz;
                $emisora->kmzRadio = $nombreKmzRadio;
                $emisora->save();
            }
        }
        $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
        $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;
        $nombreTipoEmisora = TipoSimulacion::findOrFail($request->tipoemisora_id)->detfuente;

        // Renombrar la carpeta del estándar
        $oldFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $oldEmisoraName;
        $newFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $request->emisora;
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
            loadKmz(\'kmz/Radioelectric elements.kmz\', \'Elementos de Radio\');
            loadKmz(\'kmz/Signal level.kmz\', \'Nivel de Señal\');
            ';

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
        
        addLegend(map, legends.signalLevel, \'Nivel de Señal\', \'bottomright\');
        setBounds();
        </script>
        </body>
        </html>';


        file_put_contents($newFolderPath . '/index.html', $contenidoIndex);

        return redirect()->route('admin.emisoras.index', compact('ciudades', 'estandares', 'tipos', 'emisora'))->with('flash', 'actualizado');
    }

    public function destroy(Emisora $emisora)
    {

        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();
        $emisoras = Emisora::get();
        // Obtener el nombre de la ciudad utilizando el ID del estándar
        foreach ($emisoras as $emisora) {
            $nombreCiudad = $emisora->tipo->estandar->ciudad->detciudad;
            $nombreEstandar = $emisora->tipo->estandar->detestandar;
            $nombreTipoEmisora = $emisora->tipo->detfuente;
        }
        // Ruta de la carpeta asociada al estándar
        $folderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $emisora->emisora;

        // Verificar si la carpeta existe antes de intentar eliminarla
        if (File::exists($folderPath)) {
            // Eliminar la carpeta asociada al estándar
            File::deleteDirectory($folderPath);
        }
        $emisora->delete();

        return redirect()->route('admin.emisoras.index', compact('ciudades', 'estandares', 'tipos'))->with('flash', 'eliminado');
    }
}
