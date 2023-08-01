<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $incrementing = false;
    protected $fillable= ['id','detproducto','slug','clase_id'];

    public function getRouteKeyName() {
      return "slug";
    }

    //Relacion Uno a Muchos (Inversa)
    public function clase(){
        return $this->belongsTo(Clase::class);
    }

    //Relacion Muchos a Muchos

    public function planadquisiciones(){
        return $this->belongsToMany(Planadquisicione::class);
    }
}
