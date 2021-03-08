<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
     protected $table = "solicitudes";

    protected $fillable = [	'adoptante_id',
    						'edad',
    						'porte',
    						'ninios',
    						'actividad',
    						'guardian',
    						'sexo',
    						'castrado',
    						'depto',
    						'otrosperros',
    						'gatos',
                            'temporal',
                            'activa'];

public function adopciones()
    {
        return $this->hasMany('App\Adopcion');
    }     

public function adoptante()
    {
        return $this->belongTo('App\Propietario');
    }                                   
}
