@extends('admin')


@section('title','Historial del can')

@section('content')

@if( Auth::user()->tipo == 'vet' or Auth::user()->tipo == 'admin') 
	<a href="{{ route('admin.seguimientos.create',$idperro)}}" class="btn btn-info">Nuevo Registro</a> 
@else
	<a href="#" class="btn btn-default">Nuevo Registro</a> 
@endif	
	<a href="{{ route('admin.seguimientos.index',0)}}" class="btn btn-success">Regresar a Seguimientos</a> 
	<a href="{{ route('admin.seguimientos.imprime',$idperro)}}" class="btn btn-success">Imprimir Historial</a> 
	<hr>

			@php
    			$items = 1;
			@endphp
			@foreach($seguimiento as $seguimient)

			@if ($items == 1)
        		<div class="form-group">
        			<div class="row">

        				<div class="col-lg-1" >
                              @if($seguimient->foto!='')
                               <a href="{{asset('images/canes/'.$seguimient->foto)}}"> <img src="{{asset('images/canes/'.$seguimient->foto)}}" alt="" width="100px" class="img-thumbnail"> </a>
                              
                              @endif
                        </div>
						<div class="col-lg-2">
							{!! Form::label('CHIP','CHIP')!!}
							{!! Form::text('CHIP',$seguimient->chip,['class' => 'form-control', 'placeholder' => 'CHIP' ,'readonly']) !!}
						</div>



						<div class="col-lg-2">
							{!! Form::label('APODO','APODO')!!}
							{!! Form::text('APODO',$seguimient->apodo,['class' => 'form-control', 'placeholder' => 'CHIP' ,'readonly']) !!}
						</div>
						<div class="col-lg-1">
							{!! Form::label('EDAD','EDAD')!!}
							{!! Form::text('EDAD',$seguimient->edad,['class' => 'form-control', 'placeholder' => 'EDAD' ,'readonly']) !!}
						</div>
					</div>
				</div>	
				<div class="form-group">
        			<div class="row">

						<div class="col-lg-2">
							{!! Form::label('APELLIDO','APELLIDO')!!}
							{!! Form::text('APELLIDO',$seguimient->apellido,['class' => 'form-control', 'placeholder' => 'Apellido' ,'readonly']) !!}
						</div>
						<div class="col-lg-2">
							{!! Form::label('NOMBRES','NOMBRES')!!}
							{!! Form::text('NOMBRES',$seguimient->nombres,['class' => 'form-control', 'placeholder' => 'Nombres' ,'readonly']) !!}
						</div>
						<div class="col-lg-2">
							{!! Form::label('CELULAR','CELULAR')!!}
							{!! Form::text('CELULAR',$seguimient->celular,['class' => 'form-control', 'placeholder' => 'celular' ,'readonly']) !!}
						</div>


						<div class="col-lg-2">
							{!! Form::label('EMAIL','EMAIL')!!}
							{!! Form::text('EMAIL',$seguimient->email,['class' => 'form-control', 'placeholder' => 'EMAIL' ,'readonly']) !!}
						</div>


					</div>
				</div>	

                <table class="table table-striped">
                	<th>ID</th>
					<th>Fecha</th>
					<th>detalle</th>
					<th>usuario</th>
					<th>Carga en Base</th>
					<th>ACCION</th>
				</thead>
				<tbody>

    		@endif
    		
				
				<tr>


					<td> {{ $seguimient->idseg }} </td>	
                    <td> {{ date('d-m-y', strtotime($seguimient->fecha)) }}</td>
                    <td> {{ $seguimient->detalle }}</td>
                    <td> {{ $seguimient->usuario }}</td>
                    <td> {{ date('d-m-y', strtotime( $seguimient->created_at )) }}</td>
                   
					<td>
					
					@if ( $seguimient->idseg  > 0) 
				
						@if( Auth::user()->tipo == 'vet' or Auth::user()->tipo == 'admin') 

							<a href="{{ route('admin.seguimientos.edit', $seguimient->idseg )}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
						@else
							<a href="#" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span></a>
						@endif	
						
					@endif	
					</td>
				</tr>
				@php
    				$items = $items + 1;
				@endphp
			@endforeach

		</tbody>
		

	</table>

	{{ $seguimiento->appends(Request::all())->render() }}

@endsection	