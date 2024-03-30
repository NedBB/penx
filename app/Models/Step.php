<?php

namespace App\Models;


class Step extends Basemodel
{
    public $timestamps = false;

    public function conposses()
    {
        return $this->hasMany(Conposs::class);
    }

    public function gradelevel()
    {
        return $this->belongsTo(Gradelevel::class);
    }

    public function profiles()
    {
        return $this->hasMany(Staffprofile::class);
    }
}
