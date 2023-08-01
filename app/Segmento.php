<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
    public $incrementing = false;
    protected $fillable= ['id','detsegmento','slug'];

    public function getRouteKeyName() {
      return "slug";
    }
    

     //Relacion Uno a Muchos 
     public function familia(){
        return $this->hasMany(Familia::class);
    }
}
