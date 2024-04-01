<?php

namespace App\Models;


class Account extends Basemodel
{

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function scopeSearch($query,$value){
        $query->where('name','like',"%{$value}%");
    }

}
