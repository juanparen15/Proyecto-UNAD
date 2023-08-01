<?php

namespace App\Exports;

use App\Planadquisicione;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PlanadquisicioneAllExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    

    public function view(): View
    {
        

        if (auth()->user()->hasRole('Admin')) {
            $planes = Planadquisicione::all();
        } else {
            $planes = Planadquisicione::where('user_id', auth()->user()->id)->get();
        }
        return view('admin.planadquisiciones.planadquisicione_all', [
            'planadquisiciones' => $planes
        ]);
    }

}
