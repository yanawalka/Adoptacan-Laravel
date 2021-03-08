<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Perro;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RazasFormRequest;
use DB;
use Laracasts\Flash\Flash;
use App\Raza;
use App\Solicitud;
use App\Propietario;
use Carbon\Carbon;
use Validator;

class PerrosController extends Controller
{

public function __construct()
{
  $this->middleware('auth');
}





public function index(Request $request,$persona=null){
    
    if ($request) {
        $query=strtoupper(trim($request->get('perros')));
        $propietario = Propietario::find($persona);
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
        ->where('upper(apodo)','LIKE','%'.$query.'%')
        ->where('p.idpropietario','=',null)
        ->where(function ($query) {
                $query->where("to_number(to_char(p.fechadeceso,'Y'))", '>', 2000)
                      ->orWhere('p.fechadeceso', '=', null);})
        ->orderBy('f_get_solicitud_perros(p.id)','ASC')
        ->orderBy('p.visible','DESC')
        ->orderBy('p.apodo','ASC')
        ->paginate(10);
        return view('admin.perros.index',['perros'=>$perros,'persona'=>$propietario]);
    }
    else{
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
        ->where(function ($query) {
                $query->where("to_number(to_char(p.fechadeceso,'Y'))", '>', 2000)
                      ->orWhere('p.fechadeceso', '=', null);})
        ->orderBy('f_get_solicitud_perros(p.id)','ASC')
        ->orderBy('p.visible','DESC')
        ->orderBy('p.apodo','ASC')
        ->paginate(10);
    	return view('admin.perros.index',['perros'=>$perros,'persona'=>$propietario]);
    }
  }  


public function index_sol($id){
    
        //$query=strtoupper(trim($request->get('perros')));

        $perros = DB::table('solicitudes as s')
        ->join('perros as p',function ($join) {$join->on("decode(s.porte,'-',p.porte,s.porte)", '=', "p.porte")
          ->On("decode(s.ninios,1,1,0,p.ninios,-1,p.ninios)" ,'=', "p.ninios")
          ->On("(sysdate - p.fechanac)/30", 'between',
                                                    "case s.edad
                                                        when '-' then 0
                                                        when 'cachorro' then 0
                                                        when 'joven' then 6
                                                        when 'adulto' then 18
                                                        when 'anciano' then 84  
                                                    end
                                                   and
                                                   case s.edad
                                                        when '-' then 1000
                                                        when 'cachorro' then 5.99
                                                        when 'joven' then 17.99
                                                        when 'adulto' then 83.99
                                                        when 'anciano' then 1000 
                                                    end")
          ->On("DECODE(s.actividad,'NO DETERMINADA',p.actividad,'MEDIA','M','BAJA','B','ALTA','A')" ,'=',"p.actividad")
          ->On("DECODE(s.guardian,'-',p.guardian,s.guardian)",'=', "p.guardian")
          ->On("DECODE(s.sexo,'-',p.sexo,s.sexo)" ,'=', "p.sexo")
          ->On("DECODE(s.depto,'-',p.depto,'N',p.depto,s.depto) ",'=', 'p.depto')
          ->On("DECODE(s.otrosperros,'-',p.otrosperros,'N',p.otrosperros,s.otrosperros)" ,'=', "p.otrosperros")
          ->On("DECODE(s.gatos,'-',p.gatos,'N',p.gatos,s.gatos)",'=', "p.gatos") ;                                           })
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
        'p.gatos',"decode (p.gatos,'S','SI','N','NO','--') ngatos",'p.alimentodiario','p.foto','p.visible','f_get_solicitud_perros(p.id) cant','f_get_sugerencia_perro(p.id) sug','s.id solicitud'  )
        ->where('s.id','=',$id)
        ->where('p.visible','=','S')
        ->where('s.activa','<>','X')
        ->where('p.idpropietario','=',null)
        ->where(function ($query) {
                $query->where("to_number(to_char(p.fechadeceso,'Y'))", '>', 2000)
                      ->orWhere('p.fechadeceso', '=', null);})
        ->orderBy('p.apodo','ASC')
        ->paginate(10);
        $solicitud = Solicitud::find($id);
        return view('admin.perros.index_sol',['perros'=>$perros,'solicitud'=>$solicitud]);
  }  


