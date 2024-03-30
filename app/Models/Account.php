<?php

namespace App\Models;


class Account extends Basemodel
{

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

}
