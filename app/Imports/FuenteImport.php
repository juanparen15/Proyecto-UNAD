<?php

namespace App\Imports;

use App\Fuente;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class FuenteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Fuente([
            'id'=>$row[0],
            'detfuente'=>$row[1],
            'slug'=> Str::slug($row[1]),
        ]);
    }
}
