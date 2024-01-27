<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Empresa;
use App\Potencia;
use App\User;
use App\Encabezado;
use App\EncabezadoBuca;
use App\EncabezadoCali;
use App\EncabezadoMede;
use App\PotenciaBuca;
use App\PotenciaCali;
use App\PotenciaMede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all()->count();
        $potencia = Potencia::all();
        $potenciaBuca = PotenciaBuca::all();
        $potenciaMede = PotenciaMede::all();
        $potenciaCali = PotenciaCali::all();
        $ciudades = Ciudad::all();
        $encabezados = Encabezado::pluck('encabezado')->toArray();
        $encabezadosBuca = EncabezadoBuca::pluck('encabezadoBuca')->toArray();
        $encabezadosMede = EncabezadoMede::pluck('encabezadoMede')->toArray();
        $encabezadosCali = EncabezadoCali::pluck('encabezadoCali')->toArray();

        // if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Supervisor')) {

        //POTENCIAS DE BOGOTA {
        $potencias = Potencia::select(
            'potenciaAM',
            'potenciaFM',
            'potenciaDABHibrido',
            'SNRAMHibrido',
            'SNRFMHibrido',
            'SNRDAB',
            DB::raw("SUM(potenciaAM) as pot1"),
            DB::raw("SUM(potenciaFM) as pot2"),
            DB::raw("SUM(potenciaDABHibrido) as pot3"),
            DB::raw("SUM(SNRAMHibrido) as pot4"),
            DB::raw("SUM(SNRFMHibrido) as pot5"),
            DB::raw("SUM(SNRDAB) as pot6")
        )
            ->groupBy('potenciaAM', 'potenciaFM', 'potenciaDABHibrido', 'SNRAMHibrido', 'SNRFMHibrido', 'SNRDAB')
            ->get();

        $promPotencias = Potencia::select(
            'potenciaAM',
            'potenciaFM',
            'potenciaDABHibrido',
            'SNRAMHibrido',
            'SNRFMHibrido',
            'SNRDAB',
            DB::raw("AVG(potenciaAM) as promedioPot1"),
            DB::raw("AVG(potenciaFM) as promedioPot2"),
            DB::raw("AVG(potenciaDABHibrido) as promedioPot3"),
            DB::raw("AVG(SNRAMHibrido) as promedioPot4"),
            DB::raw("AVG(SNRFMHibrido) as promedioPot5"),
            DB::raw("AVG(SNRDAB) as promedioPot6")
        )
            ->groupBy('potenciaAM', 'potenciaFM', 'potenciaDABHibrido', 'SNRAMHibrido', 'SNRFMHibrido', 'SNRDAB')
            ->havingRaw('AVG(potenciaAM) <= 200')
            ->havingRaw('AVG(potenciaFM) <= 200')
            ->havingRaw('AVG(potenciaDABHibrido) <= 200')
            ->havingRaw('AVG(SNRAMHibrido) <= 200')
            ->havingRaw('AVG(SNRFMHibrido) <= 200')
            ->havingRaw('AVG(SNRDAB) <= 200')
            ->get();
        // }

        //POTENCIAS DE BUCARAMANGA {
        $potenciasBuca = PotenciaBuca::select(
            'potenciaAM',
            'potenciaFM',
            'potenciaDABHibrido',
            'SNRAMHibrido',
            'SNRFMHibrido',
            'SNRDAB',
            DB::raw("SUM(potenciaAM) as pot1"),
            DB::raw("SUM(potenciaFM) as pot2"),
            DB::raw("SUM(potenciaDABHibrido) as pot3"),
            DB::raw("SUM(SNRAMHibrido) as pot4"),
            DB::raw("SUM(SNRFMHibrido) as pot5"),
            DB::raw("SUM(SNRDAB) as pot6")
        )
            ->groupBy('potenciaAM', 'potenciaFM', 'potenciaDABHibrido', 'SNRAMHibrido', 'SNRFMHibrido', 'SNRDAB')
            ->get();


            $promPotenciasBuca = PotenciaBuca::select(
                'potenciaAM',
                'potenciaFM',
                'potenciaDABHibrido',
                'SNRAMHibrido',
                'SNRFMHibrido',
                'SNRDAB',
                DB::raw("AVG(potenciaAM) as promedioBucaPot1"),
                DB::raw("AVG(potenciaFM) as promedioBucaPot2"),
                DB::raw("AVG(potenciaDABHibrido) as promedioBucaPot3"),
                DB::raw("AVG(SNRAMHibrido) as promedioBucaPot4"),
                DB::raw("AVG(SNRFMHibrido) as promedioBucaPot5"),
                DB::raw("AVG(SNRDAB) as promedioBucaPot6")
            )
                ->groupBy('potenciaAM', 'potenciaFM', 'potenciaDABHibrido', 'SNRAMHibrido', 'SNRFMHibrido', 'SNRDAB')
                ->havingRaw('AVG(potenciaAM) <= 200')
                ->havingRaw('AVG(potenciaFM) <= 200')
                ->havingRaw('AVG(potenciaDABHibrido) <= 200')
                ->havingRaw('AVG(SNRAMHibrido) <= 200')
                ->havingRaw('AVG(SNRFMHibrido) <= 200')
                ->havingRaw('AVG(SNRDAB) <= 200')
                ->get();
        // }
        //POTENCIAS DE CALI {



            $potenciasCali = PotenciaCali::select(
                'potenciaAM',
                'potenciaFM',
                'potenciaDABHibrido',
                'SNRAMHibrido',
                'SNRFMHibrido',
                'SNRDAB',
                DB::raw("SUM(potenciaAM) as pot1"),
                DB::raw("SUM(potenciaFM) as pot2"),
                DB::raw("SUM(potenciaDABHibrido) as pot3"),
                DB::raw("SUM(SNRAMHibrido) as pot4"),
                DB::raw("SUM(SNRFMHibrido) as pot5"),
                DB::raw("SUM(SNRDAB) as pot6")
            )
                ->groupBy('potenciaAM', 'potenciaFM', 'potenciaDABHibrido', 'SNRAMHibrido', 'SNRFMHibrido', 'SNRDAB')
                ->get();
    
    
                $promPotenciasCali = PotenciaCali::select(
                    'potenciaAM',
                    'potenciaFM',
                    'potenciaDABHibrido',
                    'SNRAMHibrido',
                    'SNRFMHibrido',
                    'SNRDAB',
                    DB::raw("AVG(potenciaAM) as promedioCaliPot1"),
                    DB::raw("AVG(potenciaFM) as promedioCaliPot2"),
                    DB::raw("AVG(potenciaDABHibrido) as promedioCaliPot3"),
                    DB::raw("AVG(SNRAMHibrido) as promedioCaliPot4"),
                    DB::raw("AVG(SNRFMHibrido) as promedioCaliPot5"),
                    DB::raw("AVG(SNRDAB) as promedioCaliPot6")
                )
                    ->groupBy('potenciaAM', 'potenciaFM', 'potenciaDABHibrido', 'SNRAMHibrido', 'SNRFMHibrido', 'SNRDAB')
                    ->havingRaw('AVG(potenciaAM) <= 200')
                    ->havingRaw('AVG(potenciaFM) <= 200')
                    ->havingRaw('AVG(potenciaDABHibrido) <= 200')
                    ->havingRaw('AVG(SNRAMHibrido) <= 200')
                    ->havingRaw('AVG(SNRFMHibrido) <= 200')
                    ->havingRaw('AVG(SNRDAB) <= 200')
                    ->get();
        // }
        //POTENCIAS DE MEDELLIN {
            $potenciasMede = PotenciaMede::select(
                'potenciaAM',
                'potenciaFM',
                'potenciaDABHibrido',
                'SNRAMHibrido',
                'SNRFMHibrido',
                'SNRDAB',
                DB::raw("SUM(potenciaAM) as pot1"),
                DB::raw("SUM(potenciaFM) as pot2"),
                DB::raw("SUM(potenciaDABHibrido) as pot3"),
                DB::raw("SUM(SNRAMHibrido) as pot4"),
                DB::raw("SUM(SNRFMHibrido) as pot5"),
                DB::raw("SUM(SNRDAB) as pot6")
            )
                ->groupBy('potenciaAM', 'potenciaFM', 'potenciaDABHibrido', 'SNRAMHibrido', 'SNRFMHibrido', 'SNRDAB')
                ->get();
    
    
                $promPotenciasMede = PotenciaMede::select(
                    'potenciaAM',
                    'potenciaFM',
                    'potenciaDABHibrido',
                    'SNRAMHibrido',
                    'SNRFMHibrido',
                    'SNRDAB',
                    DB::raw("AVG(potenciaAM) as promedioMedePot1"),
                    DB::raw("AVG(potenciaFM) as promedioMedePot2"),
                    DB::raw("AVG(potenciaDABHibrido) as promedioMedePot3"),
                    DB::raw("AVG(SNRAMHibrido) as promedioMedePot4"),
                    DB::raw("AVG(SNRFMHibrido) as promedioMedePot5"),
                    DB::raw("AVG(SNRDAB) as promedioMedePot6")
                )
                    ->groupBy('potenciaAM', 'potenciaFM', 'potenciaDABHibrido', 'SNRAMHibrido', 'SNRFMHibrido', 'SNRDAB')
                    ->havingRaw('AVG(potenciaAM) <= 200')
                    ->havingRaw('AVG(potenciaFM) <= 200')
                    ->havingRaw('AVG(potenciaDABHibrido) <= 200')
                    ->havingRaw('AVG(SNRAMHibrido) <= 200')
                    ->havingRaw('AVG(SNRFMHibrido) <= 200')
                    ->havingRaw('AVG(SNRDAB) <= 200')
                    ->get();
        // }



        // Filtrar los datos para que no excedan un límite superior
        // $filteredPotencias = $promPotencias->map(function ($promedioPot) {
        //     return [
        //         'potenciaAM' => $promedioPot->potenciaAM,
        //         'promedioPot2' => ($promedioPot->promedioPot2 <= 200) ? $promedioPot->promedioPot2 : 200,  // Establece tu límite aquí
        //     ];
        // });

        // $potencias2 = Potencia::select(
        //     'segundaPotencia',
        //     DB::raw("SUM(segundaPotencia) as pot2"),
        // )->groupBy('segundaPotencia')->get();

        // $potenciasData2 = [];
        // foreach ($potencias2 as $segundaPotencia) {
        //     $potenciasData2[] = ['name' => $segundaPotencia->segundaPotencia, 'y' => $segundaPotencia->pot2];
        // }
        // $potencias3 = Potencia::select(
        //     'terceraPotencia',
        //     DB::raw("SUM(terceraPotencia) as pot3"),
        // )->groupBy('terceraPotencia')->get();

        // $potenciasData3 = [];
        // foreach ($potencias3 as $terceraPotencia) {
        //     $potenciasData3[] = ['name' => $terceraPotencia->terceraPotencia, 'y' => $terceraPotencia->pot3];
        // }
        // $potencias4 = Potencia::select(
        //     'cuartaPotencia',
        //     DB::raw("SUM(cuartaPotencia) as pot4"),
        // )->groupBy('cuartaPotencia')->get();

        // $potenciasData4 = [];
        // foreach ($potencias4 as $cuartaPotencia) {
        //     $potenciasData4[] = ['name' => $cuartaPotencia->cuartaPotencia, 'y' => $cuartaPotencia->pot4];
        // }

        // Asegúrate de tener al menos tantos elementos como se esperan en tu vista
        while (count($encabezados) < 19) {
            $encabezados[] = 'Título Desconocido';
        }

        return view("estadistica", compact('users', 'potencias', 'potenciasBuca', 'potenciasCali', 'potenciasMede', 'promPotenciasBuca', 'promPotenciasCali', 'promPotenciasMede', 'promPotencias', 'encabezados', 'ciudades'));
    }
}
