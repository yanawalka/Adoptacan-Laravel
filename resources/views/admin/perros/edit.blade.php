@extends('admin')


@section('title','Modificar Datos del Animal')


@section('content')

	{!! Form::open(['route' => ['admin.perros.update',$perro->id],'method' => 'PUT']) !!}


		
		
		<div class="form-group">	


			<div class="row">
				
				<div class="col-lg-4 col-md-5 col-sm-6 col-xs-10">
					{!! Form::label('chip','Chip / Identificacion Unica')!!}
					{!! Form::text('chip',$perro->chip,['class' => 'form-control', 'placeholder' => 'Identificación' ,'required']) !!}
				</div>	
				
				<div class="col-lg-4 col-md-5 col-sm-6 col-xs-10">
					{!! Form::label('raza_id','Raza') !!}
					{!! Form::select('raza_id',$razas,$perro->raza_id,['class' => 'form-control', 'placeholder' => 'Seleccione Raza' ,'required']) !!}
				</div>	
				<div class="col-lg-1">
					
					{!! Form::label('mestizo','Mestizo') !!}
					{!! Form::select('mestizo',['S'=>'Si' ,'N'=>'No'],$perro->mestizo,['class'=>'form-control']) !!}
				</div>
				<div class="col-lg-4 col-md-5 col-sm-6 col-xs-10">	
					{!! Form::label('apodo','Apodo') !!}
					{!! Form::text('apodo',$perro->apodo,['class' => 'form-control', 'placeholder' => 'Apodo']) !!}
				</div>	
			</div>
		<br>

			<div class="row">

                    <div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
						{!! Form::label('anios','Años') !!}
						{!! Form::select('anios',['0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18'],substr($edad,1,2),['class'=>'form-control']) !!}			
					</div>	
					<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
						{!! Form::label('meses','Meses') !!}
						{!! Form::select('meses',['0',1,2,3,4,5,6,7,8,9,10,11,12],substr($edad,4,2),['class'=>'form-control']) !!}			
					</div>	

					<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
						{!! Form::label('dias','Dias') !!}
						{!! Form::select('dias',['00','01','02','03','04','05','06','07','08','09',10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],substr($edad,7,2),['class'=>'form-control']) !!}			
					</div>	
					
		
			
				<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
					{!! Form::label('sexo','Sexo') !!}
					{!! Form::select('sexo',['M'=>'Macho' ,'H'=>'Hembra'],$perro->sexo,['class'=>'form-control']) !!}
				</div>

						
				<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
					{!! Form::label('ninios','A. Niños') !!}
					{!! Form::select('ninios',['-1'=>'-','1'=>'Si' ,'0'=>'No'],$perro->ninios,['class'=>'form-control']) !!}			
				</div>	
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
					{!! Form::label('actividad','actividad') !!}	
					{!! Form::select('actividad',['-'=>'NO DETERMINADA','A'=>'ALTA','M'=>'MEDIA','B'=>'BAJA'],$perro->actividad,['class' => 'form-control']) !!}				
				</div>														
				<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
					{!! Form::label('guardian','Apto Guardia') !!}
					{!! Form::select('guardian',['-'=>'NO DETERMINADO','S'=>'Si' ,'N'=>'No'],$perro->guardian,['class'=>'form-control']) !!}
				</div>							
				<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
					{!! Form::label('castrado','Castrado/a') !!}
					{!! Form::select('castrado',['-'=>'-','S'=>'Si' ,'N'=>'No'],$perro->castrado,['class'=>'form-control']) !!}
				</div>	
				<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
					{!! Form::label('depto','Apto Dpto') !!}
					{!! Form::select('depto',['-'=>'NO DET','S'=>'Si' ,'N'=>'No'],$perro->depto,['class'=>'form-control']) !!}
				</div>	
				<div class="col-lg-1 col-md-2 col-sm-3 col-xs-6">
					{!! Form::label('otrosperros','Tolera Perros') !!}
					{!! Form::select('otrosperros',['-'=>'No Det','S'=>'Si' ,'N'=>'No'],$perro->otrosperros,['class'=>'form-control']) !!}						
				</div>
				<div class="col-lg-1 col-md-2 col-sm-3 col-xs-6">
					{!! Form::label('gatos','Tolera Gatos') !!}
					{!! Form::select('gatos',['-'=>'No Det','S'=>'Si' ,'N'=>'No'],$perro->gatos,['class'=>'form-control']) !!}			
				</div>		
			</div>	
		</div>




	



		<div class="form-group">	
			<div class="row">
				<div class="col-lg-2">
					{!! Form::label('porte','Porte') !!}
					{!! Form::select('porte',['-'=>'Seleccione Tamaño de la raza','P'=>'Pequeño' ,
					'M'=>'Mediano','G'=>'Grande','GI'=>'Gigante'],$perro->porte,['class'=>'form-control']) !!}			
				</div>	
				<div class="col-lg-3">
					{!! Form::label('alimentodiario','Alimento Diario grs') !!}
					{!! Form::number('alimentodiario',$perro->alimentodiario,['class' => 'form-control', 'placeholder' => 'Alimento Diario']) !!}
				</div>
				<div class="col-lg-4 col-md-5 col-sm-6 col-xs-10">
					{!! Form::label('idpropietario','propietario') !!}
					{!! Form::select('idpropietario',$prop,$perro->idpropietario,['class' => 'form-control', 'placeholder' => 'Seleccione Propietario' ]) !!}
				</div>
				<div class="col-lg-3">
					{{ Form::hidden('foto', $perro->foto, array('id' => 'foto')) }}
				</div>
			</div>		
		</div>	

		<div class="form-group">	
			<div class="row">
				<div class="col-lg-12">
					{!! Form::label('seguimiento','Seguimiento') !!}
					{!!Form::textarea('seguimiento',$perro->seguimiento,['class' => 'form-control', 'placeholder' => 'Seguimiento']) !!}
				</div>
				
			</div>		
		</div>	


		<div class="form-group">	
			<div class="row">
				<div class="col-lg-3">
				{!! Form::label('visible','Mostrar en WEB') !!}
				{!! Form::select('visible',['N'=>'NO' ,'S'=>'SI'],$perro->visible,['class'=>'form-control']) !!}

				</div>


			</div>		
			
		</div>	

		<div class="form-group">
					<a href="{{ route('admin.perros.cambiarfoto', $perro->id)}}" class="btn btn-warning"><span> Cambiar Foto </span></a>
					{!! Form::submit('Modificar',['class'=>'btn btn-danger']) !!}
					<a href="{{ route('admin.perros.index',0)}}" class="btn btn-info"><span> Canes </span></a>	

		</div>







		<div class="form-group">
			
		</div>



	{!! Form::close() !!}

@endsection	