<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleplanadquisicione extends Model
{
    public $incrementing = false;    
    protected $fillable= [
        'id',
        'producto_id',
        'planadquisicione_id',
    ];

    //Relacion Uno a Muchos 
    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    //Relacion Uno a Muchos
    public function planadquisiciones(){
        return $this->hasMany(Planadquisicione::class);
    }
}
