<?php

namespace App\Models;


class Transportandtravel extends Basemodel
{
    protected $guarded = ['id'];

    protected $appends = ['tablename'];

    public function profile()
    {
        return $this->belongsTo(Staffprofile::class);
    }

    public function subhead()
    {
        return $this->belongsTo(Subhead::class);
    }

    public function getTablenameAttribute($value)
    {
        return 'transport';
    }

}
