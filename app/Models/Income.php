<?php

namespace App\Http\Models;



class Income extends Basemodel
{
    protected $guarded = ['id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
