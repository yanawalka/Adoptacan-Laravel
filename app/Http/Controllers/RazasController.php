<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Raza;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RazasFormRequest;
use DB;
use Laracasts\Flash\Flash;

class RazasController extends Controller
{

public function __construct()
{
  $this->middleware('auth');
}

public function index(Request $request){
    
    if ($request) {
        $query=strtoupper(trim($request->get('razas')));

        $razas = DB::table('razas')
        ->select('id','nombre','porte','ninios','evida')
        ->where('upper(nombre)','LIKE','%'.$query.'%')
        ->orderBy('nombre')
        ->paginate(10);
        return view('admin.razas.index')->with('razas',$razas);
    }
    else{
      $razas = Raza::orderBy('nombre','ASC')->paginate(10);
    return view('admin.razas.index')->with('razas',$razas);
    }


  }  

  public function create(){
      //return view("ver.razas.create");
      return view('admin.razas.create');
  }

  public function store(Request $request){
    $raza = new Raza;
    $raza->nombre = $request->get('name');
    $raza->porte = $request->get('porte');
    $raza->ninios = $request->get('ninios');
    $raza->evida = $request->get('evida');
    $raza->save();
    return Redirect::to('admin/razas');
    //$razas=new Razas;
    //$razas->nombre=$request->get('nombre');
    //$razas->save();
    //return Redirect::to('ver/razas');
  }


  public function show(){

  }

  public function edit($id){
      $raza = Raza::find($id);
      return view('admin.razas.edit')->with('raza',$raza);
  }

  public function update(Request $request, $id){
    $raza = Raza::find($id);
    $raza->nombre = $request->name;
    $raza->porte = $request->porte;
    $raza->ninios = $request->ninios;
    $raza->evida = $request->evida;
    $raza->save();
    Flash::success("Se ha modificado la raza" . $raza->nombre);
    return Redirect::to('admin/razas');
  }


  public function destroy($id){
    $razas=DB::table('RAZAS')->where('id','=',$id)->delete();
    return Redirect::to('admin/razas');
  }
}


