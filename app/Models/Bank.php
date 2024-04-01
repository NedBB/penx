<?php

namespace App\Models;



class Bank extends Basemodel
{
    public $timestamps = false;

    public function profiles()
    {
        return $this->hasOne(Staffprofile::class);
    }

    public function nationalofficers()
    {
        return $this->hasMany(Nationalofficer::class);
    }

    public function contractors()
    {
    	return $this->hasMany(Contractor::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function scopeSearch($query,$value){
        $query->where('name','like',"%{$value}%");
    }
}
