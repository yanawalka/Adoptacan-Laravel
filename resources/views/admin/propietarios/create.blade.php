@extends('admin')


@section('title','Ingresar Nuevo Propietario')


@section('content')

	{!! Form::open(['route' => 'admin.propietarios.store','method' => 'POST','files'=>true]) !!}

		<div class="form-group">
			<div class="row">
				<div class="col-lg-3">
					{!! Form::label('DNI','DNI')!!}
					{!! Form::text('dni',null,['class' => 'form-control', 'placeholder' => 'Dni' ,'required']) !!}
				</div>	
				
				<div class="col-lg-4">	
					{!! Form::label('Apellido','Apellido') !!}
					{!! Form::text('apellido',null,['class' => 'form-control', 'placeholder' => 'Apellido','required']) !!}
				</div>	
				<div class="col-lg-4">	
					{!! Form::label('Nombres','Nombres') !!}
					{!! Form::text('nombres',null,['class' => 'form-control', 'placeholder' => 'Nombres','required']) !!}
				</div>	
			</div>


		</div>
		
		
		<div class="form-group">	
			<div class="row">
				<div class="col-lg-2">
					{!! Form::label('celular','celular') !!}
					{!! Form::tel('celular',null,['class' => 'form-control', 'placeholder' => 'celular']) !!}
				</div>
				<div class="col-lg-2">
					{!! Form::label('email','email') !!}
					{!! Form::email('email',null,['class' => 'form-control', 'placeholder' => 'email']) !!}
				</div>	

				<div class="col-lg-1">
					{!! Form::label('certcarencia','certcarencia') !!}
					{!! Form::select('certcarencia',['S'=>'Si' ,'N'=>'No'],'N',['class'=>'form-control']) !!}	
				</div>	

				<div class="col-lg-1">
					{!! Form::label('fechacert','Fecha Cert') !!}
					{!! Form::date('fechacert',date('Y-m-d'))!!}	
				</div>	

				

			</div>

		</div>

		<div class="form-group">	
			<div class="row">
				<div class="col-lg-4">	
					{!! Form::label('Domicilio','Domicilio') !!}
					{!! Form::text('domicilio',null,['class' => 'form-control', 'placeholder' => 'Domicilio','required']) !!}
				</div>	
				<div class="col-lg-4">	
					{!! Form::label('Referencia','Referencia') !!}
					{!! Form::text('referencia',null,['class' => 'form-control', 'placeholder' => 'referencia']) !!}
				</div>	
			</div>	
		</div>	



		<div class="form-group">
			<div class="row">
				<div class="col-lg-3">
					{!! Form::label('foto','Foto') !!}
					{!! Form::file('foto') !!}
				</div>
			</div>	
		</div>	
		<div class="form-group">	
			<div class="row">
				<div class="col-lg-3">
					{!! Form::submit('Grabar',['class'=>'btn btn-primary']) !!}
				</div>
			</div>

		</div>



	{!! Form::close() !!}


@endsection	