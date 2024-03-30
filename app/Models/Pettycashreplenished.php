<?php

namespace App\Models;


class Pettycashreplenished extends Basemodel
{
    public function subhead()
    {
        return $this->belongsTo(Subhead::class);
    }
}
