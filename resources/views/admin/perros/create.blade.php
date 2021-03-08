@extends('admin')


@section('title','Ingresar Perro')


@section('content')

	{!! Form::open(['route' => 'admin.perros.store','method' => 'POST','files'=>true]) !!}

		<div class="form-group">
			<div class="row">
				<div class="col-lg-4">
					{!! Form::label('chip','Chip / Identificacion Unica')!!}
					{!! Form::text('chip',null,['class' => 'form-control', 'placeholder' => 'Identificación' ,'required']) !!}
				</div>	
				<div class="col-lg-2">
					<div class='raza'>
					{!! Form::label('raza_id','Raza') !!}
					{!! Form::select('raza_id',$razas,null,['class' => 'form-control', 'placeholder' => 'Seleccione Raza' ,'required']) !!}

					</div>
					
				</div>	
				<div class="col-lg-1">
					
					{!! Form::label('mestizo','Mestizo') !!}
					{!! Form::select('mestizo',['S'=>'Si' ,'N'=>'No'],'S',['class'=>'form-control']) !!}
				</div>

				<div class="col-lg-4">	
					{!! Form::label('apodo','Apodo') !!}
					{!! Form::text('apodo',null,['class' => 'form-control', 'placeholder' => 'Apodo','required']) !!}
				</div>	
			</div>


		</div>
		
		
		<div class="form-group">	
			<div class="row">
				<div class="col-lg-1">
					{!! Form::label('anios','Años') !!}
					{!! Form::select('anios',[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],null,['class'=>'form-control']) !!}			
				</div>	
				<div class="col-lg-1">
					{!! Form::label('meses','Meses') !!}
					{!! Form::select('meses',[0,1,2,3,4,5,6,7,8,9,10,11,12],null,['class'=>'form-control']) !!}			
				</div>	

				<div class="col-lg-1">
					{!! Form::label('dias','Dias') !!}
					{!! Form::select('dias',[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],null,['class'=>'form-control']) !!}			
				</div>	

			
			
				<div class="col-lg-1">
					{{ Form::hidden('fechanac') }}
					{!! Form::label('sexo','Sexo') !!}
					{!! Form::select('sexo',['M'=>'Macho' ,'H'=>'Hembra'],null,['class'=>'form-control']) !!}
				</div>

			
				<div class="col-lg-1">
					{!! Form::label('ninios','A. Niños') !!}
					{!! Form::select('ninios',[-1=>'-','1'=>'Si' ,'0'=>'No'],-1,['class'=>'form-control']) !!}			
				</div>	
				<div class="col-lg-2">
					{!! Form::label('actividad','Actividad') !!}	
					{!! Form::select('actividad',['-'=>'NO DETERMINADA','A'=>'ALTA','M'=>'MEDIA','B'=>'BAJA'],'-',['class' => 'form-control']) !!}				
				</div>														
				<div class="col-lg-1">
					{!! Form::label('guardian','Apto Guardia') !!}
					{!! Form::select('guardian',['-'=>'NO DETERMINADO','S'=>'Si' ,'N'=>'No'],'-',['class'=>'form-control']) !!}
				</div>							
				<div class="col-lg-1">
					{!! Form::label('castrado','Castrado/a') !!}
					{!! Form::select('castrado',[null=>'','S'=>'Si' ,'N'=>'No'],'N',['class'=>'form-control']) !!}
				</div>	
				<div class="col-lg-1">
					{!! Form::label('depto','Apto Dpto') !!}
					{!! Form::select('depto',['-'=>'NO DET','S'=>'Si' ,'N'=>'No'],'-',['class'=>'form-control']) !!}
				</div>	
				<div class="col-lg-1">
					{!! Form::label('otrosperros','Tolera Perros') !!}
					{!! Form::select('otrosperros',['-'=>'No Det','S'=>'Si' ,'N'=>'No'],'-',['class'=>'form-control']) !!}						
				</div>
				<div class="col-lg-1">
					{!! Form::label('gatos','Tolera Gatos') !!}
					{!! Form::select('gatos',['-'=>'No Det','S'=>'Si' ,'N'=>'No'],'-',['class'=>'form-control']) !!}			
				</div>		
			</div>	
		</div>

		<div class="form-group">	
			<div class="row">
				<div class="col-lg-2">
					{!! Form::label('porte','Porte') !!}
					{!! Form::select('porte',['-'=>'Seleccione Tamaño de la raza','P'=>'Pequeño' ,
					'M'=>'Mediano','G'=>'Grande','GI'=>'Gigante'],null,['class'=>'form-control']) !!}			
				</div>
				<div class="col-lg-3">
					{!! Form::label('alimentodiario','Alimento Diario grs') !!}
					{!! Form::number('alimentodiario',null,['class' => 'form-control', 'placeholder' => 'Alimento Diario']) !!}
				</div>
				<div class="col-lg-4 col-md-5 col-sm-6 col-xs-10">
					{!! Form::label('idpropietario','propietario') !!}
					{!! Form::select('idpropietario',$propietarios,null,['class' => 'form-control', 'placeholder' => 'Seleccione Propietario' ]) !!}
				</div>
				<div class="col-lg-3">
					{!! Form::label('foto','Foto') !!}
					{!! Form::file('foto') !!}
				</div>
			</div>		
		</div>	

		<div class="form-group">	
			<div class="row">
				<div class="col-lg-12">
					{!! Form::label('seguimiento','Seguimiento') !!}
					{!!Form::textarea('seguimiento',null,['class' => 'form-control', 'placeholder' => 'Seguimiento']) !!}
				</div>
				
			</div>		
		</div>	


		<div class="form-group">	
			<div class="row">
				<div class="col-lg-3">
				{!! Form::label('visible','Mostrar en WEB') !!}
				{!! Form::select('visible',['N'=>'NO' ,'S'=>'SI'],'S',['class'=>'form-control']) !!}
				</div>
			</div>		
		</div>	


		<div class="form-group">
			{!! Form::submit('Grabar',['class'=>'btn btn-primary']) !!}

		</div>



	{!! Form::close() !!}

