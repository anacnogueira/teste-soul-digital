<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image','type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function type()
    {
        return $this->belongsTo('App\Entities\Type');
    }

    public function ticket()
    {
        return $this->hasMany('App\Entities\Ticket');
    }

    public function getCreatedAtAttribute($value) {
        $date = new \Carbon\Carbon($value);
        $date->setLocale('pt_BR');
        return $date->format('d/m/Y');
    }
}
