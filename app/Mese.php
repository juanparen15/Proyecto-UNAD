<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mese extends Model
{
    public $incrementing = false;
    protected $fillable= ['id','nommes','slug'];

    public function getRouteKeyName() {
      return "slug";
    }

    //Relacion Uno a Muchos
    public function planadquisiciones(){
        return $this->hasMany(Planadquisicione::class);
    }
}
