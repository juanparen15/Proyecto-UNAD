<?php

namespace App\Imports;

use App\Familia;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class FamiliaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Familia([
            'segmento_id'=>$row[0],
            'id'=>$row[1],
            'detfamilia'=>$row[2],
            'slug'=> Str::slug($row[2]),
        ]);
    }
}
