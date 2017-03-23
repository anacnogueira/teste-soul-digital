<div class="col-md-12">
  <div class="box box-danger">
    <div class="box-body">   

       <div class="row">
         <div class="col-md-12">
          <p>Os campos com * são obrigatórios</p>
          <div class="form-group @if ($errors->has('subject')) has-error @endif">
            {!! Form::label('subject', 'Assunto*') !!} 
            {!! Form::text('subject', null, $attributes = ['class' => 'form-control']); !!}
            @if ($errors->has('subject')) <span class="help-block">{{ $errors->first('subject') }}</span> @endif
          </div>          
          <div class="form-group @if ($errors->has('description')) has-error @endif">
            {!! Form::label('description', 'Descrição*') !!} 
            {!! Form::textarea('description', null, $attributes = ['class' => 'form-control']); !!}
            @if ($errors->has('description')) <span class="help-block">{{ $errors->first('description') }}</span> @endif
          </div>                                  
        </div>
    </div>
  </div>
  <div class="box-footer">
  	<a href="{{ route('tickets.index')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
    &nbsp;&nbsp;
    {!! Form::button('<i class="fa fa-check"></i> Salvar', ['type' => 'submit','class' => 'btn btn-success']) !!}
  </div>  
 </div>
</div>     
{!! Form::close() !!}