@extends('adminlte::page')

@section('htmlheader_title')
    Usuários
@endsection

@section('contentheader_title')
    Usuários
@endsection

@section('contentheader_description')
    Editar
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                <div class="row">
                    {!! Form::model($user, ['route'=>['usuarios.update', 'id' => $user->id],'method'=>'put', 'files' => true]) !!}
                    @include('users.form')                            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="actions">
                            <ul>
                                <li><a href="{{ route('usuarios.index') }}" class="btn btn-warning"><i class="fa fa-list-alt"></i> Listar</a></li> 
                            </ul>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
@endsection
