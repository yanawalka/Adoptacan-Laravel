@extends('admin')


@section('title','Animales en Adopción')


@section('content')
	<a href="{{ route('admin.perros.create')}}" class="btn btn-info">Ingresar Animal</a> <hr>

	<div class="col-lg-12">
  		
  		@include('admin.perros.search')
	</div>
	<table class="table table-striped">
		<thead>
			<th class="hidden-xs hidden-sm hidden-md">CHIP</th>
			<th class="hidden-xs hidden-sm hidden-md">RAZA</th>
			<th>APODO</th>
			<th class="hidden-xs hidden-sm hidden-md">FECHANAC</th>
			<th class="hidden-xs hidden-sm hidden-md">SEXO</th>
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
					<td class="hidden-xs hidden-sm hidden-md">{{ $perro->chip }}</td>
					<td class="hidden-xs hidden-sm hidden-md">{{ $perro->nraza }}</td>
					<td>{{ $perro->apodo }}</td>
					<td class="hidden-xs hidden-sm hidden-md">{{ date('Y-m-d',strtotime($perro->fechanac))}}</td>
					
					<td class="hidden-xs hidden-sm hidden-md">{{ $perro->nsexo }}</td>
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
					 <div >
                              @if($perro->foto!='')
                               <a href="{{asset('images/canes/'.$perro->foto)}}"> <img src="{{asset('images/canes/'.$perro->foto)}}" alt="" width="100px" class="img-thumbnail"> </a>
                              
                              @endif
                            </div>
					</td>
					
					<td>

						<a href="{{ route('admin.perros.edit', $perro->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
						<a href="{{ route('admin.perros.destroy', $perro->id)}}" 
							onclick="return confirm('Seguro de Eliminar el Registro?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></a> 
						@if(isset($persona))	
						<a href="{{ route('admin.perros.adoptarciego',[$perro->id,$persona->id])}}" 
						    class="btn btn-success"><span class="glyphicon glyphicon-ok"></a> 	
						@endif    

					</td>
				</tr>
			@endforeach

		</tbody>
		

	</table>

	{{ $perros->appends(Request::all())->render() }}

@endsection	