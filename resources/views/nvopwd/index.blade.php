@extends('admin')
@section('content')
<!--Contenido -->
<div class="col-lg-12">
     <h1 class="page-header">Usuario: {{$usuario->name}}</h1>

</div>

<!-- /.row-->
<div class="row">
    <div class="col-lg-12">
      {!!Form::model($usuario,['method'=>'PATCH','autocomplete'=>'off','route'=>['usuarios.nvopwd.update',$usuario->id]])!!}
      {{Form::token()}}
        <div class="form-group">
          <div class="row">
            <div class="col-lg-4">
              <label for="name" class="control-label">Nombre:</label>
              <input id="name" type="text" class="form-control" name="nombre" value="{{ $usuario->name }}" onKeyUp="this.value=this.value.toUpperCase();" disabled>
              
             
            </div>
          </div>
        </div>
		
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <div class="row">
            
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-lg-4">
              <label for="password" class="control-label">Nueva Contraseña</label>
              <input id="password" type="password" class="form-control" name="password" required>

            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-lg-4">
              <label for="password-confirm" class="control-label">Confirmar Nueva Contraseña</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
          </div>
        </div>

      <div class="form-group">
        {!! Form::submit('Modificar Clave',['class'=>'btn btn-primary']) !!}
        
        <a href="{{url('usuarios')}}"><button class="btn btn-danger" type="button">Cancelar</button></a>
      </div>
      {!!Form::close()!!}
  </div>
</div>
<!--Fin Contenido -->
@endsection
