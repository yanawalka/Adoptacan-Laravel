{!! Form::open(array('url'=>'admin/propietarios','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
		<div class="input-group">
			
			{!! Form::text('propietarios',null,['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
			<span class="input-group-btn">
				{!! Form::submit('Buscar',['class'=>'btn btn-primary']) !!}
			</span>		
		</div>

		<div class="form-group">
			
		</div>
</div>
{{Form::close()}}
