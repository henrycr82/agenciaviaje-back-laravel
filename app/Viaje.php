<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    
	//tabla
    protected $table = 'viajes';

    //campos editables
    protected $fillable = ['numero_plazas','plazas_disponibles','origen','destino','precio'];

    //para ocultar campos cuando listamos
    protected $hidden = ['created_at','updated_at'];

    /**
    * Los viajeros pertenecen a un viaje.
    */
    public function viajeros()
    {
        return $this->belongsToMany('App\Viajero','viaje_viajero')->withPivot('viajero_id');
    }

}
