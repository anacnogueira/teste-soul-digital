@extends('adminlte::page')

@section('htmlheader_title')
    Usuários
@endsection

@section('contentheader_title')
   Usuários
  @stop

@section('contentheader_description')
    Configurações
@stop


@section('main-content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {!! Session::get('success') !!}
        </div>
    @elseif (Session::has('error'))
        <div class="alert alert-error">
            {!! Session::get('error') !!}
        </div>    
    @endif

	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img src="{{ asset($user->img_path) }}" class="profile-user-img img-responsive img-circle" >
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>                 
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body box-profile">  
                    {!! Form::model($user, ['class' =>'form-horizontal','route'=>['usuarios.update', 'id' => $user->id],'method'=>'put', 'files' => true]) !!}
                    {!! Form::hidden('oldfile', $user->image); !!}
                    {!! Form::hidden('type_id', $user->type_id); !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                {!! Form::label('name', 'Nome',['class'=>'col-sm-2 control-label']) !!} 
                                <div class="col-sm-10">
                                    {!! Form::text('name', $user->name, $attributes = ['class' => 'form-control']); !!}
                                    @if ($errors->has('name')) <span class="help-block">{{ $errors->first('name') }}</span> @endif
                                </div>
                            </div>
                            
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                {!! Form::label('email', 'E-mail',['class'=>'col-sm-2 control-label']) !!} 
                                <div class="col-sm-10">
                                    {!! Form::text('email', $user->email, $attributes = ['class' => 'form-control']); !!}
                                    @if ($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span> @endif
                                </div>
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('file', 'Foto',['class'=>'col-sm-2 control-label']) !!} 
                                <div class="col-sm-10">
                                    {!! Form::file('file', null, $attributes = ['class' => 'form-control']); !!}
                                </div>
                            </div>
                            
                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                {!! Form::label('password', 'Senha',['class'=>'col-sm-2 control-label']) !!} 
                                <div class="col-sm-10">
                                    {!! Form::password('password', ['class' => 'form-control','readonly'=>'readonly']); !!}
                                    @if ($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span> @endif
                                </div>                          
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    {!! Form::button('<i class="fa fa-check"></i> Salvar Alterações', ['type' => 'submit','class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                        </div>
                    </div>  
                    {!! Form::close() !!}
                    </div>
                </div>  
            </div>
        </div>
				

			</div>
		</div>
	</div>
@endsection
