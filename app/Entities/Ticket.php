<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id', 'subject', 'description'
    ];


    public function type()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function resposta()
    {
        return $this->hasMany('App\Entities\Reposta');
    }

}
