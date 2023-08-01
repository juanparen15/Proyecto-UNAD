<?php

namespace App\Imports;

use App\Estadovigencia;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class EstadovigenciaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Estadovigencia([
            'id'=>$row[0],
            'detestadovigencia'=>$row[1],
            'slug'=> Str::slug($row[1]),
        ]);
    }
}
