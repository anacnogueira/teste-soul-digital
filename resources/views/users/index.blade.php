@extends('adminlte::page')

@section('htmlheader_title')
	Usuários
@endsection

@section('contentheader_title')
    Usuários
@endsection

@section('contentheader_description')
    Listar
    <a href="{{ route('usuarios.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Adicionar</a>
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Listar Usuários</h3>
                    </div>
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="user" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="table_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="order" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Ordernar por nome do usuário">Nome</th>
                                                <th class="sorting" tabindex="0" aria-controls="order" rowspan="1" colspan="1" aria-label="Ordernar pelo tipo de usuário">Tipo</th>
                                                <th class="sorting" tabindex="0" aria-controls="order" rowspan="1" colspan="1" aria-label="Ordernar pelo e-mail do usuário">E-mail</th>                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach ($users as $user)
                                            <tr role="row" class="">
                                                <td>
                                                    {{ $user->name }} <br>
                                                    <div style="float:left; margin-right: 10px">
                                                        {!! Form::open(['route' => ['usuarios.destroy', $user['id']], 'method' => 'delete', 'id'=>'form'.$user->id]) !!}
                                                        {!! Form::button('<i class="fa fa-times"></i> Excluir', ['type' => 'submit','class' => 'btn btn-danger', 'onclick'=>"deleteConfirm(event, {$user->id})"]) !!}
                                                        {!! Form::close() !!}
                                                        &nbsp; &nbsp;
                                                    </div>
                                                    <a href="{{ route('usuarios.edit',['id' => $user->id]) }}" class='btn btn-warning'><i class="fa fa-edit"></i> Editar</a>
                                                    &nbsp; &nbsp;
                                                    <a href="{{ route('usuarios.show',['id' => $user->id]) }}" class ='btn btn-primary'><i class="fa fa-eye"></i> Visualizar</a>
                                                   &nbsp; &nbsp;
                                                </td>
                                                <td>{{ $user->type->name }}</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                            <th rowspan="1" colspan="1">Nome</th>
                                            <th rowspan="1" colspan="1">Tipo</th>
                                            <th rowspan="1" colspan="1">E-mail</th>
                                          </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				

			</div>
		</div>
	</div>
@endsection
