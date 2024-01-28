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

class HomeController extends Controller
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

        return view("home");
    }
}
