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
                {!! Form::open(['route' => 'respostas.store']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-body"> 
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
                                <div class="form-group @if ($errors->has('status')) has-error @endif">
                                    {!! Form::label('status', 'Status*') !!} 
                                    {!! Form::select('status', $statuses, $ticket->status, ['class' => 'form-control', 'placeholder' => 'Selecione o status...']); !!}            
                                    @if ($errors->has('status')) <span class="help-block">{{ $errors->first('status') }}</span> @endif
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
			</div>
		</div>
	</div>
@endsection
