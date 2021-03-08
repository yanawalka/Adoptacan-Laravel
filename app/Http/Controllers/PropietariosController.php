<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Propietario;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PropietariosFormRequest;
use DB;
use Laracasts\Flash\Flash;
use Validator;
class PropietariosController extends Controller
{

public function __construct()
{
  $this->middleware('auth');
}

public function hereda(){
  $lista =  DB::table('adoptantes')
        ->selectRaw(" apellido|| ' '|| nombres || ' ' || email as nombre, id ")
        ->lists('nombre','id');
  return view('admin.propietarios.hereda')->with('adoptantes',$lista);;
}
public function index(Request $request){
    
    if ($request) {
        $query=strtoupper(trim($request->get('propietarios')));

        $propietarios = DB::table('propietarios')
        ->select('id','apellido','nombres','email','dni','celular','certcarencia','foto','fechacert','domicilio','referencia','f_get_perrosxprop(id) cantidad')
        ->where('upper(apellido)','LIKE','%'.$query.'%')
        ->orderBy('apellido','nombres')
        ->paginate(10);
        return view('admin.propietarios.index')->with('propietarios',$propietarios);
    }
    else{
      $propietarios = Propietarios::orderBy('apellido', 'nombre','ASC')->paginate(10);
    return view('admin.propietarios.index')->with('propietarios',$propietarios);
    }


  }  

  public function create(){
      //return view("ver.razas.create");
      return view('admin.propietarios.create');
  }

  public function store(Request $request){
    $path='';
    $name='';

   
      if ($request->file('foto'))
      {


          $validacion = true;

            $file =$request->file('foto');
            $name = 'prop_' . time() . '.'.$file->getClientOriginalExtension();

            $path = public_path().'/images/propietarios/';
       
            $file->move($path,$name);
    //aquí en el caso de que este todo bien
          

        
        
      }
      $propietario = new Propietario;
      $propietario->dni=$request->get('dni');
      $propietario->nombres = $request->get('nombres');
      $propietario->apellido = $request->get('apellido');
      $propietario->email = $request->get('email');
      $propietario->celular = $request->get('celular');
      //$propietario->clave = $request->get('clave');
      $propietario->certcarencia = $request->get('certcarencia');
      if ($propietario->certcarencia == 'S'){
          $propietario->fechacert = $request->get('fechacert');
      } else {
        $propietario->fechacert = NULL;
      } 
      $propietario->domicilio = $request->get('domicilio');
      $propietario->referencia = $request->get('referencia');
      $propietario->foto = $name;
      $propietario->save();
      return Redirect::to('admin/propietarios');
      //$razas=new Razas;
      //$razas->nombre=$request->get('nombre');
      //$razas->save();
      //return Redirect::to('ver/razas');
  
}


  public function show(){

  }

  public function edit($id){
      $propietario = Propietario::find($id);
      return view('admin.propietarios.edit')->with('propietario',$propietario);
  }

  public function update(Request $request, $id){
    $propietario = Propietario::find($id);
    $propietario->dni=$request->get('dni');
    $propietario->nombres = $request->get('nombres');
    $propietario->apellido = $request->get('apellido');
    $propietario->email = $request->get('email');
    $propietario->celular = $request->get('celular');
    //$propietario->clave = $request->get('clave');
    $propietario->certcarencia = $request->get('certcarencia');
    if ($propietario->certcarencia == 'S'){
        $propietario->fechacert = $request->get('fechacert');
    } else {
      $propietario->fechacert = NULL;
    } 
     $propietario->domicilio = $request->get('domicilio');
    $propietario->referencia = $request->get('referencia');
    $propietario->save();
    Flash::success("Se ha modificado la persona" . $propietario->nombre);
    return Redirect::to('admin/propietarios');
  }


  public function destroy($id){
    $propietario=DB::table('propietarios')->where('id','=',$id)->delete();
    return Redirect::to('admin/propietarios');
  }



  public function cambiarfoto(Request $request, $id){


    $prop = Propietario::find($id);

    return view('admin.propietarios.foto',['propietario'=>$prop]);
  }


  public function updatefoto(Request $request, $id){


      $validator = Validator::make($request->all(),['foto' => 'image|max:10000',]);

      if ($validator->fails()){
        return redirect('home/perfil')
          ->withErrors($validator)
          ->withInput();
      }

      $propietario = Propietario::find($id);
      
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
     
        $name = 'prop_' . time() . '.'.$file->getClientOriginalExtension();

        $path = public_path().'/images/propietarios/';

        
        $file->move($path,$name);

         $propietario->foto = $name;
     
        $propietario->update();
         Flash::success("Se han modificado los datos " . $propietario->apellido);

  //aquí en el caso de que este todo bien
        
       
       
      }
  

     
      return Redirect::to('admin/propietarios');


        



    }







  public function datospersona(Request $request){
      $id = $request->idadoptante;

     
      $datospersona =  DB::table("adoptantes")
        -> select ("id","email as EMAIL","apellido as APELLIDO","nombres AS NOMBRE","celular as CELULAR" )
        -> where('id', '=', $id)
        -> get();
      
       return view('admin.propietarios.datospersona')->with('personas',$datospersona);
    }




}


