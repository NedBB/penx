<?php

namespace App\Models;



class Fixeddeduction extends Basemodel
{
    protected $guarded = ['id'];

    public function loantype()
    {
        return $this->belongsTo(Loantype::class);
    }

    public function profile()
    {
        return $this->morphTo();
    }

}
