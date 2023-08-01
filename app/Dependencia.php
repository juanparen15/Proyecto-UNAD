<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    public $incrementing = false;
    protected $fillable= ['id','nomdependencia','slug'];

    public function getRouteKeyName() {
      return "slug";
    } 

    //Relacion Uno a Muchos 
    public function areas(){
        return $this->hasMany(Area::class);
    }
}
