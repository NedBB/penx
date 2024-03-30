<?php

namespace App\Models;


class Loantype extends Basemodel
{
    public $timestamps = false;

    public function fixeddeductions()
    {
        return $this->hasMany(Fixeddeduction::class);
    }
}
