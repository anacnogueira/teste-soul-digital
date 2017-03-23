@extends('adminlte::page')

@section('htmlheader_title')
    Ticket
@endsection

@section('contentheader_title')
   Ticket
  @stop

@section('contentheader_description')
    Criar novo
@stop


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                <div class="row">
                    {!! Form::open(['route' => 'tickets.store']) !!}
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
