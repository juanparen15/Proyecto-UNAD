<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SimulacionController extends Controller
{
    public function index($city, $standard, $type)
    {
        // Ruta al archivo index.html en la carpeta public/simulaciones
        $filePath = public_path("/{$city}/{$standard}/{$type}/index.html");

        // Verificar si el archivo existe
        if (File::exists($filePath)) {
            // Devolver el contenido del archivo como respuesta
            return response(File::get($filePath), 200)
                ->header('Content-Type', 'text/html');
        } 
        else {
            // Si el archivo no existe, devolver una respuesta 404
            return response('Archivo no encontrado', 404);
        }
    }
}
