<?php

namespace App\Models;



class Pettycashrecord extends Basemodel
{
    public function profile()
    {
        return $this->belongsTo(Staffprofile::class);
    }

    public function subhead()
    {
        return $this->belongsTo(Subhead::class);
    }
}
