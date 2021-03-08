@extends('admin')


@section('title','Animales en Adopción que cumplen con solicitud: '.$solicitud->id.' ')


@section('content')

	<table class="table table-striped">
		<thead>
			<th>CHIP</th>
			<th>RAZA</th>
			<th>APODO</th>
			<th>FECHANAC</th>
			<th>SEXO</th>
			<th>PORTE</th>
			<th>NIÑOS</th>
			<th>ACTIVIDAD</th>
			<th>GUARDIAN</th>
			<th>CASTRADO</th>
			<th>DPTO</th>
			<th>OT PERROS</th>
			<th>GATOS</th>
			<th>FOTO</th>
			<th>ACCION</th>
		</thead>
		<tbody>


			@foreach($perros as $perro)

				<tr>
					<td>{{ $perro->chip }}</td>
					<td>{{ $perro->nraza }}</td>
					<td>{{ $perro->apodo }}</td>
					<td>{{ date('Y-m-d',strtotime($perro->fechanac))}}</td>
					
					<td>{{ $perro->nsexo }}</td>
					<td>
						@if($perro->porte == 'P')
    						<span class="alert alert-success">{{$perro->nporte}}</span>
        				@elseif($perro->porte == 'M') 	
   							<span class="alert alert-info">{{$perro->nporte}}</span>
        				@elseif($perro->porte == 'G') 	
   							<span class="alert alert-warning">{{$perro->nporte}}</span>
        				@elseif($perro->porte == 'GI') 	
   							<span class="alert alert-danger">{{$perro->nporte}}</span>
   						@else	
        					<span class="alert alert-dark">{{$perro->nporte}}</span>
						@endif
					</td>
					<td>
						@if ($perro->ninios == 1)
							<span class="alert alert-success"> 	{{$perro->nninios}} </span>
						@elseif ($perro->ninios == 0)	
							<span class="alert alert-danger"> 	{{$perro->nninios}}  </span>
						@else
							<span class="alert alert-warning"> 		{{$perro->nninios}}  </span>
						@endif
					</td>	
					<td>{{ $perro->nactividad }}</td>
					<td>{{ $perro->nguardian }}</td>
					<td>{{ $perro->ncastrado }}</td>
					<td>{{ $perro->ndepto }}</td>
					<td>{{ $perro->notrosperros }}</td>
					<td>{{ $perro->ngatos }}</td>
					<td>
					 <div class="col-lg-12">
                              @if($perro->foto!='')
                              <img src="{{asset('images/canes/'.$perro->foto)}}" alt="" height="100px" width="100px" class="img-thumbnail">
                              
                              @endif
                            </div>
					</td>
					
					<td>

						<a href="{{ route('admin.perros.index_can', $perro->id)}}" class="btn btn-success">{{ $perro->cant}} </a>
						@if ($perro->cant == 0)
							<a href="{{ route('admin.perros.index_perros_sug', $perro->id)}}" class="btn btn-info">{{ $perro->sug}} </a>
						@endif	
						<a href="{{ route('admin.perros.edit', $perro->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
						<a href="{{ route('admin.perros.destroy', $perro->id)}}" 
							onclick="return confirm('Seguro de Eliminar el Registro?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></a> 
						<a href="{{ route('admin.perros.adoptar',[$perro->id,$solicitud->id])}}" 
						    class="btn btn-success"><span class="glyphicon glyphicon-ok"></a> 	
					</td>
				</tr>
			@endforeach

		</tbody>
		

	</table>

	{{ $perros->appends(Request::all())->render() }}

@endsection	