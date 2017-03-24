@extends('layouts.email')

@section('title', 'Novo Ticket criado')

@section('content')
	<p>Um novo ticket foi criado</p>

	<p>
		ID: {{ $data['ticket_id'] }}<br>
		Usuario: {{ $data['user_name'] }}<br>
		Assunto: {{ $data['subject'] }}<br>
		Descrição: {{ $data['description'] }}
	</p>
	
	<p><a href="{{ env('APP_URL') }}" class="btn-primary" itemprop="url" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Sistema de Tickets Soul Digital</a></p>
@endsection