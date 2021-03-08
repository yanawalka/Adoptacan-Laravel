@extends('admin')


@section('title','Solicitudes de Adopción')


@section('content')
	<a href="{{ route('admin.solicitudes.create')}}" class="btn btn-info">Nueva Solicitud</a> <hr>


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
					@php
						$clase = ''
					@endphp
					@if($solicitud->activa == 'N')
						@php
							$clase = 'red'
						@endphp
					@endif	
					@if($solicitud->temporal == 'S')
						@php
							$clase = '#FFFF66'
						@endphp
					@endif	
					<td bgcolor="{{$clase}}">{{ $solicitud->id }} </td>
					<td bgcolor="{{$clase}}">{{ $solicitud->apadoptante }}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->nadoptante }}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->edad }}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->nporte}}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->nninios}}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->actividad}}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->nguardian}}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->nsexo}}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->ncastrado}}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->ndepto}}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->notrosperros}}</td>
					<td bgcolor="{{$clase}}">{{ $solicitud->ngatos}}</td>
					
					<td>
						<a href="{{ route('admin.perros.index_sol', $solicitud->id)}}" class="btn btn-success">{{ $solicitud->cant}} </a>
						@if($solicitud->cant == 0)
							<a href="{{ route('admin.perros.index_sug', $solicitud->id)}}" class="btn btn-info">{{$solicitud->sug}}</a>
						@endif
						<a href="{{ route('admin.solicitud.edit', $solicitud->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
						<a href="{{ route('admin.solicitud.destroy', $solicitud->id)}}" 
							onclick="return confirm('Seguro de Eliminar el Registro?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></a> 
					</td>
				</tr>

			@endforeach

		</tbody>
		

	</table>

	{{ $solicitudes->appends(Request::all())->render() }}

@endsection	