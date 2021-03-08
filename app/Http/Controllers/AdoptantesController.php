<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Adoptante;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AdoptantesFormRequest;
use DB;
use Laracasts\Flash\Flash;

class AdoptantesController extends Controller
{

public function __construct()
{
  $this->middleware('auth');
}

public function index(Request $request){
    
    if ($request) {
        $query=strtoupper(trim($request->get('adoptantes')));

        $adoptantes = DB::table('adoptantes')
        ->select('id','apellido','nombres','email')
        ->where('upper(nombres)','LIKE','%'.$query.'%')
        ->orderBy('apellido','nombres')
        ->paginate(10);
        return view('admin.adoptantes.index')->with('adoptantes',$adoptantes);
    }
    else{
      $adoptantes = Adoptante::orderBy('apellido', 'nombre','ASC')->paginate(10);
    return view('admin.adoptantes.index')->with('adoptantes',$adoptantes);
    }


  }  

  public function create(){
      //return view("ver.razas.create");
      return view('admin.adoptantes.create');
  }

  public function store(Request $request){
    $adoptante = new Adoptante;
    $adoptante->nombre = $request->get('name');
    $adoptante->apellido = $request->get('apellido');
    $adoptante->email = $request->get('email');
    $adoptante->celular = $request->get('celular');
    $adoptante->clave = $request->get('clave');
    $adoptante->save();
    return Redirect::to('admin/adoptantes');
    //$razas=new Razas;
    //$razas->nombre=$request->get('nombre');
    //$razas->save();
    //return Redirect::to('ver/razas');
  }


  public function show(){

  }

  public function edit($id){
      $adoptante = Adoptante::find($id);
      return view('admin.adoptantes.edit')->with('adoptante',$adoptante);
  }

  public function update(Request $request, $id){
    $adoptante = Adoptante::find($id);
    $adoptante->apellido = $request->apellido;
    $adoptante->nombre = $request->nombre;
    $adoptante->celular = $request->celular;
    $adoptante->clave = $request->clave;
    $adoptante->email = $request->email;
    $adoptante->save();
    Flash::success("Se ha modificado la persona" . $adoptante->nombre);
    return Redirect::to('admin/adoptantes');
  }


  public function destroy($id){
    $adoptante=DB::table('ADOPTANTES')->where('id','=',$id)->delete();
    return Redirect::to('admin/adoptantes');
  }
}


