<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoadquisicione extends Model
{   
  public $incrementing = false;
    protected $fillable= ['id','dettipoadquisicion','slug'];

    public function getRouteKeyName() {
      return "slug";
    }

    //Relacion Uno a Muchos
    public function planadquisiciones(){
        return $this->hasMany(Planadquisicione::class);
    }
}
