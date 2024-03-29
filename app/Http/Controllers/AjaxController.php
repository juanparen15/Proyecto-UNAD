<?php

namespace App\Http\Controllers;

use App\Area;
use App\Clase;
use App\Estandar;
use App\Emisora;
use App\Producto;
use App\Tipoproceso;
use App\Planadquisicione;
use App\TipoSimulacion;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function obtener_estandares(Request $request)
    {
        if ($request->ajax()) {
            try {
                $estandares = Estandar::where('ciudad_id', $request->ciudad_id)->get();
                return response()->json($estandares);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    public function obtener_tipoEmisoras(Request $request)
    {

        if ($request->ajax()) {
            try {
                $tipoEmisora = TipoSimulacion::where('estandar_id', $request->estandar_id)->get();
                return response()->json($tipoEmisora);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    public function obtener_emisora(Request $request)
    {

        if ($request->ajax()) {
            try {
                $emisora = Emisora::where('tipoemisora_id', $request->tipoemisora_id)->get();
                return response()->json($emisora);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    public function obtener_codigo(Request $request)
    {
        if ($request->ajax()) {
            $area = Area::where('area_id', $request->area_id)->get();
            return response()->json($area);
        }
    }
}
