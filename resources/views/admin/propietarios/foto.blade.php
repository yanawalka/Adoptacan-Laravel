@extends('admin')


@section('title','Seleccionar Foto Propietario')


@section('content')

	{!! Form::open(['route' => ['admin.propietarios.updatefoto',$propietario->id],'method' => 'POST','files'=>true]) !!}

		
		<div class="form-group">	
				<div class="col-lg-3">
					{!! Form::label('foto','Foto') !!}
					{!! Form::file('foto') !!}
				</div>
			
		</div>	





		<div class="form-group">
			<div class="col-lg-3">
			{!! Form::submit('Grabar',['class'=>'btn btn-primary']) !!}
			<div>
		</div>



	{!! Form::close() !!}

@endsection	