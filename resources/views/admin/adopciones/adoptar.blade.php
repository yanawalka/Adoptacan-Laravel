@extends('admin')




@section('content')

	{!! Form::open(['route' => ['admin.adopciones.create',$perro->id, $persona->id ,$edad, $solicitud->id ],'method' => 'PUT']) !!}





<div class="form-group">	

 			<div class="panel panel-default">
                <div class="panel-heading"><h4>Solicitud de Adopcion: {{ $solicitud->id }} -------- Fecha:{{ date('d/m/Y') }}</h4>  Datos Personales   </div>
                <p> <b>Apellido:</b> {{ $persona->apellido }} <b>Nombres:</b> {{ $persona->nombres }} <b>Email:</b> {{ $persona->email }}</p>

                
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading"><h4>PROPIETARIO</h4>  Datos Personales   </div>
                <div class="panel-body">
                	<div class="row">	
					    <div class="col-lg-1">
							{!! Form::label('dni','DNI')!!}
							{!! Form::text('dni',null,['class' => 'form-control', 'placeholder' => 'Dni' ,'required']) !!}
						</div>	
						<div class="col-lg-2">
							<div class='apellido'>
								{!! Form::label('apellido','Apellido') !!}
								{!! Form::text('apellido',null,['class' => 'form-control', 'placeholder' => 'Apellido' ,'required']) !!}

							</div>
					
						</div>	
						<div class="col-lg-2">
							<div class='nombres'>
								{!! Form::label('nombres','Nombres') !!}
								{!! Form::text('nombres',null,['class' => 'form-control', 'placeholder' => 'Nombre' ,'required']) !!}

							</div>
					
						</div>	

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
                </div>
            </div>	
			
			<div class="panel panel-default">
                <div class="panel-heading"><h4>Datos Solicitud   </div>
                <div class="panel-body">
                	<div class="row">	
                		<table class="table table-sm">
							  <thead>
							    <tr>
							      <th scope="col">EDAD</th>
							      <th scope="col">SEXO</th>
							      <th scope="col">APTO NIÑOS</th>
							      <th scope="col">ACTIVIDAD</th>
							      <th scope="col">GUARDIAN</th>
							      <th scope="col">DPTO</th>
							      <th scope="col">TOLERA PERROS</th>
							      <th scope="col">TOLERA GATOS</th>
							      <th scope="col">PORTE</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <td> {{ $solicitud->edad }}</td>
							      <td>{{ $solicitud->sexo }}</td>
							      @if ($solicitud->ninios == 0 )
							      		<td>NO RELEVANTE</td>
							  	  @else <td>SI</td> 
							  	  @endif
							      
							      <td>{{$solicitud->actividad}}</td>
							      @if($solicitud->guardian=='-')
							      	<td>NO RELEVANTE</td>
							      @elseif($solicitud->guardian=='S')	
							      	<td>SI</td>
							      @else <td>NO</td>	
							      @endif
							      @if($solicitud->depto=='-')
							      	<td>NO RELEVANTE</td>
							      @elseif($solicitud->depto=='S')	
							      	<td>SI</td>
							      @else <td>NO</td>	
							      @endif
							      
								  @if($solicitud->otrosperros=='-')
							      	<td>NO RELEVANTE</td>
							      @elseif($solicitud->otrosperros=='S')	
							      	<td>SI</td>
							      @else <td>NO</td>	
							      @endif

								  @if($solicitud->gatos=='-')
							      	<td>NO RELEVANTE</td>
							      @elseif($solicitud->gatos=='S')	
							      	<td>SI</td>
							      @else <td>NO</td>	
							      @endif

							      @if($solicitud->porte == 'P')
							      	<td>PEQUEÑO</td>
							      @elseif($solicitud->porte == 'G')	
							      	<td>GRANDE</td>
							      @elseif($solicitud->porte == 'GI')	
							      	<td>GIGANTE</td>
							      @elseif($solicitud->porte =='M')
							      	<td>MEDIANO</td>
							      @else	
							      	<td>NO RELEVANTE</td>	
							      @endif	
							      
							  </tbody>
							</table>
									
					</div>	
                </div>
                </div>
                	

			

			<div class="panel panel-default">
                <div class="panel-heading"><h4>Datos Can   </div>
                <div class="panel-body">
                	<div class="row">	
                		<table class="table table-sm">
							  <thead>
							    <tr>
							      <th scope="col">IDENTIFICACION</th>
							      <th scope="col">APODO</th>
							      <th scope="col">EDAD</th>
							      <th scope="col">SEXO</th>
							      <th scope="col">APTO NIÑOS</th>
							      <th scope="col">ACTIVIDAD</th>
							      <th scope="col">GUARDIAN</th>
							      <th scope="col">DPTO</th>
							      <th scope="col">TOLERA PERROS</th>
							      <th scope="col">TOLERA GATOS</th>
							      <th scope="col">PORTE</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <td> {{ $perro->chip }}</td>

							      <td> {{ $perro->apodo }}</td>

							      <td> AÑOS {{ substr($edad,1,2) }} MESES {{substr($edad,4,2)}}</td>

							      <td>{{$perro->sexo}}</td>

							      @if ($perro->ninios == 0 )
							      		<td>NO APTO</td>
							  	  @elseif ($perro->ninios == 1 )
							  	  	<td>SI</td> 
							  	  @else 
							  	  	<td>NO DETERMINADO</td>
							  	  @endif

							  	  @if($perro->actividad=='-')
							  	  	<td>NO DETERMINADA</td>
							  	  @elseif ($perro->actividad == 'A')
							  	  	<td>ALTA</td>	
							  	  @elseif ($perro->actividad == 'B')
							  	  	<td>BAJA</td>		
							  	  @else
							  	  	<td>MEDIA</td>
							  	  @endif	
							      
							      @if($perro->guardian=='-')
							      	<td>NO DET</td>
							      @elseif($perro->guardian=='S')	
							      	<td>SI</td>
							      @else <td>NO</td>	
							      @endif

							      @if($perro->depto=='-')
							      	<td>NO DETERMINADO</td>
							      @elseif($perro->depto=='S')	
							      	<td>SI APTO</td>
							      @else <td>NO APTO</td>	
							      @endif

							      @if($perro->otrosperros=='-')
							      	<td>NO DET</td>
							      @elseif($perro->otrosperros=='S')	
							      	<td>SI TOLERA</td>
							      @else <td>NO TOLERA</td>	
							      @endif

							      @if($perro->gatos=='-')
							      	<td>NO DET</td>
							      @elseif($perro->gatos=='S')	
							      	<td>SI TOLERA</td>
							      @else <td>NO TOLERA</td>	
							      @endif

							      @if($perro->porte == 'P')
							      	<td>PEQUEÑO</td>
							      @elseif($perro->porte == 'G')	
							      	<td>GRANDE</td>
							      @elseif($perro->porte == 'GI')	
							      	<td>GIGANTE</td>
							      @elseif($perro->porte =='M')
							      	<td>MEDIANO</td>
							      @else	
							      	<td>NO DET</td>	
							      @endif	
							  </tbody>
							</table>
									
					</div>	
                </div>
                </div>
               	

			






		<div class="form-group">
			{!! Form::submit('Confirmar',['class'=>'btn btn-primary']) !!}

		</div>

</div>

	{!! Form::close() !!}

@push('scripts')
<script>

  //Editar telefonos
  $(document).ready(function(){


    $('#dni').change(function(){
      
      validar_prop();
    });

  });




  //function heredaRaza(){
  //  ninios=validar_raza($("#raza_id").val());
  //  $("#ninios").val(ninios);
    

  //}


 

function validar_prop(){
  $dni = jQuery(dni).val();
  console.log($dni);
  var $url="/datosprop?dni="+$dni;
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