  public function index_sug($id){
    
        //$query=strtoupper(trim($request->get('perros')));

        $perros = DB::table('solicitudes as s')
        ->join('perros as p',function ($join) {$join
          ->On("DECODE(s.actividad,'NO DETERMINADA',p.actividad,'MEDIA','M','BAJA','B','ALTA','A')" ,'=',"p.actividad")
          ->On("DECODE(s.depto,'-',p.depto,'N',p.depto,s.depto) ",'=', 'p.depto')
          ->On("DECODE(s.otrosperros,'-',p.otrosperros,'N',p.otrosperros,s.otrosperros)" ,'=', "p.otrosperros")
          ->On("DECODE(s.gatos,'-',p.gatos,'N',p.gatos,s.gatos)",'=', "p.gatos")
          ->On("decode(s.ninios,1,1,0,p.ninios,-1,p.ninios)" ,'=', "p.ninios") ;  })
        ->join('razas as r','r.ID','=','p.RAZA_ID')
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
        ->where('s.id','=',$id)
        ->where('p.visible','=','S')
        ->where('p.idpropietario','=',null)
        ->where(function ($query) {
                $query->where("to_number(to_char(p.fechadeceso,'Y'))", '>', 2000)
                      ->orWhere('p.fechadeceso', '=', null);})
        ->where('s.activa','<>','X')
        ->orderBy('p.apodo','ASC')
        ->paginate(10);
        $solicitud = Solicitud::find($id);
        return view('admin.perros.index_sol',['perros'=>$perros,'solicitud'=>$solicitud]);
  }  









  public function create(){
      //return view("ver.razas.create");
      $razas = Raza::orderBy('nombre','ASC')->lists('nombre','id');
      $propietarios = Propietario::selectRaw(" apellido|| ' '|| nombres  as apellido, id ")
        ->lists('apellido','id');

      return view('admin.perros.create',['razas'=>$razas,'propietarios'=>$propietarios])
        ->with('razas',$razas);
  }


public function datosrazas(Request $request){
      $id = $request->idraza;

     
      $datosraza =  DB::table("razas")
        -> select ("porte as PORTE","ninios as NINIOS","evida as EVIDA" )
        -> where('id', '=', $id)
        -> get();
      //dd($raza);
       return view('admin.perros.datosraza')->with('razas',$datosraza);
    }




  public function store(Request $request){
    $path='';
    $name='';

    if ($request->file('foto'))
    {


        $validacion = true;

          $file =$request->file('foto');
          $name = 'can_' . time() . '.'.$file->getClientOriginalExtension();

          $path = public_path().'/images/canes/';
     
          $file->move($path,$name);
  //aquí en el caso de que este todo bien
        

      
      
    }
    $mytime = Carbon::now()->subYear($request->anios)->subMonth($request->meses)->subDay($request->dias); 
    $perro = new Perro($request->all());
    $perro->chip = $request->chip;
    $perro->raza_id = $request->raza_id;
    $perro->fechanac = $mytime;
    $perro->porte = $request->porte;
    $perro->ninios = $request->ninios;
    $perro->actividad = $request->actividad;
    $perro->guardian = $request->guardian;
    $perro->sexo = $request->sexo;
    $perro->castrado = $request->castrado;
    $perro->depto = $request->depto;
    $perro->otrosperros = $request->otrosperros;
    $perro->gatos = $request->gatos;
    $perro->alimentodiario = $request->alimentodiario;
    $perro->foto = $name;
    $perro->apodo = $request->apodo;
    $perro->visible = $request->visible;
    $perro->idpropietario = $request->idpropietario;
    $perro->save();
    Flash::success("Se ha grabado el perro" . $perro->apodo);
    return Redirect::to('admin/perros');
  }

