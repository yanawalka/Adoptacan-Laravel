<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Propietario;
use App\Solicitud;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RazasFormRequest;
use App\Http\Requests\AdoptantesFormRequest;
use DB;

class SolicitudesController extends Controller
{



public function index(Request $request){

    //if ($request) {
        $query=trim($request->get('searchText'));
        $solicitudes = DB::table('solicitudes as s')
        ->join('propietarios as a','a.ID','=','s.ADOPTANTE_ID')
        ->select('s.id',"COALESCE(a.apellido,'') as apadoptante","COALESCE(a.nombres,'') as nadoptante", 
          's.adoptante_id','s.edad','s.porte',"decode (s.porte,'P','PEQUEÑO','M','MEDIANO','G','GRANDE','GI','GIGANTE','--') nporte"
          ,'s.ninios',"decode (s.ninios,1,'SI',0,'NO','--') nninios",
          's.actividad',
          's.guardian',"decode (s.guardian,'S','SI','N','NO','--') nguardian",
          "decode (s.sexo,'H','HEMBRA','M','MACHO','--') nsexo",
          's.sexo','s.castrado',"decode (s.castrado,'S','SI','N','NO','--') ncastrado",'s.depto',
          "decode (s.depto,'S','SI','N','NO','--') ndepto",
          's.otrosperros',"decode (s.otrosperros,'S','SI','N','NO','--') notrosperros",
          's.gatos',"decode (s.gatos,'S','SI','N','NO','--') ngatos",'s.temporal','s.activa','s.created_at','f_get_perros_solicitud(s.id) cant','f_get_sugerencia_solicitud(s.id) sug')
       -> where('s.activa','<>','X')
       
        ->orderBy('f_get_perros_solicitud(s.id)','ASC')
        
        ->paginate(20);
        return view('admin.solicitudes.index',["solicitudes"=>$solicitudes,"searchText"=>$query]);
    //}

  }  


public function index_perros($id){
    
        //$query=strtoupper(trim($request->get('perros')));

        $solicitudes = DB::table('perros as p')
        ->join('solicitudes as s',function ($join) {$join->on("decode(p.porte,'-',s.porte,p.porte)",'=',"s.porte ")  
          ->On( "case  
                                    when (sysdate - p.fechanac)/30 between 0 and 5.99 then 'cachorro'
                                    when (sysdate - p.fechanac)/30 between 6 and 17.99 then 'joven'
                                    when (sysdate - p.fechanac)/30 between 18 and 83.99 then 'Adulto'
                                    when (sysdate - p.fechanac)/30 >= 84 then 'Anciano'
                                end", '=',"decode(s.edad,'-',case  
                                    when (sysdate - p.fechanac)/30 between 0 and 5.99 then 'cachorro'
                                    when (sysdate - p.fechanac)/30 between 6 and 17.99 then 'joven'
                                    when (sysdate - p.fechanac)/30 between 18 and 83.99 then 'Adulto'
                                    when (sysdate - p.fechanac)/30 >= 84 then 'Anciano'end, s.edad)")
          ->On("decode(p.actividad,'-',s.actividad,'NO DETERMINADA',s.actividad,'M','MEDIA','B','BAJA','A','ALTA')","=","s.actividad ")
          ->On("decode(s.guardian,'-',p.guardian,s.guardian)",'=',"p.guardian ")
          ->On("decode(s.sexo,'-',p.sexo,s.sexo)" ,'=',"p.sexo")
          ->On("DECODE(s.depto,'-',p.depto,'N',p.depto,s.depto)" ,'=',"p.depto") 
          ->On("DECODE(s.otrosperros,'-',p.otrosperros,'N',p.otrosperros,s.otrosperros)",'=',"p.otrosperros")
          ->On("DECODE(s.gatos,'-',p.gatos,'N',p.gatos,s.gatos)",'=',"p.gatos")
          ->On("decode(s.ninios,1,1,-1,p.ninios,0,p.ninios)",'=',"p.ninios");})                                           
        ->join('propietarios as a','a.ID','=','s.ADOPTANTE_ID')
        ->select ('s.id',"COALESCE(a.apellido,'') as apadoptante","COALESCE(a.nombres,'') as nadoptante", 
          's.adoptante_id','s.edad','s.porte',"decode (s.porte,'P','PEQUEÑO','M','MEDIANO','G','GRANDE','GI','GIGANTE','--') nporte"
          ,'s.ninios',"decode (s.ninios,1,'SI',0,'NO','--') nninios",
          's.actividad',
          's.guardian',"decode (s.guardian,'S','SI','N','NO','--') nguardian",
          "decode (s.sexo,'H','HEMBRA','M','MACHO','--') nsexo",
          's.sexo','s.castrado',"decode (s.castrado,'S','SI','N','NO','--') ncastrado",'s.depto',
          "decode (s.depto,'S','SI','N','NO','--') ndepto",
          's.otrosperros',"decode (s.otrosperros,'S','SI','N','NO','--') notrosperros",
          's.gatos',"decode (s.gatos,'S','SI','N','NO','--') ngatos",'s.temporal','s.activa','s.created_at','f_get_perros_solicitud(s.id) cant' )
        ->where('p.id','=',$id)
        ->where('p.visible','=','S')
        ->where('s.activa','<>','X')
        ->where('p.idpropietario','=',null)
        ->where(function ($query) {
                $query->where("to_number(to_char(p.fechadeceso,'Y'))", '>', 2000)
                      ->orWhere('p.fechadeceso', '=', null);})
        ->paginate(10);
        return view('admin.perros.index_can')->with('solicitudes',$solicitudes);
  }  

public function index_perros_sug($id){
    
        //$query=strtoupper(trim($request->get('perros')));

        $solicitudes = DB::table('perros as p')
        ->join('solicitudes as s',function ($join) {$join 
          ->On("decode(s.actividad,'-',p.actividad,'NO DETERMINADA',p.actividad,'MEDIA','M','BAJA','B','ALTA','A')", '=', "p.actividad")
          ->On("DECODE(s.depto,'-',p.depto,'N',p.depto,s.depto)",'=',"p.depto") 
          ->On("DECODE(s.otrosperros,'-',p.otrosperros,'N',p.otrosperros,s.otrosperros)",'=',"p.otrosperros")
          ->On("DECODE(s.gatos,'-',p.gatos,'N',p.gatos,s.gatos)",'=',"p.gatos")
          ->On("decode(s.ninios,1,1,-1,p.ninios,0,p.ninios)",'=',"p.ninios");})                               
        ->join('propietarios as a','a.ID','=','s.ADOPTANTE_ID')
        ->select ('s.id',"COALESCE(a.apellido,'') as apadoptante","COALESCE(a.nombres,'') as nadoptante", 
          's.adoptante_id','s.edad','s.porte',"decode (s.porte,'P','PEQUEÑO','M','MEDIANO','G','GRANDE','GI','GIGANTE','--') nporte"
          ,'s.ninios',"decode (s.ninios,1,'SI',0,'NO','--') nninios",
          's.actividad',
          's.guardian',"decode (s.guardian,'S','SI','N','NO','--') nguardian",
          "decode (s.sexo,'H','HEMBRA','M','MACHO','--') nsexo",
          's.sexo','s.castrado',"decode (s.castrado,'S','SI','N','NO','--') ncastrado",'s.depto',
          "decode (s.depto,'S','SI','N','NO','--') ndepto",
          's.otrosperros',"decode (s.otrosperros,'S','SI','N','NO','--') notrosperros",
          's.gatos',"decode (s.gatos,'S','SI','N','NO','--') ngatos",'s.temporal','s.activa','s.created_at','f_get_perros_solicitud(s.id) cant','p.id perrito' )
        ->where('p.id','=',$id)
        ->where('p.visible','=','S')
        ->where('s.activa','<>','X')
        ->where('p.idpropietario','=',null)
        ->where(function ($query) {
                $query->where("to_number(to_char(p.fechadeceso,'Y'))", '>', 2000)
                      ->orWhere('p.fechadeceso', '=', null);})
         ->paginate(10);
        return view('admin.perros.index_can')->with('solicitudes',$solicitudes);
  }  




  public function create(){

      $adoptantes = Propietario::selectRaw(" apellido|| ' '|| nombres  as apellido, id ")
        ->lists('apellido','id');
        
 

        
      return view("admin.solicitudes.create")->with('solicitantes',$adoptantes);
  }

  public function store(Request $request){
    $solicitudes=new Solicitud;
    $solicitudes->adoptante_id=$request->get('adoptante_id');
    $solicitudes->edad=$request->get('edad');
    $solicitudes->porte = $request->porte;
    $solicitudes->ninios = $request->ninios;
    $solicitudes->actividad = $request->actividad;
    $solicitudes->guardian = $request->guardian;
    $solicitudes->sexo = $request->sexo;
    $solicitudes->castrado = $request->castrado;
    $solicitudes->depto = $request->depto;
    $solicitudes->otrosperros = $request->otrosperros;
    $solicitudes->gatos = $request->gatos;
    $solicitudes->temporal = $request->temporal;
    $solicitudes->save();
    Flash::success("Se ha grabado la solicitud");
    return Redirect::to('admin/solicitudes');

  }


  public function show(){

  }

  public function edit($id){

     $solicitud = Solicitud::find($id);     
     $adoptantes=Propietario::orderBy('apellido','ASC')->lists('apellido','id');
      return view("admin.solicitudes.edit", ['solicitantes'=>$adoptantes,'solicitud'=>$solicitud]) ;

  }

  public function update(Request $request, $id){
    $solicitud = Solicitud::find($id);
      $solicitud->edad = $request->edad;
      $solicitud->activa = $request->activa;
      $solicitud->porte = $request->porte;
      $solicitud->ninios = $request->ninios;
      $solicitud->actividad = $request->actividad;
      $solicitud->guardian = $request->guardian;
      $solicitud->sexo = $request->sexo;
      $solicitud->castrado = $request->castrado;
      $solicitud->depto = $request->depto;
      $solicitud->otrosperros = $request->otrosperros;
      $solicitud->gatos = $request->gatos;
      $solicitud->temporal = $request->temporal;
     
      $solicitud->update();

      Flash::success("Se han modificado los datos de la solitud" );
      return Redirect::to('admin/solicitudes');



    $razas=DB::table('razas')
    ->where('idraza','=',$id)
    ->update(['nombre' => $request->get('nombre'),
              'porte' => $request->get('porte'),
              'ninios' => $request->get('ninios'),
              'evida' => $request->get('evida')]);

    return Redirect::to('ver/razas');
  }


  public function destroy($id){
    $solicitud=DB::table('SOLICITUDES')->where('id','=',$id)->update(['activa' => 'X']);
    return Redirect::to('admin/solicitudes');
  }
}


