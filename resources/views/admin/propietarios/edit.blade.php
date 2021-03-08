@extends('admin')


@section('title','Modificar Datos de Propietarios')

@section('content')

	{!! Form::open(['route' => ['admin.propietarios.update',$propietario->id],'method' => 'PUT']) !!}

		<div class="form-group">
			<div class="row">
				<div class="col-lg-3">
					{!! Form::label('DNI','DNI')!!}
					{!! Form::text('dni',$propietario->dni,['class' => 'form-control', 'placeholder' => 'Dni' ,'required']) !!}
				</div>	
				<div class="col-lg-2">
					<div class='raza'>
					{!! Form::label('apellido','Apellido') !!}
					{!! Form::text('apellido',$propietario->apellido,['class' => 'form-control', 'placeholder' => 'Apellido' ,'required']) !!}

					</div>
					
				</div>	

				<div class="col-lg-4">	
					{!! Form::label('Nombres','Nombres') !!}
					{!! Form::text('nombres',$propietario->nombres,['class' => 'form-control', 'placeholder' => 'Nombres','required']) !!}
				</div>	
			</div>


		</div>
		
		
		<div class="form-group">	
			<div class="row">
				<div class="col-lg-2">
					{!! Form::label('celular','celular') !!}
					{!! Form::tel('celular',$propietario->celular,['class' => 'form-control', 'placeholder' => 'celular']) !!}
				</div>
				<div class="col-lg-2">
					{!! Form::label('email','email') !!}
					{!! Form::email('email',$propietario->email,['class' => 'form-control', 'placeholder' => 'email']) !!}
				</div>	

				<div class="col-lg-1">
					{!! Form::label('certcarencia','certcarencia') !!}
					{!! Form::select('certcarencia',['S'=>'Si' ,'N'=>'No'],$propietario->certcarencia,['class'=>'form-control']) !!}	
				</div>	

				<div class="col-lg-1">
					{!! Form::label('fechacert','Fecha Cert') !!}
					{!! Form::date('fechacert',date('Y-m-d',strtotime($propietario->fechacert))) !!}	
				</div>	

				

			</div>

		</div>

		<div class="form-group">	
			<div class="row">
				<div class="col-lg-4">	
					{!! Form::label('Domicilio','Domicilio') !!}
					{!! Form::text('domicilio',$propietario->domicilio,['class' => 'form-control', 'placeholder' => 'Domicilio','required']) !!}
				</div>	
				<div class="col-lg-4">	
					{!! Form::label('Referencia','Referencia') !!}
					{!! Form::text('referencia',$propietario->referencia,['class' => 'form-control', 'placeholder' => 'referencia']) !!}
				</div>	
			</div>	
		</div>	

		<div class="form-group">
					<a href="{{ route('admin.propietarios.cambiarfoto', $propietario->id)}}" class="btn btn-danger"><span> Cambiar Foto </span></a>

					{!! Form::submit('Grabar',['class'=>'btn btn-primary']) !!}

		</div>


		


	{!! Form::close() !!}


@endsection	