    public function edit($id){
      $razas = Raza::orderBy('nombre','ASC')->lists('nombre','id');
      $propietarios = Propietario::selectRaw(" apellido|| ' '|| nombres  as apellido, id ")
        ->lists('apellido','id');
      
      $perro = Perro::find($id);
      $edad = DB::table('DUAL')
        -> select ("f_get_edad($id,sysdate) as edad" )
        -> first();
        
  
      return view('admin.perros.edit',['perro'=>$perro,'prop'=>$propietarios,'razas'=>$razas, 'edad'=>$edad->edad]);
  }

    public function update(Request $request, $id){
      $perro = Perro::find($id);

      $mytime = Carbon::now()->subYear($request->anios)->subMonth($request->meses)->subDay($request->dias); 
      
      
      $perro->chip = $request->chip;
      $perro->raza_id = $request->raza_id;
      $perro->fechanac = $mytime;
      $perro->porte = $request->porte;
      $perro->ninios = $request->ninios;
      $perro->actividad = $request->actividad;
      $perro->guardian = $request->guardian;
      $perro->sexo = $request->sexo;
      $perro->castrado = $request->castrado;
      $perro->depto = $request->depto;
      $perro->otrosperros = $request->otrosperros;
      $perro->gatos = $request->gatos;
      $perro->alimentodiario = $request->alimentodiario;
      $perro->foto = $request->foto;
      $perro->apodo = $request->apodo;
      $perro->visible = $request->visible;
      $perro->seguimiento = $request->seguimiento;
      $perro->idpropietario = $request->idpropietario;
     
      $perro->update();

      Flash::success("Se han modificado los datos del perro" . $perro->apodo);
      return Redirect::to('admin/perros');
    }


  public function destroy(Request $request, $id){

    $perro = Perro::find($id);

    $perro->visible = 'N';
    $perro->update();
      Flash::success("Se han modificado los datos del perro" . $perro->apodo);
      return Redirect::to('admin/perros');
  }


  public function cambiarfoto(Request $request, $id){


    $perro = Perro::find($id);

    return view('admin.perros.foto',['perro'=>$perro]);
  }


  public function updatefoto(Request $request, $id){


      $validator = Validator::make($request->all(),['foto' => 'image|max:10000',]);

      if ($validator->fails()){
        return redirect('home/perfil')
          ->withErrors($validator)
          ->withInput();
      }

      $perro = Perro::find($id);
      
      if ($request->file('foto')){
        $validacion = true;
        //dd($request);
         //$img = ImageCreateFromJpeg($request->file('foto=> UploadedFile'));
         $file =$request->file('foto');
         //$file2 = resizeMax($request,500,500);
         $br = chr(92);
         //$file2 = icreate($file->getPathName().$br.$file->getClientOriginalName());

        //dd(imagesx($file->getPathName().$br.$file->getClientOriginalName() ));
         
         //
     
        $name = 'can_' . time() . '.'.$file->getClientOriginalExtension();

        $path = public_path().'/images/canes/';

        
        $file->move($path,$name);

         $perro->foto = $name;
     
        $perro->update();
         Flash::success("Se han modificado los datos del perro" . $perro->apodo);

  //aquí en el caso de que este todo bien
        
       
       
      }
  

     
      return Redirect::to('admin/perros');


        



    }


   public function adoptar($id,$sol){

      

      
      $perro = Perro::find($id);
      $solicitud = Solicitud::find($sol);
      $persona = Propietario::find($solicitud->adoptante_id);
      $razas = Raza::orderBy('nombre','ASC')->lists('nombre','id');
      $edad = DB::table('DUAL')
        -> select ("f_get_edad($id,sysdate) as edad" )
        -> first();  
  
      return view('admin.adopciones.adoptar',['perro'=>$perro,'solicitud'=>$solicitud,'razas'=>$razas, 'edad'=>$edad->edad,'persona'=>$persona]);
  }



   public function adoptarciego($id,$persona){


      
      $perro = Perro::find($id);
      $persona = Propietario::find($persona);
      
      $razas = Raza::orderBy('nombre','ASC')->lists('nombre','id');
      $edad = DB::table('DUAL')
        -> select ("f_get_edad($id,sysdate) as edad" )
        -> first();  
  
      return view('admin.adopciones.adoptarciego',['perro'=>$perro,'razas'=>$razas,'persona'=>$persona, 'edad'=>$edad->edad]);
  }


}

