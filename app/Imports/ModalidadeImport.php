<?php

namespace App\Imports;

use App\Modalidade;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
class ModalidadeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Modalidade([
            'id'=>$row[0],
            'detmodalidad'=>$row[1],
            'slug'=> Str::slug($row[1]),
        ]);
    }
}
