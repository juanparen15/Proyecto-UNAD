<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSimulacion extends Model
{
    public $incrementing = false;
    public $table = 'tipo_simulacions';
    public $connection = 'mysql';
    protected $fillable = [
        'id',
        'estandar_id',
        'detfuente',
        'kmz',
        'kmzRadio',
        'kmzBest',
        'kmzOver',
        'kmzInterferencia',
        'leyendaSignal',
        'leyendaBest',
        'leyendaOver',
        'coordenadaX',
        'coordenadaY',
        'slug'
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }
    public function estandar()
    {
        return $this->belongsTo(Estandar::class, 'estandar_id');
    }
    //Relacion Uno a Muchos
    public function planadquisiciones()
    {
        return $this->hasMany(Planadquisicione::class);
    }
    //Relacion Uno a Muchos (Inversa)
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id'); // Asegúrate de que el nombre de la clave foránea sea correcto
    }
}
