<?php

namespace App\Models;


class Omnibus extends Basemodel
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

    public function getTablenameAttribute($value)
    {
        return 'omnibus';
    }

    public function scopeSearch($query,$value){
        $query->where('pvno','like',"%{$value}%");
    }
}
