<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = "seguimiento";

    protected $fillable = [	'id',
    						'idcan',
                            'fecha',
    						'fechanac',
    						'detalle',
    						'usuario'];
     

    public function perro()
    {
        return $this->belongsTo('App\Perro');
    }      
}
