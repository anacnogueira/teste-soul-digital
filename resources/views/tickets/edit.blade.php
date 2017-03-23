@extends('adminlte::page')

@section('htmlheader_title')
    Ticket
@endsection

@section('contentheader_title')
    Ticket
@endsection

@section('contentheader_description')
    Editar
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                    <div class="row">
                    {!! Form::model($ticket, ['route'=>['tickets.update', 'id' => $ticket->id],'method'=>'put']) !!}
                    @include('tickets.form') 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="actions">
                            <ul>
                                <li><a href="{{ route('tickets.index') }}" class="btn btn-warning"><i class="fa fa-list-alt"></i> Listar</a></li>       
                            </ul>
                        </div>
                    </div>
                </div>
				
			</div>
		</div>
	</div>
@endsection
