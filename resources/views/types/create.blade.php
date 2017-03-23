@extends('adminlte::page')

@section('htmlheader_title')
	Tipos
@endsection

@section('contentheader_title')
    Tipos
@endsection

@section('contentheader_description')
    Adicionar
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
			   <div class="row">
                {!! Form::open(array('route' => 'tipos.store')) !!}
                @include('types.form')                        
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <ul>
                            <li><a href="{{ route('tipos.index') }}" class="btn btn-warning"><i class="fa fa-list-alt"></i> Listar</a></li>                           
                        </ul>
                    </div>
                </div>
            </div

			</div>
		</div>
	</div>
@endsection