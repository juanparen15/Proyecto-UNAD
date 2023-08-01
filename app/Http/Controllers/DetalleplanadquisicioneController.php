<?php

namespace App\Http\Controllers;

use App\Detalleplanadquisicione;
use Illuminate\Http\Request;

class DetalleplanadquisicioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Detalleplanadquisicione  $detalleplanadquisicione
     * @return \Illuminate\Http\Response
     */
    public function show(Detalleplanadquisicione $detalleplanadquisicione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detalleplanadquisicione  $detalleplanadquisicione
     * @return \Illuminate\Http\Response
     */
    public function edit(Detalleplanadquisicione $detalleplanadquisicione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detalleplanadquisicione  $detalleplanadquisicione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detalleplanadquisicione $detalleplanadquisicione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detalleplanadquisicione  $detalleplanadquisicione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detalleplanadquisicione $detalleplanadquisicione)
    {
        //
    }
}
