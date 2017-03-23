<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    protected $fillable = [
        'user_id', 'subject', 'description'
    ];


    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function resposta()
    {
        return $this->hasMany('App\Entities\Resposta');
    }

    public function getCreatedAtAttribute($value) {
        $date = new \Carbon\Carbon($value);
        $date->setLocale('pt_BR');
        return $date->format('d/m/Y H:i:s');
    }

}
