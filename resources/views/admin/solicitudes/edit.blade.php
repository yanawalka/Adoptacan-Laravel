@extends('admin')


@section('title','Modificar Solicitud')


@section('content')

	{!! Form::open(['route' => ['admin.solicitudes.update',$solicitud->id],'method' => 'PUT']) !!}
	

		<div class="form-group">
			<div class="row">
				<div class="col-lg-3">
					{!! Form::label('solicitante','Solicitante')!!}
					{!! Form::select('adoptante_id',$solicitantes,$solicitud->adoptante_id,['class' => 'form-control', 'placeholder' => 'Seleccione Persona' ,'required','disabled']) !!}
				</div>	
				<div class="col-lg-2">
					<div class='raza'>
					{!! Form::label('edad','Edad') !!}
					{!! Form::select('edad',['-' => 'No interesa' ,'cachorro' =>'cachorro' ,'joven'=>'joven','adulto'=>'adulto','anciano'=>'anciano'],$solicitud->edad,['class'=>'form-control']) !!}

					</div>
					
				</div>	

				<div class="col-lg-2">
					<div class='raza'>
						{!! Form::label('porte','Porte') !!}
						{!! Form::select('porte',['-'=>'Seleccione Tamaño de la raza','P'=>'Pequeño' ,
						'M'=>'Mediano','G'=>'Grande','GI'=>'Gigante'],$solicitud->porte,['class'=>'form-control']) !!}	

					</div>
					
				</div>	

			</div>


		</div>
		
		
		<div class="form-group">	
			<div class="row">
				<div class="col-lg-1">
					{!! Form::label('ninios','A. Niños') !!}
					{!! Form::select('ninios',['1'=>'Si' ,'0'=>'No'],$solicitud->ninios,['class'=>'form-control']) !!}	
				</div>		
				<div class="col-lg-1">
					{!! Form::label('actividad','Actividad') !!}	
					{!! Form::select('actividad',['NO DETERMINADA'=>'NO DETERMINADA','ALTA'=>'ALTA','MEDIA'=>'MEDIA','BAJA'=>'BAJA'],$solicitud->actividad,['class' => 'form-control']) !!}					
				</div>	

				<div class="col-lg-1">
					{!! Form::label('guardian','Apto Guardia') !!}
					{!! Form::select('guardian',['-'=>'NO DETERMINADO','S'=>'Si' ,'N'=>'No'],$solicitud->guardian,['class'=>'form-control']) !!}
				</div>	

			
			
				<div class="col-lg-1">
				
					{!! Form::label('sexo','Sexo') !!}
					{!! Form::select('sexo',['-'=>'','M'=>'Macho' ,'H'=>'Hembra'],$solicitud->sexo,['class'=>'form-control']) !!}
				</div>

			
				<div class="col-lg-1">
					{!! Form::label('castrado','castrado') !!}
					{!! Form::select('castrado',['-'=>'','S'=>'Si' ,'N'=>'No'],$solicitud->castrado,['class'=>'form-control']) !!}			
				</div>	
				<div class="col-lg-2">
					{!! Form::label('depto','Apto Dpto') !!}
					{!! Form::select('depto',['-'=>'---','S'=>'Si' ,'N'=>'No'],$solicitud->depto,['class'=>'form-control']) !!}
				</div>														
	
				<div class="col-lg-1">
					{!! Form::label('otrosperros','Tolera Perros') !!}
					{!! Form::select('otrosperros',['-'=>'No Det','S'=>'Si' ,'N'=>'No'],$solicitud->otrosperros,['class'=>'form-control']) !!}						
				</div>
				<div class="col-lg-1">
					{!! Form::label('gatos','Tolera Gatos') !!}
					{!! Form::select('gatos',['-'=>'No Det','S'=>'Si' ,'N'=>'No'],$solicitud->gatos,['class'=>'form-control']) !!}			
				</div>		
				<div class="col-lg-1">
					{!! Form::label('temporal','Temporal') !!}
					{!! Form::select('temporal',['N'=>'No','S'=>'Si'],$solicitud->temporal,['class'=>'form-control']) !!}			
				</div>	
				<div class="col-lg-1">
					{!! Form::label('activa','Activa') !!}
					{!! Form::select('activa',['N'=>'No','S'=>'Si','X'=>'Eliminada'],$solicitud->activa,['class'=>'form-control']) !!}			
				</div>	
			</div>	
		</div>

		

		<div class="form-group">
			{!! Form::submit('Grabar',['class'=>'btn btn-primary']) !!}

		</div>



	{!! Form::close() !!}


@endsection	