@extends('admin')


@section('title','Ingresar Solicitud')


@section('content')

	{!! Form::open(['route' => 'admin.solicitudes.store','method' => 'POST','files'=>true]) !!}

		<div class="form-group">
			<div class="row">
				<div class="col-lg-3">
					{!! Form::label('solicitante','Solicitante')!!}
					{!! Form::select('adoptante_id',$solicitantes,null,['class' => 'form-control', 'placeholder' => 'Seleccione Persona' ,'required']) !!}
				</div>	
				<div class="col-lg-2">
					<div class='raza'>
					{!! Form::label('edad','Edad') !!}
					{!! Form::select('edad',['-' => 'No interesa' ,'cachorro' =>'cachorro' ,'joven'=>'joven','adulto'=>'adulto','anciano'=>'anciano'],'-',['class'=>'form-control']) !!}

					</div>
					
				</div>	

				<div class="col-lg-2">
					<div class='raza'>
						{!! Form::label('porte','Porte') !!}
						{!! Form::select('porte',['-'=>'Seleccione Tamaño de la raza','P'=>'Pequeño' ,
						'M'=>'Mediano','G'=>'Grande','GI'=>'Gigante'],null,['class'=>'form-control']) !!}	

					</div>
					
				</div>	

			</div>


		</div>
		
		
		<div class="form-group">	
			<div class="row">
				<div class="col-lg-1">
					{!! Form::label('ninios','A. Niños') !!}
					{!! Form::select('ninios',['1'=>'Si' ,'0'=>'No'],0,['class'=>'form-control']) !!}	
				</div>		
				<div class="col-lg-1">
					{!! Form::label('actividad','Actividad') !!}	
					{!! Form::select('actividad',['NO DETERMINADA'=>'NO DETERMINADA','ALTA'=>'ALTA','MEDIA'=>'MEDIA','BAJA'=>'BAJA'],'NO DETERMINADA',['class' => 'form-control']) !!}					
				</div>	

				<div class="col-lg-1">
					{!! Form::label('guardian','Apto Guardia') !!}
					{!! Form::select('guardian',['-'=>'NO DETERMINADO','S'=>'Si' ,'N'=>'No'],'-',['class'=>'form-control']) !!}
				</div>	

			
			
				<div class="col-lg-1">
				
					{!! Form::label('sexo','Sexo') !!}
					{!! Form::select('sexo',['-'=>'-','M'=>'Macho' ,'H'=>'Hembra'],'-',['class'=>'form-control']) !!}
				</div>

			
				<div class="col-lg-1">
					{!! Form::label('castrado','castrado') !!}
					{!! Form::select('castrado',['-'=>'-','S'=>'Si' ,'N'=>'No'],'-',['class'=>'form-control']) !!}			
				</div>	
				<div class="col-lg-2">
					{!! Form::label('depto','Apto Dpto') !!}
					{!! Form::select('depto',['-'=>'-','S'=>'Si' ,'N'=>'No'],'-',['class'=>'form-control']) !!}
				</div>														
	
				<div class="col-lg-1">
					{!! Form::label('otrosperros','Tolera Perros') !!}
					{!! Form::select('otrosperros',['-'=>'No Det','S'=>'Si' ,'N'=>'No'],'-',['class'=>'form-control']) !!}						
				</div>
				<div class="col-lg-1">
					{!! Form::label('gatos','Tolera Gatos') !!}
					{!! Form::select('gatos',['-'=>'No Det','S'=>'Si' ,'N'=>'No'],'-',['class'=>'form-control']) !!}			
				</div>		
				<div class="col-lg-1">
					{!! Form::label('temporal','Temporal') !!}
					{!! Form::select('temporal',['N'=>'No','S'=>'Si'],'N',['class'=>'form-control']) !!}			
				</div>	
			</div>	
		</div>

		

		<div class="form-group">
			{!! Form::submit('Grabar',['class'=>'btn btn-primary']) !!}

		</div>



	{!! Form::close() !!}


@endsection	