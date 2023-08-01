<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $incrementing = false;
    protected $fillable= ['id','nomarea','slug','dependencia_id'];

    public function getRouteKeyName() {
      return "slug";
    }
    
    //Relacion Uno a Muchos 
    public function planadquisiciones(){
        return $this->hasMany(Planadquisicione::class);
    }

    //Relacion Uno a Muchos (Inversa)
    public function dependencia(){
       return $this->belongsTo(Dependencia::class);
    }
}
