@extends('adminlte::page')

@section('htmlheader_title')
	Tipos
@endsection

@section('contentheader_title')
    Tipos
@endsection

@section('contentheader_description')
    Listar
    <a href="{{ route('tipos.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Adicionar</a>
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                  <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="type" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="table_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="order" rowspan="1" colspan="1" aria-label="Ordernar pelo nome do tipo de usuário">Nome</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($types as $type)
                                            <tr role="row" class="">
                                                <td>
                                                    {{ $type['name'] }}<br>
                                                    <div style="float:left; margin-right: 10px">
                                                        {!! Form::open(['route' => ['tipos.destroy', $type['id']], 'method' => 'delete', 'id'=>'form'.$type['id']]) !!}
                                                        {!! Form::button('<i class="fa fa-times"></i> Excluir', ['type' => 'submit','class' => 'btn btn-danger','onclick'=>"deleteConfirm(event, {$type['id']})"]) !!}
                                                        {!! Form::close() !!}
                                                        &nbsp; &nbsp;
                                                    </div>
                                                     <a href="{{ route('tipos.edit',['id' => $type['id']]) }}" class='btn btn-warning'><i class="fa fa-edit"></i> Editar</a>
                                                    &nbsp; &nbsp;
                                                    <a href="{{ route('tipos.show',['id' => $type['id']]) }}" class ='btn btn-primary'><i class="fa fa-eye"></i> Visualizar</a>
                                                   &nbsp; &nbsp;                                               
                                                </td>                                                                 
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                            <th rowspan="1" colspan="1">Nome</th>
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
