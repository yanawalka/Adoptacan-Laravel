@extends('admin')


@section('title','Lista de Razas')


@section('content')
@if( Auth::user()->tipo == 'vet' or Auth::user()->tipo == 'admin') 
	<a href="{{ route('admin.razas.create')}}" class="btn btn-info">Nueva Raza</a> <hr>
@else
	<a href="#" class="btn btn-default">Nueva Raza</a> <hr>
@endif	
	<div class="col-lg-12">
  		
  		@include('admin.razas.search')
	</div>
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>RAZA</th>
			<th>PORTE</th>
			<th>NIÑOS</th>
			<th>E. VIDA</th>
		</thead>
		<tbody>
			@foreach($razas as $raza)
				<tr>
					<td>{{ $raza->id }}</td>
					<td>{{ $raza->nombre }}</td>
					<td>
						@if($raza->porte == 'P')
    						<span class="alert alert-success">Pequeño</span>
        				@elseif($raza->porte == 'M') 	
   							<span class="alert alert-primary">Mediano</span>
        				@elseif($raza->porte == 'G') 	
   							<span class="alert alert-warning">Grande</span>
        				@elseif($raza->porte == 'GI') 	
   							<span class="alert alert-danger">Gigante</span>
   						@else	
        					<span class="alert alert-dark">No especificado</span>
						@endif
					</td>
					<td>
						@if ($raza->ninios == -1)
							<span class="alert alert-warning"> 	-- </span>
						@elseif ($raza->ninios == 0)	
							<span class="alert alert-danger"> 	NO </span>
						@else
							<span class="alert alert-success"> 	SI </span>
						@endif
					<td>
						@if($raza->evida >= 5)	
							<span class="alert alert-success"> {{ $raza->evida }} </span>
						@else
							<span class="alert alert-danger"> {{ $raza->evida }} </span>
						@endif

					</td>
					<td>
						@if( Auth::user()->tipo == 'vet' or Auth::user()->tipo == 'admin') 
							<a href="{{ route('admin.razas.edit',$raza->id)}}" class="btn btn-warning"> <span class="glyphicon glyphicon-wrench"></span> </a>
						
							<a href="{{ route('admin.razas.destroy',$raza->id)}}" 
								onclick="return confirm('Seguro de Eliminar el Registro?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a> </td>
						@else
							<a href="{{ route('admin.razas.index')}}" class="btn btn-default"> <span class="glyphicon glyphicon-lock disabled" > </span>  </a>
						
							<a href="{{ route('admin.razas.index')}}" 
								 class="btn btn-default"><span class="glyphicon glyphicon-lock disabled"></span> </a> </td>	
						@endif		
				</tr>
			@endforeach

		</tbody>
		

	</table>

	{{ $razas->appends(Request::all())->render() }}

@endsection	
