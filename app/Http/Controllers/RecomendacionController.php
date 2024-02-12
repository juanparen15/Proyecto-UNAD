<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Encabezado;
use App\EncabezadoBuca;
use App\EncabezadoCali;
use App\EncabezadoMede;
use App\Potencia;
use App\PotenciaBuca;
use App\PotenciaCali;
use App\PotenciaMede;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecomendacionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        // Obtén el valor de recoPotencia de tu solicitud (request)
        $recoPotencia = $request->input('recoPotencia', 0); // Si no hay ningún valor proporcionado, establece el valor predeterminado en 0

        $promPotencias = Potencia::select(
            'potenciaAM',
            'potenciaFM',
            'potenciaDABHibrido',
            'SNRAMHibrido',
            'SNRFMHibrido',
            'SNRDAB',
            DB::raw("SUM(potenciaAM) as promedioPot1"),
            DB::raw("SUM(potenciaFM) as promedioPot2"),
            DB::raw("SUM(potenciaDABHibrido) as promedioPot3"),
            DB::raw("SUM(SNRAMHibrido) as promedioPot4"),
            DB::raw("SUM(SNRFMHibrido) as promedioPot5"),
            DB::raw("SUM(SNRDAB) as promedioPot6")
        )
            ->groupBy('potenciaAM')
            ->groupBy('potenciaFM')
            ->groupBy('potenciaDABHibrido')
            ->groupBy('SNRAMHibrido')
            ->groupBy('SNRFMHibrido')
            ->groupBy('SNRDAB')
            ->havingRaw('AVG(potenciaAM) <= 200')
            ->havingRaw('AVG(potenciaFM) <= 200')
            ->havingRaw('AVG(potenciaDABHibrido) <= 200')
            ->havingRaw('AVG(SNRAMHibrido) <= 200')
            ->havingRaw('AVG(SNRFMHibrido) <= 200')
            ->havingRaw('AVG(SNRDAB) <= 200')
            ->get();


        $promPotenciasBuca = PotenciaBuca::select(
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

        // Asegúrate de tener al menos tantos elementos como se esperan en tu vista
        while (count($encabezados) < 19) {
            $encabezados[] = 'Título Desconocido';
        }


        // Asegúrate de retornar los datos a la vista adecuada
        return view("admin.recomendaciones.index", compact('users', 'promPotencias', 'promPotenciasBuca', 'promPotenciasMede', 'promPotenciasCali', 'potencia', 'potenciaBuca', 'potenciaMede', 'potenciaCali', 'encabezados', 'encabezadosMede', 'encabezadosCali', 'encabezadosBuca', 'ciudades', 'recoPotencia'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
