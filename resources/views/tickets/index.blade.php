@extends('adminlte::page')

@section('htmlheader_title')
    Tickets
@endsection

@section('contentheader_title')
    Tickets
@endsection

@section('contentheader_description')
    Listar
    <a href="{{ route('tickets.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Novo Ticket</a>
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                        <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Tickets</h3>
                    </div>
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="ticket" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="table_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="order" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Ordernar pelo assunto do Ticket">Assunto</th>
                                                <th class="sorting" tabindex="0" aria-controls="order" rowspan="1" colspan="1" aria-label="Ordernar pelo criador do ticket">Criado por</th>
                                                <th class="sorting" tabindex="0" aria-controls="order" rowspan="1" colspan="1" aria-label="Ordernar pela data do ticket">Data</th>
                                                <th class="sorting" tabindex="0" aria-controls="order" rowspan="1" colspan="1" aria-label="Ordernar pelo status do ticket">Status</th>                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach ($tickets as $ticket)
                                            <tr role="row" class="">
                                                <td>
                                                    {{ $ticket->subject }} <br>
                                                    @if ($user->type->name == 'admin' || $user->id == $ticket->user_id)
                                                        <div style="float:left; margin-right: 10px">
                                                            {!! Form::open(['route' => ['tickets.destroy', $ticket->id], 'method' => 'delete', 'id'=>'form'.$ticket->id]) !!}
                                                            {!! Form::button('<i class="fa fa-times"></i> Excluir', ['type' => 'submit','class' => 'btn btn-danger', 'onclick'=>"deleteConfirm(event, {$ticket->id})"]) !!}
                                                            {!! Form::close() !!}
                                                            &nbsp; &nbsp;
                                                        </div>

                                                        <a href="{{ route('tickets.edit',['id' => $ticket->id]) }}" class='btn btn-warning'><i class="fa fa-edit"></i> Editar</a>
                                                        &nbsp; &nbsp;
                                                        <a href="{{ route('tickets.show',['id' => $ticket->id]) }}" class ='btn btn-primary'><i class="fa fa-eye"></i> Responder</a>
                                                       &nbsp; &nbsp;
                                                   @endif
                                                </td>
                                                <td>{{ $ticket->user->name }}</td>
                                                <td>{{ $ticket->created_at }}</td>
                                                <td>{{ $ticket->status }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                            <th rowspan="1" colspan="1">Assunto</th>
                                            <th rowspan="1" colspan="1">Criado por</th>
                                            <th rowspan="1" colspan="1">Data</th>
                                            <th rowspan="1" colspan="1">Status</th>
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
