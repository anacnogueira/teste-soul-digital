<?php

namespace App\Http\Controllers;

use Gate;
use Mail;
use Illuminate\Http\Request;
use App\Entities\Ticket;
use App\Entities\Type;
use App\Entities\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    
    private $ticket;
    private $type;
    private $user;
    

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
    public function __construct(Ticket $ticket, Type $type, User $user)
    {
        $this->ticket = $ticket;
        $this->type = $type;
        $this->user = $user;
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

        $ticket = $this->ticket->create($data);

        $type = $this->type->where('name','admin')->first();
        $users = $this->user->where('type_id',$type->id)->get();

        $data = [];
        $data['ticket_id'] = $ticket->id;
        $data['user_name'] = $ticket->user->name;
        $data['subject'] = $ticket->subject;
        $data['description'] = $ticket->description;

        foreach ($users as $user) {
            $data['email'] = $user->email;

            Mail::send('emails.tickets.store', ['data' => $data], function($m) use ($data){
                $m->from(env('MAIL_FROM_ADDRESS'), 'Sistema de Ticket');
                $m->to($data['email'])->subject('Novo ticket criado');    
            });
        }
 
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
        $ticket = $this->ticket->with('resposta')->find($id);

        if (Gate::allows('ticket', $ticket)) {
            $statuses = $this->statuses;            

            return view('tickets.show', compact('ticket','statuses'));               
        }

        echo 'Não Autorizado';        
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

        if (Gate::allows('ticket', $ticket)) {
            return view('tickets.edit', compact('ticket'));
        }    

        echo 'Não Autorizado';
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

        if (Gate::allows('ticket', $ticket)) {
            $validator = $this->validates($request->all());

            if ($validator->fails()){
                return redirect()->route('tickets.edit',['id' => $id])
                ->withErrors($validator)
                ->withInput();           
            }

            $ticket->update($request->all());
              
            return redirect()->route('tickets.index');
             
        } 

        echo 'Não Autorizado';     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = $this->ticket->find($id);

        if (Gate::allows('ticket', $ticket)) {
            $this->ticket->destroy($id);

            return redirect()->route("tickets.index");
        }  
        
        echo 'Não Autorizado';  
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
