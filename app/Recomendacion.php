<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recomendacion extends Model
{
    // public $incrementing = false;
    protected $fillable = ['id', 'recomendacion', 'slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }
}
