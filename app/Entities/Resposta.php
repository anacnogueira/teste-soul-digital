<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    protected $fillable = [
        'ticket_id', 'description'
    ];

    public function ticket()
    {
        return $this->belongsTo('App\Entities\Ticket');
    }
}
