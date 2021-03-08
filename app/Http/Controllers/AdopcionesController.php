<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Adopcion;
use App\Propietario;
use App\Perro;
use App\Solicitud;
use App\Raza;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AdoptantesFormRequest;
use DB;
use Laracasts\Flash\Flash;
use Carbon\Carbon;


class AdopcionesController extends Controller
{
	public function __construct()
{
  $this->middleware('auth');
}

public function index(Request $request){

    //if ($request) {
$adopciones = DB::table('adopciones a')
      ->join ('propietarios as ad','ad.id','=' ,'a.persona_id')
      ->join ('perros as p','p.id','=','a.perro_id')
      ->leftjoin ('solicitudes as s','s.id','=' ,'a.solicitud_id')
      ->select ('s.id ID','ad.apellido apellidoad','ad.nombres nombresad','ad.celular','ad.email', "decode (p.porte,'P','PEQUEÑO','M','MEDIANO','G','GRANDE','GI','GIGANTE','--') nporte",
          "decode (p.ninios,1,'SI',0,'NO','--') nninios","decode (p.guardian,'S','SI','N','NO','--') nguardian", "decode (p.sexo,'H','HEMBRA','M','MACHO','--') nsexo",
          "decode (p.castrado,'S','SI','N','NO','--') ncastrado",'p.depto',
          's.adoptante_id','s.edad',
          "decode (p.depto,'S','SI','N','NO','--') ndepto",
          'p.actividad',
          "decode (p.otrosperros,'S','SI','N','NO','--') notrosperros",
          "decode (p.gatos,'S','SI','N','NO','--') ngatos",
          's.temporal','p.apodo','a.fecha_adopcion','a.id adopcion')
      ->orderby ('a.fecha_adopcion','DESC')
      ->paginate(10);
    return view('admin.adopciones.index')->with('adopciones',$adopciones);
  }  


  public function imprime(Request $request,$id){

        $adopciones = Adopcion::find($id);
        $persona = Propietario::find($adopciones->persona_id);
        $solicitud = Solicitud::find($adopciones->solicitud_id);
        $perros = Perro::find($adopciones->perro_id);
        $razas = Raza::find($perros->raza_id);
    return view('admin.adopciones.imprime',['adopciones'=>$adopciones,'personas'=>$persona,'solicitud'=>$solicitud,'perro'=>$perros,'raza'=>$razas]);


  }  

  public function create(Request $request,$perro_id, $prop_id ,$edad, $solicitud_id){
      //return view("ver.razas.create");
  	  $perro = Perro::find($perro_id);
      $solicitud = Solicitud::find($solicitud_id);
      $persona = Propietario::find($prop_id);
      $adoptado = DB::table('adopciones')->where('solicitud_id','=', $solicitud->id)->pluck('id');

      

	  $mytime = Carbon::now()->subYear($request->anios)->subMonth($request->meses)->subDay($request->dias); 
    if (count($adoptado) == 0) {
  	  $adopcion = new Adopcion($request->all());
  	  $adopcion->persona_id = $prop_id;
  	  $adopcion->solicitud_id = $solicitud_id;
  	  $adopcion->perro_id = $perro_id;
  	  $adopcion->fecha_adopcion = $mytime;
  	  $adopcion->domicilio = '-';
  	  $adopcion->save();
      $perro->visible = 'N';
      $perro->idpropietario = $prop_id;
      $perro->update();
      $solicitud->activa = 'X';
      $solicitud->update();
    }   
    $adopciones = DB::table('adopciones a')
      ->join ('propietarios as ad','ad.id','=' ,'a.persona_id')
      ->join ('solicitudes as s','s.id','=' ,'a.solicitud_id')
      ->join ('perros as p','p.id','=','a.perro_id')
      ->select ('s.id ID','ad.apellido apellidoad','ad.nombres nombresad','ad.celular','ad.email',"ad.domicilio", "decode (p.porte,'P','PEQUEÑO','M','MEDIANO','G','GRANDE','GI','GIGANTE','--') nporte",
          "decode (p.ninios,1,'SI',0,'NO','--') nninios","decode (p.guardian,'S','SI','N','NO','--') nguardian", "decode (p.sexo,'H','HEMBRA','M','MACHO','--') nsexo",
          "decode (p.castrado,'S','SI','N','NO','--') ncastrado",'p.depto',
          's.adoptante_id','s.edad',
          "decode (p.depto,'S','SI','N','NO','--') ndepto",
          'p.actividad',
          "decode (p.otrosperros,'S','SI','N','NO','--') notrosperros",
          "decode (p.gatos,'S','SI','N','NO','--') ngatos",
          's.temporal','p.apodo','a.fecha_adopcion','a.id adopcion')
      ->orderby ('a.fecha_adopcion','DESC')
      ->paginate(10);
    return view('admin.adopciones.index')->with('adopciones',$adopciones);
    
  }

