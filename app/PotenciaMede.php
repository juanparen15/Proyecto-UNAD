<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PotenciaMede extends Model
{
    public $incrementing = false;
    protected $fillable = ['latitudAM', 'longitudAM', 'potenciaAM', 'latitudFM', 'longitudFM', 'potenciaFM', 'latitudDABHibrido', 'longitudDABHibrido', 'potenciaDABHibrido', 'latitudAMHibrido', 'longitudAMHibrido', 'SNRAMHibrido', 'latitudFMHibrido', 'longitudFMHibrido', 'SNRFMHibrido', 'latitudDAB', 'longitudDAB', 'SNRDAB', 'slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }
}