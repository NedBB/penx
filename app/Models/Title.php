<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Title extends Basemodel
{
    public function profiles()
    {
        return $this->hasMany(Staffprofile::class);
    }

    public function contractors()
    {
    	return $this->hasMany(Contractor::class);
    }
}
