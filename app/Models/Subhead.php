<?php

namespace App\Models;

class Subhead extends Basemodel
{
    public $timestamps = false;

    public function head()
    {
        return $this->belongsTo(Head::class);
    }

    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

    public function imprests()
    {
        return $this->hasMany(Imprest::class);
    }

    public function pettycashrecords()
    {
        return $this->hasMany(Pettycashrecord::class);
    }

    public function pettycashreplenisheds()
    {
        return $this->hasMany(Pettycashreplenished::class);
    }

    public function transportandtravels()
    {
        return $this->hasMany(Transportandtravel::class);
    }

    public function omnibuses()
    {
        return $this->hasMany(Omnibus::class);
    }

    public function scopeSearch($query,$value){
        $query->where('name','like',"%{$value}%");
    }

}
