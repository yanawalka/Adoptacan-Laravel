<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    protected $table = "propietarios";

    protected $fillable = [ 'dni',
                            'email',
    						'apellido',
    						'nombres',
    						'celular',
    						'clave',
                            'certcarencia',
                            'fechacert',
                            'domicilio',
                            'referencia',
                            'foto'];

    public function solicitudes()
    {
        return $this->hasMany('App\Solicitud');
    }  
    public function perros()
    {
        return $this->hasMany('App\Perro');
    }      
              						
}
