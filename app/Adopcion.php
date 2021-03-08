<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adopcion extends Model
{
    protected $table = "adopciones";

    protected $fillable = [ 'id',
                            'persona_id',
    						'solicitud_id',
    						'perro_id',
    						'fecha_adopcion',
    						'domicilio',
    						'fecha_limite'];


    public function perro()
    {
    	return $this->belongsTo('App\Perro');
    }	    						

    public function solicitud()
    {
    	return $this->belongsTo('App\Solicitud');
    }	    						

}
