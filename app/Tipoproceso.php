<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoproceso extends Model
{   
  public $incrementing = false;
    protected $fillable= ['id','dettipoproceso','slug','subserie'];

    public function getRouteKeyName() {
      return "slug";
    }

   //Relacion Uno a Muchos
   public function planadquisiciones(){
     return $this->hasMany(Planadquisicione::class);
    }
}
