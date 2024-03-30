<?php

namespace App\Models;


class Rank extends Basemodel
{
    public $timestamps = false;

    public function profiles()
    {
        return $this->hasMany(Staffprofile::class);
    }
}
