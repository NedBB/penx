<?php

namespace App\Models;


class Imprest extends Basemodel
{
    protected $guarded = ['id'];

    public function subhead()
    {
        return $this->belongsTo(Subhead::class);
    }

    public function profile()
    {
        return $this->belongsTo(Staffprofile::class);
    }

}
