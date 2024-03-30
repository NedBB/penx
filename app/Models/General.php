<?php

namespace App\Models;


class General extends Basemodel
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function staffprofiles()
    {
        return $this->hasMany(Staffprofile::class);
    }
}
