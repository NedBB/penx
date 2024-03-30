<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Paymentmethod extends Basemodel
{
    public function profiles()
    {
        return $this->hasMany(Staffprofile::class);
    }
}
