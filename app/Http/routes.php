<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});



Route::group(['prefix' => 'admin'], function(){

	Route::resource('razas','RazasController');
	Route::get('razas/{id}/destroy',[
		'uses'=> 'RazasController@destroy',
		'as'  =>  'admin.razas.destroy'	
		]);
	Route::resource('users','UsersController');

	Route::get('users/{id}/destroy',[
		'uses'=> 'UsersController@destroy',
		'as'  =>  'admin.users.destroy'	
		]);
	Route::resource('perros','PerrosController');
	Route::get('perros/{id}/destroy',[
		'uses'=> 'PerrosController@destroy',
		'as'  =>  'admin.perros.destroy'	
		]);	

	Route::get('perros/{persona?}/index',[
		'uses'=> 'PerrosController@index',
		'as'  =>  'admin.perros.index'	
		]);	
	Route::get('perros/create',[
		'uses'=> 'PerrosController@create',
		'as'  =>  'admin.perros.create'	
		]);	

	Route::get('perros/{id}/cambiarfoto',[
		'uses'=> 'PerrosController@cambiarfoto',
		'as'  =>  'admin.perros.cambiarfoto'	
		]);	
	Route::post('perros/{id}/updatefoto',[
		'uses'=> 'PerrosController@updatefoto',
		'as'  =>  'admin.perros.updatefoto'	
		]);	
	
	Route::get('perros/{id}/index_sol',[
		'uses'=> 'PerrosController@index_sol',
		'as'  =>  'admin.perros.index_sol'
		]);	

	Route::get('perros/{id}/index_sug',[
		'uses'=> 'PerrosController@index_sug',
		'as'  =>  'admin.perros.index_sug'
		]);	

	Route::get('perros/{id}/{sol}/adoptar',[
		'uses'=> 'PerrosController@adoptar',
		'as'  =>  'admin.perros.adoptar'
		]);	
		Route::get('perros/{id}/{persona}/adoptarciego',[
		'uses'=> 'PerrosController@adoptarciego',
		'as'  =>  'admin.perros.adoptarciego'
		]);	

		

	Route::resource('solicitudes','SolicitudesController');
	Route::get('solicitudes/{id}/destroy',[
		'uses'=> 'SolicitudesController@destroy',
		'as'  =>  'admin.solicitud.destroy'	
		]);	
	Route::get('solicitudes/{id}/edit',[
		'uses'=> 'SolicitudesController@edit',
		'as'  =>  'admin.solicitud.edit'	
		]);

	Route::get('solicitudes/{id}/index_can',[
		'uses'=> 'SolicitudesController@index_perros',
		'as'  => 'admin.perros.index_can']);
		
	Route::get('solicitudes/{id}/index_perros_sug',[
		'uses'=> 'SolicitudesController@index_perros_sug',
		'as'  => 'admin.perros.index_perros_sug']);

	Route::resource('adopciones','AdopcionesController');

	Route::get('adopciones/{id}/imprime',[
		'uses'=> 'AdopcionesController@imprime',
		'as'  => 'admin.adopciones.imprime']);

	Route::put('adopciones/{id}/{persona}/createciega',[
		'uses'=> 'AdopcionesController@createciega',
		'as'  =>  'admin.adopciones.createciega'
		]);	


	Route::get('adopciones/estadisticas',[
		'uses'=> 'AdopcionesController@estadisticas',
		'as'  => 'admin.adopciones.estadisticas']);

		Route::get('propietarios/hereda',[
		'uses'=> 'PropietariosController@hereda',
		'as'  =>  'admin.propietarios.hereda'	
		]);	


	Route::resource('adoptantes','AdoptantesController');

	Route::resource('propietarios','PropietariosController');
		Route::get('propietarios/{id}/destroy',[
		'uses'=> 'PropietariosController@destroy',
		'as'  =>  'admin.propietarios.destroy'	
		]);	


		Route::get('propietarios/create',[
		'uses'=> 'PropietariosController@create',
		'as'  =>  'admin.propietarios.create'	
		]);	


	
	
		Route::put('propietarios/{id}/update',[
		'uses'=> 'PropietariosController@update',
		'as'  =>  'admin.propietarios.update'	
		]);	

	Route::get('propietarios/{id}/cambiarfoto',[
		'uses'=> 'PropietariosController@cambiarfoto',
		'as'  =>  'admin.propietarios.cambiarfoto'	
		]);	
	Route::post('propietarios/{id}/updatefoto',[
		'uses'=> 'PropietariosController@updatefoto',
		'as'  =>  'admin.propietarios.updatefoto'	
		]);	
	


	Route::resource('seguimientos','SeguimientosController');

	Route::get('seguimientos/{id}/imprime',[
		'uses'=> 'SeguimientosController@imprime',
		'as'  => 'admin.seguimientos.imprime']);

	Route::get('seguimientos/{id}/historia',[
		'uses'=> 'SeguimientosController@historia',
		'as'  => 'admin.seguimientos.historia']);

	Route::get('seguimientos/{id}/create',[
		'uses'=> 'SeguimientosController@create',
		'as'  => 'admin.seguimientos.create']);

	Route::get('seguimientos/{id?}/index',[
		'uses'=> 'SeguimientosController@index',
		'as'  => 'admin.seguimientos.index']);

	Route::put('seguimientos/{id}/update',[
		'uses'=> 'SeguimientosController@update',
		'as'  =>  'admin.seguimientos.update'	
		]);	
	



});

//Rutas para el front de Portal web de adopciones caninas
Route::get('/', 'FrontController@index')->name('front');
Route::get('/buscador', 'FrontController@buscador')->name('buscador');
Route::get('/formulario', 'FrontController@getform')->name('getform');
Route::get('formulario/{id}', 'FrontController@getform2')->name('getform2');
//fin rutas <front></front>

Route::get('/datosraza','PerrosController@datosrazas');

Route::get('/datospersona','PropietariosController@datospersona');

Route::get('/datosprop','AdopcionesController@datosprop');

Route::put('adopciones/{perro_id}/{persona_id}/{edad_valor}/{solicitud_id}/create',[
	'uses' => 'AdopcionesController@create',
	'as'=> 'admin.adopciones.create']);




Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('usuarios','UsersController');
Route::resource('usuarios/nvopwd','UsersController2');
Route::resource('cambiausers','UsersController');

