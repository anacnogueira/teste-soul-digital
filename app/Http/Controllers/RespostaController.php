<?php

namespace App\Http\Controllers;

use Gate;
use Mail;
use Illuminate\Http\Request;
use App\Entities\Resposta;
use App\Entities\Ticket;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RespostaController extends Controller
{
    private $resposta;
    private $ticket;

    /**
     * Class Constructor
     * @param    $resposta   
     */
    public function __construct(Resposta $resposta, Ticket $ticket)
    {
        $this->resposta = $resposta;
        $this->ticket = $ticket;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $ticketId)
    {
        $ticket = $this->ticket->find($ticketId);

        if (Gate::allows('ticket', $ticket)) {
            $user = Auth::user();

            $validator = $this->validates($request->all());
          
            if ($validator->fails()){
                return redirect()->route('tickets.show',['ticket_id' => $ticketId])
                ->withErrors($validator)
                ->withInput();           
            } 

            $data = $request->toArray();       

            //Change Ticket status
            $ticket->update([
                'status' => $data['status']
            ]);

            $resposta = $this->resposta->create([
                'ticket_id' => $ticketId,
                'user_id' => $user->id,
                'description' => $data['description']
            ]);

            //Send Email
            $data = [];
            $data['email'] = $resposta->user->email;
            $data['ticket_id'] = $resposta->ticket_id;
            $data['user_name'] = $resposta->user->name;
            $data['description'] = $resposta->description;

            Mail::send('emails.respostas.store', ['data' => $data], function($m) use ($data){
                $m->from(env('MAIL_USERNAME'), 'Sistema de Ticket');
                $m->to($data['email'])->subject('Resposta ao ticket #'.$data['ticket_id']);    
            });

     
            return redirect()->route('tickets.show', ['ticket_id' => $ticketId]);
        }

        echo 'Não Autorizado';
    }
    
    private function validates($request)
    {
        $rules = [
            'status' => 'required',  
            'description' => 'required',
        ];


        $messages = [
            'required' => 'O campo é obrigatório.',
        ];

        return Validator::make($request, $rules, $messages);
    }
}
