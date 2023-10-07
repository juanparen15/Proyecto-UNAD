<?php

namespace App\Imports;

use App\Planadquisicione;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class PlanadquisicioneImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Planadquisicione([
            // $ultimoId = Planadquisicione::max('id') + 1,
            // 'id'=> $row[0],
            'caja'=> $row[0],
            'carpeta'=> $row[1],
            'tomo'=> $row[2],
            'otro'=> $row[3],
            'folio'=> $row[4],
            'nota'=> $row[5],
            'modalidad_id'=> $row[6],
            'fuente_id'=> $row[7],
            'tipoprioridade_id'=> $row[8],
            'user_id'=> $row[9],
            // 'slug'=> Str::slug($row[10]),
            'slug'=> $row[10],
            'requiproyecto_id'=> $row[11],
            'requipoais_id'=> $row[12],
            'segmento_id'=> $row[13],
            'familias_id'=> $row[14],
            'fechaInicial'=> $row[15],
            'fechaFinal'=> $row[16],
            'area_id'=> $row[17]
        ]);
    }
}
