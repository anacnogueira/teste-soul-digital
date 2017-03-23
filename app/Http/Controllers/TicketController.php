<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Ticket;

use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    
    private $ticket;

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
        
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
