<?php

namespace App\Models;



class Head extends Basemodel
{
    public $timestamps = false;

    public function subheads()
    {
        return $this->hasMany(Subhead::class);
    }

    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

    public function omnibuses()
    {
        return $this->hasMany(Omnibus::class);
    }
}
