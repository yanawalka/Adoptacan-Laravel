@extends('admin')


@section('title','Editar Raza')


@section('content')

	{!! Form::open(['route' => ['admin.razas.update',$raza->id],'method' => 'PUT']) !!}

		<div class="form-group">
			{!! Form::label('name','Nombre')!!}
			{!! Form::text('name',$raza->nombre,['class' => 'form-control', 'placeholder' => 'Nombre de la Raza' ,'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('porte','Porte') !!}
			{!! Form::select('porte',['-'=>'Seleccione Tamaño de la raza','P'=>'Pequeño' ,
			'M'=>'Mediano','G'=>'Grande','GI'=>'Gigante'],$raza->porte,['class'=>'form-control']) !!}
		</div>
		<div class="form-group">	
			{!! Form::label('ninios','Apto para Niños') !!}
			{!! Form::select('ninios',[-1=>'-','1'=>'Si' ,'0'=>'No'],$raza->ninios,['class'=>'form-control']) !!}
		</div>	
		<div class="form-group">	
			{!! Form::label('evida','Expectativa de Vida') !!}
			{!! Form::number('evida',$raza->evida,['class' => 'form-control', 'placeholder' => 'Expectativa de Vida']) !!}
		</div>	

		<div class="form-group">
			{!! Form::submit('Modificar',['class'=>'btn btn-primary']) !!}

		</div>



	{!! Form::close() !!}

@endsection	