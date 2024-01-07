<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potencia extends Model
{
    public $incrementing = false;
    protected $fillable = ['potencia', 'segundaPotencia', 'terceraPotencia', 'cuartaPotencia', 'slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }
}
