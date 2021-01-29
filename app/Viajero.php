<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viajero extends Model
{
    
	//tabla
    protected $table = 'viajeros';

    //campos editables
    protected $fillable = ['cedula','nombre','fecha_nacimiento','telefono'];

    //para ocultar campos cuando listamos
    protected $hidden = ['created_at','updated_at'];

    /**
    * Los viajes pertenecen a un viajero.
    */
    public function viajes()
    {
        return $this->belongsToMany('App\Viaje','viaje_viajero')->withPivot('viaje_id');
    }
}
