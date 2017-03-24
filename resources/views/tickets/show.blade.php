@extends('adminlte::page')

@section('htmlheader_title')
    Ticket
@endsection

@section('contentheader_title')
   Ticket
  @stop

@section('contentheader_description')
    Responder
@stop

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                {!! Form::open(['route'=>['respostas.store', 'ticket_id' => $ticket->id]]) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-body"> 
                                <div class="form-group">
                                    {!! Form::label('id', 'ID') !!} 
                                    <div class="form-control">{{ $ticket->id }}</div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('subject', 'Assunto') !!} 
                                    <div class="form-control">{{ $ticket->subject }}</div>
                                </div>          
                                <div class="form-group ">
                                    {!! Form::label('description', 'Descrição') !!} 
                                    <div class="form-control">{{ $ticket->description }}</div>    
                                </div>  
                                <div class="form-group ">
                                    {!! Form::label('user_id', 'Criado por') !!} 
                                    <div class="form-control">{{ $ticket->user->name }}</div>    
                                </div>
                                <div class="form-group ">
                                    {!! Form::label('created_at', 'Data') !!} 
                                    <div class="form-control">{{ $ticket->created_at }}</div>    
                                </div>
                                
                                <hr>
                                <dl>
                                @foreach ($ticket->resposta as $resposta)
                                    <dt>Data: </dt>
                                    <dd>{{ $resposta->created_at }} &nbsp;</dd>
                                    <dt>Resposta: </dt>
                                    <dd>{{ $resposta->description }} &nbsp;</dd>
                                    <dt>Criada por: </dt>
                                    <dd>{{ $resposta->user->name }} &nbsp;</dd>
                                    <br>           
                                @endforeach
                                </dl>
                                <hr>
                                <div class="form-group @if ($errors->has('status')) has-error @endif">
                                    {!! Form::label('status', 'Status*') !!} 
                                    {!! Form::select('status', $statuses, $ticket->status, ['class' => 'form-control', 'placeholder' => 'Selecione o status...']); !!}            
                                    @if ($errors->has('status')) <span class="help-block">{{ $errors->first('status') }}</span> @endif
                                </div>
                                <div class="form-group @if ($errors->has('description')) has-error @endif">
                                    {!! Form::label('description', 'Resposta*') !!} 
                                    {!! Form::textarea('description', null, $attributes = ['class' => 'form-control']); !!}
                                    @if ($errors->has('description')) <span class="help-block">{{ $errors->first('description') }}</span> @endif
                                </div> 
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('tickets.index')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
                                &nbsp;&nbsp;
                                {!! Form::button('<i class="fa fa-check"></i> Responder', ['type' => 'submit','class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    </div>
                </div>			
                {!! Form::close() !!}

                   <div class="row">
        <div class="col-md-12">
            <div class="actions">
                <ul>
                    <li>
                        <a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Editar </a> 
                    </li>
                    <li>
                        <div style="float:left; margin-right: 10px">
                            {!! Form::open(['route' => ['tickets.destroy', $ticket->id], 'method' => 'delete', 'id'=>'form'.$ticket->id]) !!}
                                {!! Form::button('<i class="fa fa-times"></i> Excluir', ['type' => 'submit','class' => 'btn btn-danger','onclick'=>"deleteConfirm(event, $ticket->id)"]) !!}
                            {!! Form::close() !!}                                                    
                        </div> 
                    </li>
                    <li>
                        <a href="{{ route('tickets.index') }}" class="btn btn-warning"><i class="fa fa-list-alt"></i> Listar </a> 
                    </li>
                    <li>
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Novo Ticket</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
			</div>
		</div>
	</div>
@endsection
