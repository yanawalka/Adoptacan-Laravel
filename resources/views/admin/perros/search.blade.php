{!! Form::open(array('url'=>'admin/perros','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
		<div class="input-group">
			
			{!! Form::text('perros',null,['class' => 'form-control', 'placeholder' => 'Apodo']) !!}
			<span class="input-group-btn">
				{!! Form::submit('Buscar',['class'=>'btn btn-primary']) !!}
			</span>		
		</div>

		<div class="form-group">
			
		</div>
</div>
{{Form::close()}}
