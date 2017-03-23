@extends('adminlte::page')

@section('htmlheader_title')
    Usuários
@endsection

@section('contentheader_title')
    Usuários
@endsection


@section('contentheader_description')
    Visualizar
@stop


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                <dl>
                    <dt>Nome: </dt>
                    <dd>{{ $user->name }}&nbsp;</dd>    
                    <dt>Tipo: </dt>
                    <dd>{{ $user->type->name }}&nbsp;</dd>
                    <dt>E-mail: </dt>
                    <dd>{!! $user->email !!}&nbsp;</dd>
                    @if(!empty($user->image))
                        <dt>Imagem: </dt>
                        <dd><img src="{{ asset('/storage/users/'.$user->image) }}" alt="{{ $user->name }}" title="{{ $user->name }}">&nbsp;</dd>           
                    @endif              
            </dl>   


			</div>
		</div>

        <br>
    <div class="row">
        <div class="col-md-12">
            <div class="actions">
                <ul>
                    <li>
                        <a href="{{ route('usuarios.edit', ['id' => $user->id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Editar </a> 
                    </li>
                    <li>
                        <div style="float:left; margin-right: 10px">
                            {!! Form::open(['route' => ['usuarios.destroy', $user->id], 'method' => 'delete', 'id'=>'form'.$user->id]) !!}
                                {!! Form::button('<i class="fa fa-times"></i> Excluir', ['type' => 'submit','class' => 'btn btn-danger','onclick'=>"deleteConfirm(event, $user->id)"]) !!}
                            {!! Form::close() !!}                                                    
                        </div> 
                    </li>
                    <li>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-warning"><i class="fa fa-list-alt"></i> Listar </a> 
                    </li>
                    <li>
                        <a href="{{ route('usuarios.create') }}" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Adicionar</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
	</div>
@endsection
