<?php

namespace App\Models;



class Gradelevel extends Basemodel
{
    public $timestamps = false;

    public function conposses()
    {
        return $this->hasMany(Composs::class);
    }

    public function profiles()
    {
        return $this->hasMany(Staffprofile::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function gradelevelname()
    {
        return $this->belongsTo(Gradelevelname::class);
    }

}
