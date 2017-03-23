<?php

namespace App\Http\Controllers;

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
        $user = Auth::user();

        $validator = $this->validates($request->all());
      
        if ($validator->fails()){
            return redirect()->route('tickets.show',['ticket_id' => $ticketId])
            ->withErrors($validator)
            ->withInput();           
        } 

        $data = $request->toArray();       

        //Change Ticket status
        $this->ticket->find($ticketId)->update([
            'status' => $data['status']
        ]);

        $this->resposta->create([
            'ticket_id' => $ticketId,
            'user_id' => $user->id,
            'description' => $data['description']
        ]);
 
        return redirect()->route('tickets.show', ['ticket_id' => $ticketId]);
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
