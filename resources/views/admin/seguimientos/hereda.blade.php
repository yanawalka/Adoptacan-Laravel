@extends('admin')


@section('title','Heredar Datos de un Adoptante')


@section('content')

	{!! Form::open(['route' => 'admin.propietarios.store','method' => 'POST','files'=>true]) !!}

		<div class="form-group">
			<div class="row">
				<div class="col-lg-3">
					{!! Form::label('adoptante_id','Solicitante')!!}
					{!! Form::select('adoptante_id',$adoptantes,null,['class' => 'form-control', 'placeholder' => 'Seleccione Persona' ,'required']) !!}
				</div>	

				<div class="col-lg-3">
					{!! Form::label('DNI','DNI')!!}
					{!! Form::text('dni',null,['class' => 'form-control', 'placeholder' => 'Dni' ,'required']) !!}
				</div>	
				<div class="col-lg-2">
					<div class='raza'>
					{!! Form::label('apellido','Apellido') !!}
					{!! Form::text('apellido',null,['class' => 'form-control', 'placeholder' => 'Apellido' ,'required']) !!}

					</div>
					
				</div>	

				<div class="col-lg-4">	
					{!! Form::label('nombres','Nombres') !!}
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

@push('scripts')
<script>

  //Editar telefonos
  $(document).ready(function(){


    $('#adoptante_id').change(function(){
      
      validar_persona();
    });

  });




  //function heredaRaza(){
  //  ninios=validar_raza($("#raza_id").val());
  //  $("#ninios").val(ninios);
    

  //}


 

function validar_persona(){
  $adoptante = jQuery(adoptante_id).val();
  console.log($adoptante);
  var $url="/datospersona?idadoptante="+$adoptante;
  console.log($url);
  $.getJSON($url,function(valida){
  	console.log('adentro');
    $.each(valida, function(i,valida){
    	console.log(i + "- " + valida.apellido + " " + valida.nombre+ "- " + valida.email+ "- " + valida.celular);
    	 $("#apellido").val(valida.apellido);
    	 $("#nombres").val(valida.nombre);
    	 $("#email").val(valida.email);
    	 $("#celular").val(valida.celular);
    	 //$("#evida").val(valida.evida);
    	
      
    });
  });

}







</script>
@endpush

@endsection	