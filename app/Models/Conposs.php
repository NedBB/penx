<?php

namespace App\Models;



class Conposs extends Basemodel
{
    public function gradelevel()
    {
        return $this->belongsTo(Gradelevel::class);
    }

    public function staffprofiles()
    {
        return $this->hasMany(Staffprofile::class);
    }


}