<?php

namespace App\Models;



class Department extends Basemodel
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function profiles()
    {
        return $this->hasMany(Staffprofile::class);
    }

    public function scopeSearch($query,$value){
        $query->where('name','like',"%{$value}%");
    }
}
