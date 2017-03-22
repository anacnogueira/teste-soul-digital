<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name', 
    ];


    public function type()
    {
        return $this->hasMany('App\Entities\Type');
    }
}
