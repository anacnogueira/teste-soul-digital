<div class="col-md-12">
  <div class="box box-danger">
    <div class="box-body">
      <div class="row">
         <div class="col-md-12">
          <p>Os campos com * são obrigatórios</p>
          <div class="form-group  @if ($errors->has('name')) has-error @endif">
          	{!! Form::label('name', 'Nome*') !!}	
          	{!! Form::text('name',  $value = null, $attributes = ['class' => 'form-control']) !!}
            @if ($errors->has('name')) <span class="help-block">Este campo é obrigatório</span> @endif
          </div>          
      </div>
    </div>
  </div>
  <div class="box-footer">
  	<a href="{{ route('tipos.index')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
    &nbsp;&nbsp;
    {!! Form::button('<i class="fa fa-check"></i> Salvar', ['type' => 'submit','class' => 'btn btn-success']) !!}
  </div>  
 </div>
</div>     
{!! Form::close() !!}