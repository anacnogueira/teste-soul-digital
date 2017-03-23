<div class="col-md-12">
  <div class="box box-danger">
    <div class="box-body">   

       <div class="row">
         <div class="col-md-12">
          <p>Os campos com * são obrigatórios</p>
          <div class="form-group @if ($errors->has('name')) has-error @endif">
            {!! Form::label('name', 'Nome*') !!} 
            {!! Form::text('name', null, $attributes = ['class' => 'form-control']); !!}
            @if ($errors->has('name')) <span class="help-block">{{ $errors->first('name') }}</span> @endif
          </div>          
          <div class="form-group @if ($errors->has('email')) has-error @endif">
            {!! Form::label('email', 'E-mail*') !!} 
            {!! Form::email('email', null, $attributes = ['class' => 'form-control']); !!}
            @if ($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span> @endif
          </div>
          <div class="form-group @if ($errors->has('type_id')) has-error @endif">
            {!! Form::label('type_id', 'Tipo*') !!} 
            {!! Form::select('type_id', $types, null, ['class' => 'form-control', 'placeholder' => 'Selecione o tipo de usuário...']); !!}
            @if ($errors->has('type_id')) <span class="help-block">{{ $errors->first('type_id') }}</span> @endif
          </div>
           <div class="form-group @if ($errors->has('password')) has-error @endif">
              {!! Form::label('password', 'Senha') !!} 
              {!! Form::password('password', ['class' => 'form-control', 'readonly'=>'readonly']); !!}
              @if ($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span> @endif
          </div>
          <div class="form-group">
            {!! Form::label('file', 'Imagem') !!} 
            {!! Form::file('file', null, $attributes = ['class' => 'form-control']); !!}
            @if (isset($usuario->image) && !empty($usuario->image))
              <br>
              {!! Form::hidden('oldfile', $user->image); !!}
              <img src="{{ asset('storage/users/'.$user->image) }}">
            @endif
          </div>                           
        </div>
    </div>
  </div>
  <div class="box-footer">
  	<a href="{{ route('usuarios.index')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
    &nbsp;&nbsp;
    {!! Form::button('<i class="fa fa-check"></i> Salvar', ['type' => 'submit','class' => 'btn btn-success']) !!}
  </div>  
 </div>
</div>     
{!! Form::close() !!}