@extends('admin')




@section('content')

	{!! Form::open(['route' => ['admin.adopciones.createciega',$perro->id, $persona->id ],'method' => 'PUT']) !!}


<div class="form-group">	
			<div class="panel panel-default">
                <div class="panel-heading"><h4>Datos Propietario   </div>
                <div class="panel-body">
                	<div class="row">	
                		<table class="table table-sm">
							  <thead>
							    <tr>
							      <th scope="col">APELLIDO</th>
							      <th scope="col">NOMBRES</th>
							      <th scope="col">DNI</th>
							      <th scope="col">EMAIL</th>
							      <th scope="col">CELULAR</th>
							      <th scope="col">CERT. - CARENCIA</th>
							      <th scope="col">FECHA CERT</th>
							      <th scope="col">DOMICILIO</th>
							      <th scope="col">REFERENCIA</th>
							      <th scope="col">FOTO</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <td> {{ $persona->apellido }}</td>

							      <td> {{ $persona->nombres }}</td>


							      <td>{{$persona->dni}}</td>

							     
							      <td>{{$persona->email}}</td>

 						  	  	  <td>{{$persona->celular}}</td>

						  	  	  <td>{{$persona->certCarencia}}</td>

						  	  	  <td>{{$persona->fechacert}}</td>

						  	  	  <td>{{$persona->domicilio}}</td>

						  	  	  <td>{{$persona->referencia}}</td>

						  	  	  <td>{{$persona->foto}}</td>	
								  	  	  	
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

@endsection	