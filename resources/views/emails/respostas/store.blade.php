@extends('layouts.email')

@section('title', 'Resposta ao Ticket #'.$data['ticket_id'])

@section('content')
	<p>Seu Ticket # {{ $data['ticket_id'] }} teve uma resposta</p>

	<p>
		{{ $data['description'] }}
	</p>

	<p>Respondido por {{ $data['user_name'] }}</p>
	

	<p><a href="{{ env('APP_URL').'/tickets/'.$data['ticket_id'] }}">Visualizar Ticket</a></p>
	<p><a href="{{ env('APP_URL') }}" class="btn-primary" itemprop="url" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Sistema de Tickets Soul Digital</a></p>
@endsection