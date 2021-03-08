<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Perro;
use App\Raza;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AdoptantesFormRequest;
use DB;
use Carbon\Carbon;


class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */    
    public function index()
    {
        $perros = DB::table('perros as p')
        ->join('razas as r','R.ID','=','P.RAZA_ID')
        ->select ('p.id','p.chip','p.raza_id','R.NOMBRE nraza','p.apodo','P.FECHANAC','p.sexo',
        "decode (p.sexo,'H','HEMBRA','M','MACHO','--') nsexo", 
        'p.porte', "decode (p.porte,'P','PEQUEÑO','M','MEDIANO','G','GRANDE','GI','GIGANTE','--') nporte", 
        'p.ninios', "decode (p.ninios,1,'SI',0,'NO','--') nninios",
        'P.ACTIVIDAD',"decode (p.actividad,'B','BAJA','M','MEDIA','A','ALTA','--') nactividad",
        'p.guardian',"decode (p.guardian,'S','SI','N','NO','--') nguardian",
        'p.castrado',"decode (p.castrado,'S','SI','N','NO','--') ncastrado",
        'p.depto',"decode (p.depto,'S','SI','N','NO','--') ndepto",
        'p.otrosperros',"decode (p.otrosperros,'S','SI','N','NO','--') notrosperros",
        'p.gatos',"decode (p.gatos,'S','SI','N','NO','--') ngatos",'p.alimentodiario','p.foto','p.visible','f_get_solicitud_perros(p.id) cant','f_get_sugerencia_perro(p.id) sug' )
        ->where('p.idpropietario','=',null)
        ->where('p.visible','=','S')
        ->where(function ($query) {
                $query->where("to_number(to_char(p.fechadeceso,'Y'))", '>', 2000)
                      ->orWhere('p.fechadeceso', '=', null);})
        ->orderBy('p.id','DESC')
        ->paginate(9);
        return view('front.home',['perros'=>$perros]);
    }

    public function getcan($id)
    {
        $perro = DB::table('perros as p')
        ->join('razas as r','R.ID','=','P.RAZA_ID')
        ->select ('p.id','p.chip','p.raza_id','R.NOMBRE nraza','p.apodo','P.FECHANAC','p.sexo',
        "decode (p.sexo,'H','HEMBRA','M','MACHO','--') nsexo", 
        'p.porte', "decode (p.porte,'P','PEQUEÑO','M','MEDIANO','G','GRANDE','GI','GIGANTE','--') nporte", 
        'p.ninios', "decode (p.ninios,1,'SI',0,'NO','--') nninios",
        'P.ACTIVIDAD',"decode (p.actividad,'B','BAJA','M','MEDIA','A','ALTA','--') nactividad",
        'p.guardian',"decode (p.guardian,'S','SI','N','NO','--') nguardian",
        'p.castrado',"decode (p.castrado,'S','SI','N','NO','--') ncastrado",
        'p.depto',"decode (p.depto,'S','SI','N','NO','--') ndepto",
        'p.otrosperros',"decode (p.otrosperros,'S','SI','N','NO','--') notrosperros",
        'p.gatos',"decode (p.gatos,'S','SI','N','NO','--') ngatos",'p.alimentodiario','p.foto','p.visible','f_get_solicitud_perros(p.id) cant','f_get_sugerencia_perro(p.id) sug' )
        ->where('p.id','=',$id)->first();
        return view('front.can',['perro'=>$perro]);
    }

    public function getform(){
            return view('front.formulario');
        }

    public function getform2($id)
    {
        $perro = DB::table('perros as p')
        ->join('razas as r','R.ID','=','P.RAZA_ID')
        ->select ('p.id','p.chip','p.raza_id','R.NOMBRE nraza','p.apodo','P.FECHANAC','p.sexo',
        "decode (p.sexo,'H','HEMBRA','M','MACHO','--') nsexo", 
        'p.porte', "decode (p.porte,'P','PEQUEÑO','M','MEDIANO','G','GRANDE','GI','GIGANTE','--') nporte", 
        'p.ninios', "decode (p.ninios,1,'SI',0,'NO','--') nninios",
        'P.ACTIVIDAD',"decode (p.actividad,'B','BAJA','M','MEDIA','A','ALTA','--') nactividad",
        'p.guardian',"decode (p.guardian,'S','SI','N','NO','--') nguardian",
        'p.castrado',"decode (p.castrado,'S','SI','N','NO','--') ncastrado",
        'p.depto',"decode (p.depto,'S','SI','N','NO','--') ndepto",
        'p.otrosperros',"decode (p.otrosperros,'S','SI','N','NO','--') notrosperros",
        'p.gatos',"decode (p.gatos,'S','SI','N','NO','--') ngatos",'p.alimentodiario','p.foto','p.visible','f_get_solicitud_perros(p.id) cant','f_get_sugerencia_perro(p.id) sug' )
        ->where('p.id','=',$id)->first();
        return view('front.formulario',['perro'=>$perro]); 
    }

    public function buscador()
    {
        return view('front.buscador');
    }

}




