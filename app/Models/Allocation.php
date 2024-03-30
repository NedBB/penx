<?php

namespace App\Models;



class Allocation extends Basemodel
{
    protected $guarded = ['id'];

    protected $appends = ['tablename'];

    public function subhead()
    {
        return $this->belongsTo(Subhead::class);
    }

    public function head()
    {
        return $this->belongsTo(Head::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function getTablenameAttribute($value){
        return 'allocation';
    }



}
