<?php

namespace App\Models;



class Gradelevelname extends Basemodel
{
    public $timestamps = false;

    public function gradelevels()
    {
        return $this->hasMany(Gradelevel::class);
    }

}
