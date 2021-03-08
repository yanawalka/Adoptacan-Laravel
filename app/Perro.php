<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perro extends Model
{
    protected $table = "perros";

    protected $fillable = [	'chip',
    						'raza_id',
                            'apodo',
    						'fechanac',
    						'porte',
    						'ninios',
    						'actividad',
    						'guardian',
    						'sexo',
    						'castrado',
    						'depto',
    						'otrosperros',
    						'gatos',
    						'alimentodiario',
    						'foto',
                            'visible',
                            'seguimiento',
                            'idpropietario',
                            'fechadeceso',
                            'mestizo'];

    public function raza()
    {
        return $this->belongsTo('App\Raza');
    }   

    public function adopciones()
    {
        return $this->hasMany('App\Adopcion');
    }       

    public function propietarios()
    {
        return $this->hasMany('App\propietario');
    }    
     public function seguimiento()
    {
        return $this->hasMany('App\Seguimiento');
    }                     
}
