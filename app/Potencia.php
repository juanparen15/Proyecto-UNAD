<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potencia extends Model
{
    public $incrementing = false;
    protected $fillable = ['latitud', 'longitud', 'potencia', 'segundaPotencia', 'terceraPotencia', 'cuartaPotencia', 'quintaPotencia', 'sextaPotencia', 'slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }
}
