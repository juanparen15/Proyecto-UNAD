<?php

namespace App\Http\Controllers;


use App\Potencia;
use App\Ciudad;
use App\User;
use App\Encabezado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        $encabezados = Encabezado::all();


        // if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Supervisor')) {
        $potencias = Potencia::select(
            'potencia',
            DB::raw("SUM(potencia) as pot"),
        )->groupBy('potencia')->get();

        $potenciasData = [];
        foreach ($potencias as $potencia) {
            $potenciasData[] = ['name' => $potencia->potencia, 'y' => $potencia->pot];
        }

        $potencias2 = Potencia::select(
            'segundaPotencia',
            DB::raw("SUM(segundaPotencia) as pot2"),
        )->groupBy('segundaPotencia')->get();

        $potenciasData2 = [];
        foreach ($potencias2 as $segundaPotencia) {
            $potenciasData2[] = ['name' => $segundaPotencia->segundaPotencia, 'y' => $segundaPotencia->pot2];
        }
        $potencias3 = Potencia::select(
            'terceraPotencia',
            DB::raw("SUM(terceraPotencia) as pot3"),
        )->groupBy('terceraPotencia')->get();

        $potenciasData3 = [];
        foreach ($potencias3 as $terceraPotencia) {
            $potenciasData3[] = ['name' => $terceraPotencia->terceraPotencia, 'y' => $terceraPotencia->pot3];
        }
        $potencias4 = Potencia::select(
            'cuartaPotencia',
            DB::raw("SUM(cuartaPotencia) as pot4"),
        )->groupBy('cuartaPotencia')->get();

        $potenciasData4 = [];
        foreach ($potencias4 as $cuartaPotencia) {
            $potenciasData4[] = ['name' => $cuartaPotencia->cuartaPotencia, 'y' => $cuartaPotencia->pot4];
        }

        // Obtener los encabezados almacenados en la tabla Encabezado
        $encabezados = Encabezado::pluck('encabezado')->toArray();

        // Asegúrate de tener al menos tantos elementos como se esperan en tu vista
        while (count($encabezados) < 8) {
            $encabezados[] = 'Título Desconocido';
        }

        return view("home", ["data" => $potenciasData, $potenciasData2, $potenciasData3, $potenciasData4], compact('users', 'potencias', 'potencias2', 'potencias3', 'potencias4', 'encabezados'));
    }
}
