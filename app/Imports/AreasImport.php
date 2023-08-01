<?php

namespace App\Imports;

use App\Area;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;


class AreasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Area([
            'id' => $row[0],
            'dependencia_id' => $row[1],
            'nomarea' => $row[2],
            'slug'=> Str::slug($row[2])
        ]);
    }
}
