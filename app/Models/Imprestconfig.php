<?php

namespace App\Models;



class Imprestconfig extends Basemodel
{
    public $timestamps = false;

    public function subhead()
    {
        return $this->belongsTo(Subhead::class);
    }
}
