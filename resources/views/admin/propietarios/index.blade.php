@extends('admin')


@section('title','Propietarios de Mascotas')


@section('content')
	



	<a href="{{ route('admin.propietarios.create') }}" class="btn btn-info">Ingresar Nuevo Propietario</a> <hr>

	<div class="col-lg-12">
  		
  		@include('admin.propietarios.search')
	</div>
	<table class="table table-striped">
		<thead>
			<th>DNI</th>
			<th>APELLIDO</th>
			<th class="hidden-xs hidden-sm hidden-md">NOMBRES</th>
			<th>CELULAR</th>
			<th>CERTCARENCIA</th>
			<th>FECHACERT</th>
			<th>DOMICILIO</th>
			<th class="hidden-xs hidden-sm hidden-md">REFERENCIA</th>
			<th>FOTO</th>
			
			<th>ACCION</th>
		</thead>
		<tbody>
			@foreach($propietarios as $propietario)

				<tr>
					<td>{{ $propietario->dni }}</td>
					<td>{{ $propietario->apellido }}</td>
					<td class="hidden-xs hidden-sm hidden-md">{{ $propietario->nombres }}</td>
					<td>{{ $propietario->celular }}</td>
					<td>{{ $propietario->certcarencia }}</td>
					@if(is_null($propietario->fechacert))
						<td>--------</td>
					@else 
						<td>{{ date('d-m-Y',strtotime($propietario->fechacert))}}</td>
					@endif
					<td class="hidden-xs hidden-sm hidden-md">{{ $propietario->domicilio }}</td>
					<td>{{ $propietario->referencia }}</td>
					<td>
					 <div >
                              @if($propietario->foto!='')
                              
                               	<a href="{{asset('images/propietarios/'.$propietario->foto)}}"> <img src="{{asset('images/propietarios/'.$propietario->foto)}}" alt="" width="100px" class="img-thumbnail"> </a>
                              @endif	
                    </div>
					</td>
					
					<td>


						<a href="{{ route('admin.propietarios.edit', $propietario->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
						@if( Auth::user()->tipo == 'admin') 
							<a href="{{ route('admin.propietarios.destroy', $propietario->id)}}" 
								onclick="return confirm('Seguro de Eliminar el Registro?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></a> 
						@else
							<a href="#" 
								 class="btn btn-default"><span class="glyphicon glyphicon-lock"></a> 
						@endif				
						<a href="{{ route('admin.perros.index', $propietario->id)}}" 
							class="btn btn-info"><span class="glyphicon glyphicon-heart"></a> 	
						<a href="{{ route('admin.seguimientos.index', $propietario->id)}}" 
							class="btn btn-success">{{ $propietario->cantidad }}</a> 	

					</td>
				</tr>
			@endforeach

		</tbody>
		

	</table>

	{{ $propietarios->appends(Request::all())->render() }}

@endsection	