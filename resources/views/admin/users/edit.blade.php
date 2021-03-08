@extends('admin')


@section('title','Editar Usuario:' . $user->name)


@section('content')

 {!!Form::model($user,['method'=>'PATCH','autocomplete'=>'off','route'=>['usuarios.update',$user->id]])!!}
  <!--{!! Form::open(['route' => ['usuarios.update',$user->id],'method' => 'PUT']) !!}-->

    <div class="form-group">
      {!! Form::label('name','Nombre') !!}
      {!! Form::text('name',$user->name,['class' => 'form-control','placeholder' => 'Nombre', 'required']) !!}
    </div>  


    <div class="form-group">
      {!! Form::label('email','Correo Electronico') !!}
      {!! Form::email('email',$user->email,['class' => 'form-control','placeholder' => 'Correo Electronico']) !!}
    </div>  


    <div class="form-group">  
      {!! Form::label('tipo','Tipo Usuario') !!}
      {!! Form::select('tipo',['vet'=>'Veterinario','administrativo' => 'Administrativo','auxiliar'=>'Auxiliar','admin'=>'Administrador' ,'web'=>'Web'],$user->tipo,['class'=>'form-control']) !!}
    </div>
      


    <div class="form-group">
      {!! Form::submit('Modificar',['class'=>'btn btn-primary']) !!}

    </div>


  {!! Form::close() !!}

@endsection 