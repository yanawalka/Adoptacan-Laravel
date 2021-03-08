@extends('admin')


@section('title','ADOPCIONES REALIZADAS')


@section('content')
	
	<a class="btn btn-info" href="{{ route('admin.adopciones.estadisticas')}}"> Estadisticas </a>

	<br>
	<table class="table table-striped">
		<thead>
			<th>ADOPCION</th>
			<th>ID</th>
			<th>APELLIDO</th>
			<th>NOMBRE</th>
			<th>EDAD</th>
			<th>PORTE</th>
			<th>NIÑOS</th>
			<th>ACTIVIDAD</th>
			<th>GUARDIAN</th>
			<th>SEXO</th>
			<th>CASTRADO</th>
			<th>DPTO</th>
			<th>OT PERROS</th>
			<th>GATOS</th>
			<th>APODO</th>
			<th>FECHA ADOPCION</th>
			<th>IMPRIMIR</th>
		</thead>



			@foreach($adopciones as $ad)

				<tr>
					@php
						$clase = '';
						
					@endphp
					@if($ad->temporal == 'S')
						@php
							$clase = '#FFFF66'
						@endphp
					@endif
					<?php
                              $fecha=date('d/m/Y',strtotime($ad->fecha_adopcion));
                    ?>
                    <td bgcolor="{{$clase}}"> {{ $ad->adopcion }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->id }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->apellidoad }}</td>
					<td bgcolor="{{$clase}}"> {{ $ad->nombresad }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->edad }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->nporte }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->nninios }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->actividad }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->nguardian }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->nsexo }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->ncastrado }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->ndepto }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->notrosperros }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->ngatos }} </td>
					<td bgcolor="{{$clase}}"> {{ $ad->apodo }} </td>
					<td bgcolor="{{$clase}}"> <?php echo $fecha ?> </td>
					<td>

						<a href="{{ route('admin.adopciones.imprime',[$ad->adopcion])}}" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span></a>
					</td>

				</tr>
			@endforeach
		<tbody>
			

		</tbody>
		

	</table>

	

@endsection	