@push('scripts')
<script>

  //Editar telefonos
  $(document).ready(function(){

    $('#raza_id').change(function(){
      
      heredaRaza();
    });

  });




  function heredaRaza(){
    ninios=validar_raza($("#raza_id").val());
    $("#ninios").val(ninios);
    

  }

  function limpiar(){
    $('#tnro').val("");
  }

  function evaluar(){
	 	if (nro<3) {
	 		$("#bt_add").show();
	 	}
	 	else {
	 		$("#bt_add").hide();
	 	}
	 }

  function eliminar(index){
    $('#fila' + index).remove();
    evaluar();
  }
function validar_raza(){
  $raza = jQuery(raza_id).val();
  console.log($raza);
  var $url="/datosraza?idraza="+$raza;
  console.log($url);
  $.getJSON($url,function(valida){
  	console.log('adentro');
    $.each(valida, function(i,valida){
    	console.log(i + "- " + valida.porte + " " + valida.ninios+ "- " + valida.evida);
    	 $("#ninios").val(valida.ninios);
    	 $("#porte").val(valida.porte);
    	 //$("#evida").val(valida.evida);
    	
      
    });
  });

}



$(function() {
    $("#boton").on("click", function(e) {
        e.preventDefault();
        $(".prueba3").html("CARGANDO...");

        $.getJSON("musica/show", function(data) {
            var mimusic = "";       
            $.each(data, function() {
                mimusic += this.Titulo + " - " + this.Ano  + "<br>";
            })
            $(".prueba3").html(mimusic);
        }); // getJSON

    }); // Click
}); // function


  //validar cuil
  function validaDatos(){
    vcuil=$("#valcuil").val();
    if (vcuil==1) {
      alert("El CUIL ingresado no es válido");
      return false;
    }else{
      return true;
    }
  }


</script>
@endpush

@endsection	