<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    protected $table = "razas";

    protected $fillable = [ 'nombre',
    						'porte',
    						'ninios',
    						'evida'	];

    public function perros()
    {
    	return $this->hasMany('App\Perro');
    }						
}
