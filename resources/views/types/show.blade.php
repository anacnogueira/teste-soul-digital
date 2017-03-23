@extends('adminlte::page')

@section('htmlheader_title')
	Tipos
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
                    <dd>{{ $type->name }}&nbsp;</dd>
                </dl>			

			</div>
		</div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    <ul>
                        <li>
                            <a href="{{ route('tipos.edit', ['id' => $type->id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Editar </a> 
                        </li>
                        <li>
                            <div style="float:left; margin-right: 10px">
                                {!! Form::open(['route' => ['tipos.destroy', $type->id], 'method' => 'delete', 'id'=>'form'.$type->id]) !!}
                                {!! Form::button('<i class="fa fa-times"></i> Excluir', ['type' => 'submit','class' => 'btn btn-danger','onclick'=>"deleteConfirm(event, $type->id)"]) !!}
                                {!! Form::close() !!}  
                            </div> 
                        </li>
                        <li>
                            <a href="{{ route('tipos.index') }}" class="btn btn-warning"><i class="fa fa-list-alt"></i> Listar </a> 
                        </li>
                        <li>
                            <a href="{{ route('tipos.create') }}" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Adicionar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
	</div>
@endsection
