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

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function getCreatedAtAttribute($value) {
        $date = new \Carbon\Carbon($value);
        $date->setLocale('pt_BR');
        return $date->format('d/m/Y H:i:s');
    }
}
