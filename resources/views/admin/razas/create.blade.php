@extends('admin')


@section('title','Nueva Raza')


@section('content')

	{!! Form::open(['route' => 'admin.razas.store','method' => 'POST']) !!}

		<div class="form-group">
			{!! Form::label('name','Nombre')!!}
			{!! Form::text('name',null,['class' => 'form-control', 'placeholder' => 'Nombre de la Raza' ,'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('porte','Porte') !!}
			{!! Form::select('porte',['-'=>'Seleccione Tamaño de la raza','P'=>'Pequeño' ,
			'M'=>'Mediano','G'=>'Grande','GI'=>'Gigante'],null,['class'=>'form-control']) !!}
		</div>
		<div class="form-group">	
			{!! Form::label('ninios','Apto para Niños') !!}
			{!! Form::select('ninios',[-1=>'-','1'=>'Si' ,'0'=>'No'],-1,['class'=>'form-control']) !!}
		</div>	
		<div class="form-group">	
			{!! Form::label('evida','Expectativa de Vida') !!}
			{!! Form::number('evida',null,['class' => 'form-control', 'placeholder' => 'Expectativa de Vida']) !!}
		</div>	

		<div class="form-group">
			{!! Form::submit('Grabar',['class'=>'btn btn-primary']) !!}

		</div>



	{!! Form::close() !!}

@endsection	