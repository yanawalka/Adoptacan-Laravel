@extends('admin')


@section('title','ESTADISTICAS DE ADOPCIONES REALIZADAS')


@section('content')
	


	<table class="table table-striped">
		<thead>
			<th>ADOPCIONES</th>
			<th>PERIODO</th>
			
		</thead>



			@foreach($estadisticas as $ad)

				<tr>

                    <td> {{ $ad->cantidad }} </td>
					<td> {{ $ad->periodo }} </td>
					
					
				</tr>
			@endforeach
		<tbody>
			

		</tbody>
		

	</table>

	

@endsection	

