{!! Form::open(array('url'=>'admin/razas','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
		<div class="input-group">
			
			{!! Form::text('razas',null,['class' => 'form-control', 'placeholder' => 'Nombre de la Raza']) !!}
			<span class="input-group-btn">
				{!! Form::submit('Buscar',['class'=>'btn btn-primary']) !!}
			</span>		
		</div>

		<div class="form-group">
			
		</div>
</div>
{{Form::close()}}
