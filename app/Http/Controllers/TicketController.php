<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Ticket;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class TicketController extends Controller
{
    
    private $ticket;
    private $resposta;

    private $statuses = [
        'open'=>'Aberto', 
        'pending' => 'Pendente',
        'closed' => 'Fechado'
    ]; 

     /**
     * Class Constructor
     * @param    $ticket   
     * @param    $resposta   
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = $this->ticket;

        $user = Auth::user();
        if ($user->type->name == 'cliente'){
            $tickets = $tickets->where('user_id', $user->id);
        }

        $tickets = $tickets->get();

        for ($i = 0; $i <count($tickets); $i++) {
            $tickets[$i]->status = $this->statuses[$tickets[$i]->status];
        }
        
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = $this->validates($request->all());

        if ($validator->fails()){
            return redirect()->route('tickets.create')
            ->withErrors($validator)
            ->withInput();           
        }

        $data = $request->toArray();
        $data['user_id'] = $user->id;
        $data['status'] = 'open';

        $this->ticket->create($data);

        //Todo: Avisar admins sobre o ticket por e-mail
 
        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $statuses = $this->statuses;
        $ticket = $this->ticket
        ->with('resposta')
        ->find($id);

        return view('tickets.show', compact('ticket','statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = $this->ticket->find($id);

        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = $this->ticket->find($id);

        $validator = $this->validates($request->all());

        if ($validator->fails()){
            return redirect()->route('tickets.edit',['id' => $id])
            ->withErrors($validator)
            ->withInput();           
        }

        $ticket->update($request->all());
              
        return redirect()->route('tickets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validates($request)
    {
        $rules = [
            'subject' => 'required|max:255',  
            'description' => 'required',
        ];


        $messages = [
            'required' => 'O campo é obrigatório.',
            'max' => 'Tamanho máximo de 255 caracteres excedido',
        ];

        return Validator::make($request, $rules, $messages);
    }
}
