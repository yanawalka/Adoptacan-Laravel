@extends('admin')


@section('title','Nuevo Usuario')


@section('content')

	@if (count($errors)>0)
     <div class="alert alert-danger">
       <ul>
         @foreach ($errors->all() as $error)
           <li>{{$error}}</li>
         @endforeach
       </ul>
     </div>
     @endif
	{!! Form::open(['route' => 'admin.users.store','method' => 'POST'])!!}

		<div class="form-group">
			{!! Form::label('name','Nombre') !!}
			{!! Form::text('name',null,['class' => 'form-control','placeholder' => 'Nombre', 'required']) !!}
		</div>	

		<div class="form-group">
			{!! Form::label('email','Correo Electronico') !!}
			{!! Form::email('email',null,['class' => 'form-control','placeholder' => 'Correo Electronico']) !!}
		</div>	
		<div class="form-group">	
			{!! Form::label('tipo','Tipo Usuario') !!}
			{!! Form::select('tipo',['vet'=>'Veterinario','administrativo' => 'Administrativo', 'auxiliar'=>'Auxiliar','admin'=>'Administrador' ,'web'=>'Web'],null,['class'=>'form-control']) !!}
		</div>	
		<div class="form-group">
			{!! Form::label('password:','Password') !!}
			{!! Form::password('password',null,['class' => 'form-control','placeholder' => '********']) !!}
		</div>	

		<div class="form-group">
			{!! Form::label('confirma','Confirmación') !!}
			{!! Form::password('confirma',null,['class' => 'form-control','placeholder' => '********']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Grabar',['class'=>'btn btn-primary']) !!}

		</div>

	{!! Form::close() !!}
@endsection