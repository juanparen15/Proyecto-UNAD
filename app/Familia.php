<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    public $incrementing = false;
    protected $fillable= ['id','segmento_id','detfamilia','slug'];

    public function getRouteKeyName() {
      return "slug";
    }

   //Relacion Uno a Muchos (Inversa)
   public function segmento(){
      return $this->belongsTo(Segmento::class);
    }

   //Relacion Uno a Muchos 
   public function clase(){
     return $this->hasMany(Clase::class);
    }
}
