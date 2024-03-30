<?php

namespace App\Models;



class Location extends Basemodel
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }
}
