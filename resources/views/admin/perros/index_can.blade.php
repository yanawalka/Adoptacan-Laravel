@extends('admin')


@section('title','Solicitudes de Adopción Para el Animal Especificado')


@section('content')
	


	<table class="table table-striped">
		<thead>
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
			<th>ACCION</th>
		</thead>
		<tbody>
			@foreach($solicitudes as $solicitud)
				<tr>
					<td>{{ $solicitud->id }}</td>
					<td>{{ $solicitud->apadoptante }}</td>
					<td>{{ $solicitud->nadoptante }}</td>
					<td>{{ $solicitud->edad }}</td>
					<td>{{ $solicitud->nporte}}</td>
					<td>{{ $solicitud->nninios}}</td>
					<td>{{ $solicitud->actividad}}</td>
					<td>{{ $solicitud->nguardian}}</td>
					<td>{{ $solicitud->nsexo}}</td>
					<td>{{ $solicitud->ncastrado}}</td>
					<td>{{ $solicitud->ndepto}}</td>
					<td>{{ $solicitud->notrosperros}}</td>
					<td>{{ $solicitud->ngatos}}</td>
					
	

				
					<td>
						<a href="{{ route('admin.perros.index_sol', $solicitud->id)}}" class="btn btn-success">{{ $solicitud->cant}} </a>
						<a href="{{ route('admin.solicitud.edit', $solicitud->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
						<a href="{{ route('admin.solicitud.destroy', $solicitud->id)}}" 
							onclick="return confirm('Seguro de Eliminar el Registro?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></a> 
						<a href="{{ route('admin.perros.adoptar',[$solicitud->perrito,$solicitud->id])}}" 
						    class="btn btn-success"><span class="glyphicon glyphicon-ok"></a> 	
					</td>
				</tr>

			@endforeach

		</tbody>
		

	</table>

	{{ $solicitudes->appends(Request::all())->render() }}

@endsection	