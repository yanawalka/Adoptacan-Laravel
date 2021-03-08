<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UserFormRequest;
use DB;
use Illuminate\Support\Facades\Crypt;

class UsersController extends Controller
{
   //public function __construct(){
    // $this->middleware('auth');
   //}
   public function __construct(){
     $this->middleware('auth');
   }
  public function index(){
    $users = User::orderBy('name','ASC')->paginate(10);
    return view('admin.users.index')->with('users',$users);

    

  }

  public function show($id){

    $usuario = DB::table('USERS')
    ->select('id','name','email','created_at','tipo','baja')
    ->where('id','=',$id)
    ->where("COALESCE(baja,'N')",'=','N')
    ->first();
    
    return view("nvopwd.index")->with('usuario',$usuario);

  }

  public function create(){
  	//dd('Hola esto es un mensaje');
    return view("admin.users.create");
  }

  public function store(UserFormRequest $request){
    $user = new User;
    $user->name = $request->get('name');
    $user->email = $request->get('email');
    $user->tipo = $request->get('tipo');
    $user->password = bcrypt($request->get('password'));
    $user->baja = 'N';
    $user->save();
    return Redirect::to('admin/users');
  }

  public function edit($id){
    $user = User::find($id);
    return view('admin.users.edit')->with('user',$user);
  }

  public function update(Request $request, $id){
   
    $usuario=User::findOrFail($id);
    $usuario->tipo=$request->get('tipo');
    $usuario->name=$request->get('name');
    $usuario->email=$request->get('email');
    //$usuario->password= bcrypt($request->get('password'));
    $usuario->update();
    return Redirect::to('admin/users');
  }

  public function destroy(Request $request, $id){
    
    $usuario=User::findOrFail($id);
    $usuario->baja = 'S';
    $usuario->update();
    return Redirect::to('admin/users');
  }

}

