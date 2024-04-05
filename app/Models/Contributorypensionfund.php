<?php

namespace App\Models;



class Contributorypensionfund extends Basemodel
{
    public $timestamps = true;

    public function staffprofile()
    {
        return $this->belongsTo(Staffprofile::class);
    }
}