 public function show(){
  $estadisticas = DB::table('adopciones a')

      ->select ('count(*) CANTIDAD','to_char(fecha_adopcion,\'YYYY/MM\') PERIODO')
      ->groupby ('to_char(fecha_adopcion,\'YYYY/MM\')')
      ->orderby ('to_char(fecha_adopcion,\'YYYY/MM\')','DESC')
      ->paginate(10);
      //dd($estadisticas);
    return view('admin.adopciones.estadisticas')->with('estadisticas',$estadisticas);

  }

public function estadisticas(Request $request){

    //if ($request) {
$estadisticas = DB::table('adopciones a')

      ->select ('count(*) CANTIDAD','to_char(fecha_adopcion,\'YYYY/MM\') PERIODO')
      ->orderby ('to_char(fecha_adopcion,\'YYYY/MM\')','DESC')
      ->paginate(10);
    return view('admin.adopciones.estadisticas')->with('estadisticas',$estadisticas);
  }  

    //


public function createciega(Request $request,$perro_id, $persona_id){
      
      //return view("ver.razas.create");
      $perro = Perro::find($perro_id);
      
      $persona = Propietario::find($persona_id);
      //$adoptado = DB::table('adopciones')->where('solicitud_id','=', $solicitud->id)->pluck('id');

      

    $mytime = Carbon::now()->subYear($request->anios)->subMonth($request->meses)->subDay($request->dias); 
    //if (count($adoptado) == 0) {
      $adopcion = new Adopcion($request->all());
      $adopcion->persona_id = $persona_id;
      $adopcion->solicitud_id = 0;
      $adopcion->perro_id = $perro_id;
      $adopcion->fecha_adopcion = $mytime;
      $adopcion->domicilio = '-';
      $adopcion->save();
      $perro->visible = 'N';
      $perro->idpropietario = $persona_id;
      $perro->update();
     
    //}   
    $adopciones = DB::table('adopciones a')
      ->join ('propietarios as ad','ad.id','=' ,'a.persona_id')
      ->join ('perros as p','p.id','=','a.perro_id')
      ->select ('0 ID','ad.apellido apellidoad','ad.nombres nombresad','ad.celular','ad.email', "decode (p.porte,'P','PEQUEÑO','M','MEDIANO','G','GRANDE','GI','GIGANTE','--') nporte",
          "decode (p.ninios,1,'SI',0,'NO','--') nninios","decode (p.guardian,'S','SI','N','NO','--') nguardian", "decode (p.sexo,'H','HEMBRA','M','MACHO','--') nsexo",
          "decode (p.castrado,'S','SI','N','NO','--') ncastrado",'p.depto',
          'ad.id persona_id',"'-' as edad",
          "decode (p.depto,'S','SI','N','NO','--') ndepto",
          'p.actividad',
          "decode (p.otrosperros,'S','SI','N','NO','--') notrosperros",
          "decode (p.gatos,'S','SI','N','NO','--') ngatos",
          "'N' as temporal",'p.apodo','a.fecha_adopcion','a.id adopcion')
      ->orderby ('a.fecha_adopcion','DESC')
      ->paginate(10);
    return view('admin.adopciones.index')->with('adopciones',$adopciones);
    
  }



  public function datosprop(Request $request){

      $dni = $request->dni;

     
      $datosprop =  DB::table("propietarios")
        -> select ("id","email as EMAIL","apellido as APELLIDO","nombres AS NOMBRE","celular as CELULAR", "certcarencia as CERTCARENCIA" , "fechacert AS FECHACERT")
        -> where('dni', '=', $dni)
        -> get();
      
       return view('admin.adopciones.datosprop')->with('prop',$datosprop);
    }

}




