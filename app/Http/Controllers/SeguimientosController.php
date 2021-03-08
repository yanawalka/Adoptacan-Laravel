<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Perro;
use App\Seguimiento;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RazasFormRequest;
use DB;
use Laracasts\Flash\Flash;
use App\Raza;
use App\Solicitud;
use App\Propietario;
use Carbon\Carbon;
use Validator;

class SeguimientosController extends Controller
{

public function __construct()
{
  $this->middleware('auth');
}

  public function imprime(Request $request,$id){
        $perro = Perro::find($id);
        $raza = Raza::find($perro->raza_id);
        $seguimiento = DB::table('perros as p')
      -> join ('razas as r','r.ID','=','p.RAZA_ID')
      ->leftjoin('propietarios as pr','pr.id','=','p.idpropietario')
      ->leftjoin('seguimiento as s','s.idcan','=','p.id')
        ->select ('p.id idperro', 'p.chip CHIP','P.APODO APODO','f_get_tiempo(p.fechanac) EDAD','coalesce(P.IDPROPIETARIO,0) IDPR','PR.APELLIDO APELLIDO',
          'PR.NOMBRES NOMBRES','PR.CELULAR CELULAR','PR.FECHACERT FECHACERT','PR.EMAIL EMAIL','p.foto FOTO','f_get_cantseg(p.id) cantseg',
          's.fecha','s.detalle','s.usuario','S.CREATED_AT','S.UPDATED_AT','s.id as IDSEG')
        ->where ('p.id','=',$id)
        ->orderBy ('s.fecha')
        ->paginate(10);

    return view('admin.seguimientos.imprime',['perro'=>$perro,'seguimiento'=>$seguimiento,'raza'=>$raza]);


  }  



public function index(Request $request,$persona = null){
  if ($request->apodo){
    $busqueda = $request->apodo;  
    $seguimiento = DB::table('perros as p')
      -> join ('razas as r','r.ID','=','p.RAZA_ID')
      ->leftjoin('propietarios as pr','pr.id','=','p.idpropietario')
        ->select ('p.id idperro', 'p.chip CHIP','P.APODO APODO','f_get_tiempo(p.fechanac) EDAD','coalesce(P.IDPROPIETARIO,0) IDPR','PR.APELLIDO APELLIDO',
          'PR.NOMBRES NOMBRES','PR.CELULAR CELULAR','PR.FECHACERT FECHACERT','PR.EMAIL EMAIL','p.foto FOTO','f_get_cantseg(p.id) cantseg')
        -> where ('lower(p.apodo)','like','%'.snake_case($busqueda).'%')
        -> orwhere ('lower(pr.apellido)','like','%'.snake_case($busqueda).'%')
        -> orwhere ('lower(p.chip)','like','%'.snake_case($busqueda).'%')
        ->paginate(10);

      return view('admin.seguimientos.index',['seguimientos'=>$seguimiento]);

  } else {

    if ($persona) {
       
        
        
        $query=strtoupper(trim($request->get('perros')));
       $seguimiento = DB::table('perros as p')
      -> join ('razas as r','r.ID','=','p.RAZA_ID')
      ->leftjoin('propietarios as pr','pr.id','=','p.idpropietario')
        ->select ('p.id idperro', 'p.chip CHIP','P.APODO APODO','f_get_tiempo(p.fechanac) EDAD','coalesce(P.IDPROPIETARIO,0) IDPR','PR.APELLIDO APELLIDO',
          'PR.NOMBRES NOMBRES','PR.CELULAR CELULAR','PR.FECHACERT FECHACERT','PR.EMAIL EMAIL','p.foto FOTO','f_get_cantseg(p.id) cantseg')
        -> where ('pr.id','=',$persona)
        ->paginate(10);

      return view('admin.seguimientos.index',['seguimientos'=>$seguimiento]);
    }
    else{
      $seguimiento = DB::table('perros as p')
      -> join ('razas as r','r.ID','=','p.RAZA_ID')
      ->leftjoin('propietarios as pr','pr.id','=','p.idpropietario')
        ->select ('p.id idperro', 'p.chip CHIP','P.APODO APODO','f_get_tiempo(p.fechanac) EDAD','coalesce(P.IDPROPIETARIO,0) IDPR','PR.APELLIDO APELLIDO',
          'PR.NOMBRES NOMBRES','PR.CELULAR CELULAR','PR.FECHACERT FECHACERT','PR.EMAIL EMAIL','p.foto FOTO','f_get_cantseg(p.id) cantseg')
        ->paginate(10);

    	return view('admin.seguimientos.index',['seguimientos'=>$seguimiento]);
    }
  }  
}


public function historia(Request $request,$idcan){

    if ($request) {
        $query=strtoupper(trim($request->get('perros')));
       $seguimiento = DB::table('perros as p')
      -> join ('razas as r','r.ID','=','p.RAZA_ID')
      ->leftjoin('propietarios as pr','pr.id','=','p.idpropietario')
      ->leftjoin('seguimiento as s','s.idcan','=','p.id')
        ->select ('p.id idperro', 'p.chip CHIP','P.APODO APODO','f_get_tiempo(p.fechanac) EDAD','coalesce(P.IDPROPIETARIO,0) IDPR','PR.APELLIDO APELLIDO',
          'PR.NOMBRES NOMBRES','PR.CELULAR CELULAR','PR.FECHACERT FECHACERT','PR.EMAIL EMAIL','p.foto FOTO','f_get_cantseg(p.id) cantseg',
          's.fecha','s.detalle','s.usuario','S.CREATED_AT','S.UPDATED_AT','s.id as IDSEG')
        ->where ('p.id','=',$idcan)
        ->orderBy ('s.fecha')
        ->paginate(10);

      return view('admin.seguimientos.historia',['seguimiento'=>$seguimiento,'idperro'=>$idcan]);
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
        ->where('s.activa','<>','X')
        ->orderBy('p.apodo','ASC')
        ->paginate(10);
        $solicitud = Solicitud::find($id);
        return view('admin.perros.index_sol',['perros'=>$perros,'solicitud'=>$solicitud]);
  }  









  public function create($perroid){
     
      //return view("ver.razas.create");
      //$razas = Raza::orderBy('nombre','ASC')->lists('nombre','id');
      $perro = Perro::find($perroid);
      $propietario = Propietario::find($perro->idpropietario);
      return view('admin.seguimientos.create',['perro'=>$perro,'propietario'=>$propietario]);
       
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

    $mytime = Carbon::now()->subYear($request->anios)->subMonth($request->meses)->subDay($request->dias); 
    $seguimiento = new Seguimiento($request->all());
    $seguimiento->idcan = $request->idcan;
    $seguimiento->fecha = $request->fecha;
    $seguimiento->detalle = $request->detalle;
    $seguimiento->usuario = auth()->user()->name;
    $seguimiento->save();
    Flash::success("Se ha grabado el seguimento");

    $idcan = $seguimiento->idcan;

       $query=strtoupper(trim($request->get('perros')));
       $datos = DB::table('perros as p')
      -> join ('razas as r','r.ID','=','p.RAZA_ID')
      ->leftjoin('propietarios as pr','pr.id','=','p.idpropietario')
      ->leftjoin('seguimiento as s','s.idcan','=','p.id')
        ->select ('p.id idperro', 'p.chip CHIP','P.APODO APODO','f_get_tiempo(p.fechanac) EDAD','coalesce(P.IDPROPIETARIO,0) IDPR','PR.APELLIDO APELLIDO',
          'PR.NOMBRES NOMBRES','PR.CELULAR CELULAR','PR.FECHACERT FECHACERT','PR.EMAIL EMAIL','p.foto FOTO','f_get_cantseg(p.id) cantseg',
          's.fecha','s.detalle','s.usuario','S.CREATED_AT','S.UPDATED_AT','s.id as IDSEG')
        ->where ('p.id','=',$request->idcan)
        ->orderBy ('s.fecha')
        ->paginate(10);


    return view('admin.seguimientos.historia',['seguimiento'=>$datos,'idperro'=>$idcan]);

  }


//return view('admin.seguimientos.historia',['seguimiento'=>$seguimiento,'idperro'=>$idcan]);


    public function edit($id){
    
      $seguimiento = Seguimiento::find($id);
      $perro = Perro::find($seguimiento->idcan);
        
  
      return view('admin.seguimientos.edit',['perro'=>$perro,'seguimiento'=>$seguimiento]);
  }

    public function update(Request $request, $id){
      $seguimiento = Seguimiento::find($id);

      $mytime = Carbon::now()->subYear($request->anios)->subMonth($request->meses)->subDay($request->dias); 
      
      $seguimiento->fecha = $request->get('fecha');
      $seguimiento->detalle = $request->get('detalle');
      $seguimiento->save();
      Flash::success("Se ha modificado el registro");
      return Redirect::to('admin/seguimientos');
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

