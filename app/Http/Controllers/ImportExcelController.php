<?php

namespace App\Http\Controllers;

use App\Imports\MultiplePestanasImport;
use App\Imports\PotenciaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Encabezado;
use App\EncabezadoBuca;
use App\EncabezadoCali;
use App\EncabezadoMede;
use App\Potencia;
use App\PotenciaBuca;
use App\PotenciaCali;
use App\PotenciaMede;

class ImportExcelController extends Controller
{
    public function potencia_import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new MultiplePestanasImport, $file);
        return back()->with('message', 'Importación de datos completada.');
    }
    public function potencia_delete(Request $request)
    {
        // Eliminar todos los encabezados existentes
        Encabezado::truncate();
        EncabezadoBuca::truncate();
        EncabezadoCali::truncate();
        EncabezadoMede::truncate();
        Potencia::truncate();
        PotenciaBuca::truncate();
        PotenciaCali::truncate();
        PotenciaMede::truncate();

        return back()->with('message', 'Eliminación de datos completada.');
    }
}
