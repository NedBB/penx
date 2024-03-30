<?php

namespace App\Models;



class Payroll extends Basemodel
{
    protected $guarded = ['id'];

    public function profile()
    {
        return $this->morphTo();
    }

}
