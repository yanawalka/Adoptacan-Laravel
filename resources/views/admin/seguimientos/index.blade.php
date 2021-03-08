@extends('admin')


@section('title','Seguimiento de Canes')


@section('content')
	

	<div class="col-lg-12">
  		
  		@include('admin.seguimientos.search')
	</div>
	
	<table class="table table-striped">
		<thead>
			<th class="hidden-xs hidden-sm hidden-md">CHIP</th>
			<th>APODO</th>
			<th>EDAD</th>
			
			<th>APELLIDO</th>
			<th class="hidden-xs hidden-sm hidden-md">NOMBRES</th>
			<th>CELULAR</th>
			<th>FECHACERT</th>
			<th class="hidden-xs hidden-sm hidden-md">EMAIL</th>
			<th>FOTO</th>
			
			<th>ACCION</th>
		</thead>
		<tbody>
			@foreach($seguimientos as $seguimiento)

				<tr>
					<td class="hidden-xs hidden-sm hidden-md">{{ $seguimiento->chip }}</td>
					<td>{{ $seguimiento->apodo }}</td>
					<td>{{ $seguimiento->edad }}</td>
					<td>{{ $seguimiento->apellido }}</td>
					<td class="hidden-xs hidden-sm hidden-md">{{ $seguimiento->nombres }}</td>
					<td>{{ $seguimiento->celular }}</td>
					<td>{{ date('d-m-y', strtotime($seguimiento->fechacert)) }}</td>
					<td class="hidden-xs hidden-sm hidden-md">{{ $seguimiento->email }}</td>
					<td>
						<div >
                              @if($seguimiento->foto!='')
                               <a href="{{asset('images/canes/'.$seguimiento->foto)}}"> <img src="{{asset('images/canes/'.$seguimiento->foto)}}" alt="" width="100px" class="img-thumbnail"> </a>
                              
                              @endif
                            </div>
                    </td>
					<td>

						<a href="{{ route('admin.seguimientos.historia', $seguimiento->idperro )}}" class="btn btn-success">{{ $seguimiento->cantseg }}</a>
						
						<a href="{{ route('admin.perros.edit', $seguimiento->idperro )}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
						@if($seguimiento->idpr > 0)
						<a href="{{ route('admin.propietarios.edit', $seguimiento->idpr)}}" 
							class="btn btn-info"><span class="glyphicon glyphicon-user"></a> 	
						@endif	
					</td>
				</tr>
			@endforeach

		</tbody>
		

	</table>

	{{ $seguimientos->appends(Request::all())->render() }}

@endsection	