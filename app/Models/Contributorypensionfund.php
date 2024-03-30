<?php

namespace App\Models;



class Contributorypensionfund extends Basemodel
{
    public function staffprofile()
    {
        return $this->belongsTo(Staffprofile::class);
    }
}
