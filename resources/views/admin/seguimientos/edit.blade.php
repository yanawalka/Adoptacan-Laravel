@extends('admin')


@section('title','Editar Registro De Seguimiento')


@section('content')

	{!! Form::open(['route' => ['admin.seguimientos.update',$seguimiento->id],'method' => 'PUT','files'=>true]) !!}

		<div class="form-group">
			<div class="row">
				<div class="col-lg-3">
					{!! Form::label('Apodo can','APODO')!!}
					{!! Form::text('apodo',$perro->apodo,['class' => 'form-control', 'placeholder' => 'Dni' ,'readonly']) !!}
				</div>	
				
				<div class="col-lg-4">	
					{!! Form::label('Chip','CHIP') !!}
					{!! Form::text('chip',$perro->chip,['class' => 'form-control', 'placeholder' => 'Apellido','readonly']) !!}
				</div>	
				<div >
                  	@if($perro->foto!='')
                       <a href="{{asset('images/canes/'.$perro->foto)}}"> <img src="{{asset('images/canes/'.$perro->foto)}}" alt="" width="100px" class="img-thumbnail"> </a>
                              
                    @endif
               </div>
					
					{!! Form::hidden('idcan',$perro->id,['class' => 'form-control', 'placeholder' => 'Dni' ,'readonly']) !!}

				</div>


		</div>
		
		
		<div class="form-group">	
			<div class="row">
				<div class="col-lg-2">
					{!! Form::label('fecha','Fecha') !!}
					{!! Form::date('fecha',date('Y-m-d',strtotime($seguimiento->fecha))) !!}	
				</div>	
			</div>	
		</div>		
		<div class="form-group">
			<div class="row">
				<div class="col-lg-8">	
					{!! Form::label('Detalle','Detalle') !!}
					{!! Form::textarea('detalle',$seguimiento->detalle,['class' => 'form-control', 'placeholder' => 'Detalle','required']) !!}
				</div>	

				

			</div>

		</div>


		<div class="form-group">	
			<div class="row">
				<div class="col-lg-3">
					{!! Form::submit('Grabar',['class'=>'btn btn-primary']) !!}
				</div>
			</div>

		</div>



	{!! Form::close() !!}


@endsection	